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

        {{-- Biodata Siswa --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-card border border-gray-100 dark:border-gray-700 p-5 mb-5">

    <div class="flex items-center gap-3 mb-5">
        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-blue-600 dark:text-blue-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.25a8.25 8.25 0 0115 0"/>
            </svg>
        </div>

        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
            Biodata Siswa
        </h3>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Lahir</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $student->tanggal_lahir ? $student->tanggal_lahir->translatedFormat('d F Y') : '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Nama Orang Tua</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $student->nama_orang_tua ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">No. HP Orang Tua</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $student->no_hp_orang_tua ?: '-' }}
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $student->alamat ?: '-' }}
                </p>
            </div>

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
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100 dark:bg-violet-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-violet-600 dark:text-violet-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h4.5M6 3.75h12A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75Z" />
                        </svg>
                    </div>

                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Riwayat Absensi
                    </h3>
                </div>
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