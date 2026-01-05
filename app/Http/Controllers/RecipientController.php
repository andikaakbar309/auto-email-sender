<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function index()
    {
        return view('recipients.index', [
            'recipients' => Recipient::orderBy('email')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:recipients,email'],
        ]);

        Recipient::create($data);

        return back()->with('status', 'Email penerima berhasil ditambahkan.');
    }
}
