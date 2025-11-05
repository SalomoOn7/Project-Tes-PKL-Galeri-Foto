<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Foto Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Foto')" />
                        <x-text-input id="name" name="title" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Pilih Foto')" />
                        <input id="image" name="filename" type="file" accept="image/*" class="mt-1 block w-full" required>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>{{ __('Upload') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
