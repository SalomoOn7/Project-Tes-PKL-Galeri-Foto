<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Foto Saya') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3">Foto</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Jumlah Like</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="border-b">
                                <td class="px-4 py-2">
                                    <img src="{{ asset('storage/' . $post->filename) }}" class="w-16 h-16 rounded-md object-cover">
                                </td>
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ Str::limit($post->description, 50) }}</td>
                                <td class="px-4 py-2">{{ $post->like()->count() }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline"
                                                onclick="return confirm('Yakin ingin hapus foto ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
