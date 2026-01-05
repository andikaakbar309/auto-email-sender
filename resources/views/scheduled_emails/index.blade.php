<x-app-layout>
    <div class="p-6 max-w-3xl mx-auto space-y-6">
        <h1 class="text-xl font-semibold">Jadwal Pengiriman Email</h1>

        @if (session('status'))
            <div class="p-3 bg-green-100 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('scheduled.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm">Title (opsional)</label>
                <input name="title" class="border rounded w-full p-2" />
            </div>

            <div>
                <label class="block text-sm">Subject</label>
                <input name="subject" class="border rounded w-full p-2" required />
                @error('subject') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm">Body</label>
                <textarea name="body" class="border rounded w-full p-2" rows="6" required></textarea>
                @error('body') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm">Send At</label>
                <input type="datetime-local" name="send_at" class="border rounded w-full p-2" required />
                @error('send_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                <div class="text-xs text-gray-600 mt-1">
                    Format mengikuti waktu server lokal. Untuk test, isi 3–5 menit dari sekarang.
                </div>
            </div>

            <button class="px-4 py-2 bg-black text-white rounded">Buat Jadwal</button>
        </form>

        <div class="border-t pt-4">
            <h2 class="font-semibold mb-2">Riwayat Jadwal (maks 50)</h2>

            <div class="space-y-2">
                @foreach($items as $it)
                    <div class="border rounded p-3">
                        <div class="font-semibold">{{ $it->subject }}</div>
                        <div class="text-sm">
                            Send at: {{ $it->send_at }} |
                            Status: <b>{{ $it->status }}</b>
                            @if($it->sent_at) | Sent at: {{ $it->sent_at }} @endif
                        </div>
                        @if($it->error_message)
                            <div class="text-sm text-red-600 mt-1">{{ $it->error_message }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
