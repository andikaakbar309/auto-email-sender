<?php

namespace App\Console\Commands;

use App\Jobs\SendScheduledEmailJob;
use App\Models\ScheduledEmail;
use Illuminate\Console\Command;

class DispatchDueEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch scheduled emails that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $due = ScheduledEmail::query()
            ->where('status', 'pending')
            ->where('send_at', '<=', now())
            ->orderBy('send_at')
            ->limit(50)
            ->get();

        foreach ($due as $item) {
            SendScheduledEmailJob::dispatch($item->id);
        }

        $this->info("Dispatched: {$due->count()}");
        return self::SUCCESS;
    }
}
