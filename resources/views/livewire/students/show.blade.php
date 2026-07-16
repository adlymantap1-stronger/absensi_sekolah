<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-5 mb-5 text-white shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Profil Siswa</p>
                <h2 class="text-xl font-bold">{{ $student->name }}</h2>
                <p class="text-sm opacity-90 mt-1">
                    {{ $student->classRoom->name }} &bull;
                    {{ $student->classRoom->major->code }} &bull;
                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </p>
            </div>

            <a href="{{ route('students.index') }}"
                wire:navigate
                class="bg-white/15 hover:bg-white/25 border border-white/30 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-colors">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        {{-- Statistik --}}
        <div class="space-y-4">

            <div class="grid grid-cols-2 gap-3">

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-3 text-center">
                    <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $this->stats['hadir'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Hadir</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-3 text-center">
                    <p class="text-xl font-bold text-yellow-600 dark:text-yellow-400">{{ $this->stats['sakit'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Sakit</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-3 text-center">
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $this->stats['izin'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Izin</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-3 text-center">
                    <p class="text-xl font-bold text-red-600 dark:text-red-400">{{ $this->stats['alpa'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Alpa</p>
                </div>

            </div>

            {{-- Persentase --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 p-4">

                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Persentase Kehadiran
                    </p>

                    <p class="text-sm font-bold text-primary dark:text-blue-400">
                        {{ $this->stats['persentase'] }}%
                    </p>
                </div>

                <div class="w-full h-2.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div
                        class="h-full bg-gradient-to-r from-primary to-accent"
                        style="width: {{ $this->stats['persentase'] }}%">
                    </div>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    Berdasarkan {{ $this->stats['total'] }} catatan absensi
                </p>

            </div>

        </div>

        {{-- Riwayat --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border border-gray-100 dark:border-gray-700 overflow-hidden">

            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                    Riwayat Absensi
                </h3>
            </div>

            <div class="max-h-72 overflow-y-auto">

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse ($this->recentAttendances as $attendance)

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">

                                <td class="px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-2.5 text-right">

                                    @php
                                        $badge = match($attendance->status) {
                                            'hadir' => 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300',
                                            'sakit' => 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300',
                                            'izin' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300',
                                            'alpa' => 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300',
                                        };
                                    @endphp

                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold {{ $badge }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="2" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada riwayat absensi.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>