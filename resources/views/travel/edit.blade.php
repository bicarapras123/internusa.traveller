<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Travel Item
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow border">

                <form action="{{ route('travel-items.update', $item->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label value="Nama Wisata" />
                        <x-text-input
                            name="name"
                            class="mt-1 block w-full"
                            value="{{ old('name', $item->name) }}"
                            required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label value="Harga (Rp)" />
                            <x-text-input
                                name="price"
                                type="number"
                                class="mt-1 block w-full"
                                value="{{ old('price', $item->price) }}"
                                required />
                        </div>

                        <div>
                            <x-input-label value="Stok" />
                            <x-text-input
                                name="stock"
                                type="number"
                                class="mt-1 block w-full"
                                value="{{ old('stock', $item->stock) }}"
                                required />
                        </div>

                    </div>

                    <div>
                        <x-input-label value="Tipe Wisata" />
                        <x-text-input
                            name="type"
                            class="mt-1 block w-full"
                            value="{{ old('type', $item->type) }}"
                            required />
                    </div>

                    <div>
                        <x-input-label value="URL Gambar" />
                        <x-text-input
                            name="image_url"
                            class="mt-1 block w-full"
                            value="{{ old('image_url', $item->image_url) }}" />
                    </div>

                    <div>
                        <x-input-label value="Deskripsi" />
                        <textarea
                            name="description"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="rounded border-gray-300 text-sky-600"
                            {{ $item->is_active ? 'checked' : '' }}>

                        <label class="ml-2 text-sm text-gray-700">
                            Wisata Aktif
                        </label>
                    </div>

                    <div class="flex gap-3">

                        <x-primary-button>
                            Update Data
                        </x-primary-button>

                        <a href="{{ route('dashboard') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>