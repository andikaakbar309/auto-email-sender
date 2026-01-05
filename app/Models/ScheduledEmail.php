<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledEmail extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'body',
        'send_at',
        'status',
        'sent_at',
        'error_message',
    ];
}
