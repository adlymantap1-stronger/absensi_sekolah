<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-6 mb-6 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Attendance</p>
        <h2 class="text-2xl font-bold">Riwayat Absensi</h2>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 p-5 mb-6">
        <div class="flex gap-4 flex-wrap">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Tanggal
                </label>

                <input
                    type="date"
                    wire:model.live="date"
                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Kelas
                </label>

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

            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Cari Siswa
                </label>

                <input
                    type="text"
                    wire:model.live.debounce.300ms="filterStudent"
                    placeholder="Nama siswa..."
                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
            </div>

        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Nama Siswa
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Kelas
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-300">
                        Dicatat Oleh
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($attendances as $attendance)

                    <tr wire:key="attendance-{{ $attendance->id }}"
                        class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">

                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            {{ $attendance->student->name }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $attendance->student->classRoom->name }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @php
                                $badgeColor = match($attendance->status) {
                                    'hadir' => 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300',
                                    'sakit' => 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300',
                                    'izin' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300',
                                    'alpa' => 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300',
                                };
                            @endphp

                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                            {{ $attendance->recorder->name ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada data absensi untuk tanggal ini.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
</div>