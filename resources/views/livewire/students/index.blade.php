<div>
    {{-- Header + tombol tambah --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Data Siswa</h2>
        <button wire:click="openCreateModal"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
            + Tambah Siswa
        </button>
    </div>

    {{-- Search & Filter --}}
    <div class="flex gap-3 mb-4">
        <input type="text" wire:model.live.debounce.300ms="search"
            placeholder="Cari nama siswa..."
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">

        <select wire:model.live="filterClassRoom"
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="">Semua Kelas</option>
            @foreach ($classRooms as $classRoom)
                <option value="{{ $classRoom->id }}">{{ $classRoom->name }} - {{ $classRoom->major->code }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tabel siswa --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jurusan</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($students as $student)
                    <tr wire:key="student-{{ $student->id }}">
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $student->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $student->classRoom->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $student->classRoom->major->code }}</td>
                        <td class="px-4 py-3 text-sm text-right">
                            <button wire:click="openEditModal({{ $student->id }})"
                                class="text-blue-600 hover:underline mr-3">Edit</button>
                            <button wire:click="delete({{ $student->id }})"
                                wire:confirm="Yakin ingin menghapus siswa ini?"
                                class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>

    {{-- Modal Tambah/Edit --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
            x-data x-on:keydown.escape.window="$wire.showModal = false">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6" @click.outside="$wire.showModal = false">
                <h3 class="text-lg font-bold mb-4">{{ $editingId ? 'Edit Siswa' : 'Tambah Siswa' }}</h3>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select wire:model="gender"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select wire:model="class_room_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($classRooms as $classRoom)
                                <option value="{{ $classRoom->id }}">{{ $classRoom->name }} - {{ $classRoom->major->code }}</option>
                            @endforeach
                        </select>
                        @error('class_room_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>