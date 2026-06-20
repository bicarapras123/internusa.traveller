<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Destinations') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow border sticky top-5">

                        <h3 class="text-xl font-bold text-gray-800 mb-6">
                            Tambah Travel Item Baru
                        </h3>

                        <form action="{{ route('travel-items.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <x-input-label for="name" value="Nama Wisata" />
                                <x-text-input id="name" name="name" type="text"
                                    class="mt-1 block w-full" required />
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <x-input-label for="price" value="Harga" />
                                    <x-text-input id="price" name="price" type="number"
                                        class="mt-1 block w-full" required />
                                </div>

                                <div>
                                    <x-input-label for="stock" value="Stok" />
                                    <x-text-input id="stock" name="stock" type="number"
                                        class="mt-1 block w-full" value="0" required />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="type" value="Tipe Wisata" />
                                <x-text-input id="type" name="type" type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Contoh : Destinasi"
                                    required />
                            </div>

                            <div>
                                <x-input-label for="image_url" value="URL Gambar" />
                                <x-text-input id="image_url" name="image_url" type="url"
                                    class="mt-1 block w-full" />
                            </div>

                            <div>
                                <x-input-label for="description" value="Deskripsi" />
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">

                                <input type="checkbox"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    checked
                                    class="rounded border-gray-300 text-sky-600">

                                <label class="ml-2 text-sm font-medium text-gray-700">
                                    Wisata Aktif
                                </label>
                            </div>

                            <x-primary-button class="w-full justify-center py-3">
                                Simpan Data Wisata
                            </x-primary-button>

                        </form>

                    </div>
                </div>

                {{-- TABEL --}}
                <div class="xl:col-span-2">

                    <div class="bg-white rounded-2xl shadow border overflow-hidden">

                        <div class="px-6 py-5 border-b">
                            <h3 class="text-xl font-bold text-gray-800">
                                Destination Halaman
                            </h3>
                        </div>

                        <div class="overflow-x-auto">

                            <table class="w-full">

                                <thead class="bg-sky-600 text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Gambar</th>
                                        <th class="px-4 py-3 text-left">Nama</th>
                                        <th class="px-4 py-3 text-left">Harga</th>
                                        <th class="px-4 py-3 text-left">Stok</th>
                                        <th class="px-4 py-3 text-left">Tipe</th>
                                        <th class="px-4 py-3 text-left">Deskripsi</th>
                                        <th class="px-4 py-3 text-center">Status</th>
                                        <th class="px-4 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y">

                                @forelse($items as $item)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-4 py-3">
                                            @if($item->image_url)
                                                <img src="{{ $item->image_url }}"
                                                    class="w-20 h-16 object-cover rounded-lg border">
                                            @else
                                                <div class="w-20 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 font-semibold">
                                            {{ $item->name }}
                                        </td>

                                        <td class="px-4 py-3">
                                            Rp {{ number_format($item->price,0,',','.') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $item->stock }}
                                        </td>

                                        <td class="px-4 py-3">
                                            {{ $item->type }}
                                        </td>

                                        <td class="px-4 py-3 max-w-xs truncate">
                                            {{ $item->description }}
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            @if($item->is_active)
                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex justify-center gap-2">

                                                {{-- EDIT --}}
                                                <a href="{{ route('travel-items.edit',$item->id) }}"
                                                    class="bg-yellow-100 p-2 rounded-lg hover:bg-yellow-200">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 text-yellow-600"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">

                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.586 2.586a2 2 0 112.828 2.828L12 14l-4 1 1-4 9.586-9.414z"/>
                                                    </svg>

                                                </a>

                                                {{-- HAPUS --}}
                                                <form action="{{ route('travel-items.destroy',$item->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                        class="bg-red-100 p-2 rounded-lg hover:bg-red-200">

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 text-red-600"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor">

                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7L18.132 19.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.994-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"/>
                                                        </svg>

                                                    </button>

                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-10 text-gray-500">
                                            Belum ada data wisata
                                        </td>
                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>