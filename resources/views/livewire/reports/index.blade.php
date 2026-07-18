<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-6 mb-6 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Attendance</p>
        <h2 class="text-2xl font-bold">Laporan Kehadiran</h2>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 p-5 mb-6">
        <div class="flex gap-4 flex-wrap items-end">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                <select
                    wire:model.live="month"
                    class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                <select wire:model.live="year"
                    class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg pl-3 pr-8 py-2 text-sm min-w-[100px] focus:ring-2 focus:ring-accent focus:outline-none">
                    @foreach (range(now()->year, now()->year - 2) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                <select
                    wire:model.live="filterClassRoom"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    <option value="">Semua Kelas</option>
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}">
                            {{ $classRoom->name }} - {{ $classRoom->major->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button
                wire:click="exportCsv"
                class="bg-accent hover:bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                📤 Export CSV
            </button>

        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Kelas</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Hadir</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Sakit</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Izin</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Alpa</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase">Persentase</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($this->rekap as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">

                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            {{ $row['student']->name }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $row['student']->classRoom->name }}
                        </td>

                        <td class="px-4 py-3 text-sm text-center font-semibold text-green-600 dark:text-green-400">
                            {{ $row['hadir'] }}
                        </td>

                        <td class="px-4 py-3 text-sm text-center font-semibold text-yellow-600 dark:text-yellow-400">
                            {{ $row['sakit'] }}
                        </td>

                        <td class="px-4 py-3 text-sm text-center font-semibold text-blue-600 dark:text-blue-400">
                            {{ $row['izin'] }}
                        </td>

                        <td class="px-4 py-3 text-sm text-center font-semibold text-red-600 dark:text-red-400">
                            {{ $row['alpa'] }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center gap-2 justify-center">
                                <div class="w-16 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div
                                        class="h-full bg-gradient-to-r from-primary to-accent"
                                        style="width: {{ $row['persentase'] }}%">
                                    </div>
                                </div>

                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $row['persentase'] }}%
                                </span>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            Tidak ada data siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>