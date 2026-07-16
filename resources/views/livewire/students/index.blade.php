<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-6 mb-6 text-white shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Student Management</p>
                <h2 class="text-2xl font-bold">Data Siswa</h2>
            </div>

            <button
                wire:click="openCreateModal"
                class="bg-white/15 hover:bg-white/25 border border-white/30 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors">
                + Tambah Siswa
            </button>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 p-5 mb-6">
        <div class="flex gap-3">

            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari nama siswa..."
                class="w-64 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">

            <select
                wire:model.live="filterClassRoom"
                class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                <option value="">Semua Kelas</option>

                @foreach ($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}">
                        {{ $classRoom->name }} - {{ $classRoom->major->code }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Nama
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Jenis Kelamin
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Kelas
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Jurusan
                    </th>

                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

                @forelse ($students as $student)

                    <tr
                        wire:key="student-{{ $student->id }}"
                        class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">

                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            {{ $student->name }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $student->classRoom->name }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <span class="inline-flex items-center rounded-full bg-blue-50 dark:bg-blue-900/40 text-primary dark:text-blue-300 px-2.5 py-1 text-xs font-semibold">
                                {{ $student->classRoom->major->code }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm text-right">

                            <a
                                href="{{ route('students.show', $student) }}"
                                wire:navigate
                                class="mr-3 font-medium text-gray-600 dark:text-gray-300 hover:underline">
                                Detail
                            </a>

                            <button
                                wire:click="openEditModal({{ $student->id }})"
                                class="mr-3 font-medium text-accent hover:underline">
                                Edit
                            </button>

                            <button
                                wire:click="delete({{ $student->id }})"
                                wire:confirm="Yakin ingin menghapus siswa ini?"
                                class="font-medium text-red-600 dark:text-red-400 hover:underline">
                                Hapus
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada data siswa.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>

    {{-- Modal --}}
    @if ($showModal)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            x-data
            x-on:keydown.escape.window="$wire.showModal = false">

            <div
                @click.outside="$wire.showModal = false"
                class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-card">

                <h3 class="mb-4 text-lg font-bold text-primary dark:text-blue-400">
                    {{ $editingId ? 'Edit Siswa' : 'Tambah Siswa' }}
                </h3>

                <form wire:submit="save" class="space-y-4">

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama
                        </label>

                        <input
                            type="text"
                            wire:model="name"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent">

                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jenis Kelamin
                        </label>

                        <select
                            wire:model="gender"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent">

                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>

                        </select>

                        @error('gender')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kelas
                        </label>

                        <select
                            wire:model="class_room_id"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent">

                            <option value="">-- Pilih Kelas --</option>

                            @foreach ($classRooms as $classRoom)
                                <option value="{{ $classRoom->id }}">
                                    {{ $classRoom->name }} - {{ $classRoom->major->code }}
                                </option>
                            @endforeach

                        </select>

                        @error('class_room_id')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-2">

                        <button
                            type="button"
                            wire:click="$set('showModal', false)"
                            class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="rounded-lg bg-accent px-4 py-2 text-sm font-semibold text-white hover:bg-primary">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    @endif
</div>