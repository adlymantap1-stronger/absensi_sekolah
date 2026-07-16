<div class="max-w-5xl mx-auto">
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-5 mb-5 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Attendance</p>
        <h2 class="text-xl font-bold">Kalender Kehadiran</h2>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-4 mb-5">
        <div class="flex gap-4 flex-wrap items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                <select wire:model.live="month"
                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
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
                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    @foreach (range(now()->year, now()->year - 2) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                <select wire:model.live="classRoomId"
                    class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}">{{ $classRoom->name }} - {{ $classRoom->major->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Grid kalender --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-5">
        <div class="grid grid-cols-7 gap-2 mb-2">
            @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayName)
                <div class="text-center text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">
                    {{ $dayName }}
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 gap-2">
            @foreach ($this->calendarDays as $day)
                @if (is_null($day))
                    <div></div>
                @else
                    @php
                        $bg = match(true) {
                            $day['persentase'] === null => 'bg-gray-50 dark:bg-gray-700 text-gray-300 dark:text-gray-400',
                            $day['persentase'] >= 80 => 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300',
                            $day['persentase'] >= 50 => 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300',
                            default => 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300',
                        };
                    @endphp

                    <div class="aspect-square rounded-lg {{ $bg }} flex flex-col items-center justify-center p-1">
                        <span class="text-sm font-semibold">{{ $day['day'] }}</span>

                        @if ($day['persentase'] !== null)
                            <span class="text-[10px]">{{ $day['persentase'] }}%</span>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Legenda --}}
        <div class="flex items-center gap-4 mt-5 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-green-100 dark:bg-green-900/40"></span>
                ≥80% hadir
            </div>

            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-yellow-100 dark:bg-yellow-900/40"></span>
                50-79% hadir
            </div>

            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-red-100 dark:bg-red-900/40"></span>
                &lt;50% hadir
            </div>

            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600"></span>
                Belum ada data
            </div>
        </div>
    </div>
</div>