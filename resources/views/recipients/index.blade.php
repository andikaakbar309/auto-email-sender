<x-app-layout>
    <div class="p-6 max-w-3xl mx-auto space-y-6">
        <h1 class="text-xl font-semibold">Daftar Penerima Email</h1>

        @if (session('status'))
            <div class="p-3 bg-green-100 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('recipients.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm">Nama (opsional)</label>
                <input name="name" class="border rounded w-full p-2" />
            </div>

            <div>
                <label class="block text-sm">Email</label>
                <input name="email" class="border rounded w-full p-2" required />
                @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <button class="px-4 py-2 bg-black text-white rounded">Tambah</button>
        </form>

        <div class="border-t pt-4">
            <h2 class="font-semibold mb-2">List</h2>
            <ul class="list-disc pl-6 space-y-1">
                @forelse($recipients as $r)
                    <li>{{ $r->email }} @if($r->name) ({{ $r->name }}) @endif</li>
                @empty
                    <li class="text-gray-600">Belum ada data.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
