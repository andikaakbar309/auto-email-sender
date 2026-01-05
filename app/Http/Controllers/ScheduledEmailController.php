<?php

namespace App\Http\Controllers;

use App\Models\ScheduledEmail;
use Illuminate\Http\Request;

class ScheduledEmailController extends Controller
{
    public function index()
    {
        return view('scheduled_emails.index', [
            'items' => ScheduledEmail::orderByDesc('send_at')->limit(50)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'send_at' => ['required', 'date'],
        ]);

        ScheduledEmail::create($data);

        return back()->with('status', 'Jadwal email berhasil dibuat.');
    }
}
