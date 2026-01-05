<?php

namespace App\Jobs;

use App\Mail\ReminderMail;
use App\Models\Recipient;
use App\Models\ScheduledEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendScheduledEmailJob implements ShouldQueue
{
      use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $scheduledEmailId) {}

    public function handle(): void
    {
        $scheduled = ScheduledEmail::findOrFail($this->scheduledEmailId);

        if ($scheduled->status === 'sent') return;

        $emails = Recipient::query()
            ->where('is_active', true)
            ->pluck('email')
            ->values()
            ->all();

        if (count($emails) === 0) {
            $scheduled->status = 'failed';
            $scheduled->error_message = 'No active recipients';
            $scheduled->save();
            return;
        }

        try {
            Mail::to($emails)->send(new ReminderMail($scheduled->subject, $scheduled->body));

            $scheduled->status = 'sent';
            $scheduled->sent_at = now();
            $scheduled->error_message = null;
            $scheduled->save();
        } catch (Throwable $e) {
            $scheduled->status = 'failed';
            $scheduled->error_message = $e->getMessage();
            $scheduled->save();
            throw $e;
        }
    }
}
