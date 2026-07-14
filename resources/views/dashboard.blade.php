<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-5 mb-5 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Overview</p>
        <h2 class="text-xl font-bold">Dashboard</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        {{-- Kolom kiri: kartu ringkasan --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white rounded-xl shadow-card border border-gray-100 p-4">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Total Siswa</p>
                <p class="text-2xl font-bold text-primary">{{ $totalSiswa }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $totalKelas }} kelas</p>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-gray-100 p-4">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Hadir Hari Ini</p>
                <p class="text-2xl font-bold text-green-600">{{ $hadirHariIni }}</p>
                <p class="text-xs text-gray-400 mt-1">dari {{ $sudahAbsenHariIni }} tercatat</p>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-gray-100 p-4">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Sakit / Izin</p>
                <p class="text-2xl font-bold text-amber-600">{{ $sakitHariIni + $izinHariIni }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $sakitHariIni }} sakit, {{ $izinHariIni }} izin</p>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-gray-100 p-4">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Alpa</p>
                <p class="text-2xl font-bold text-red-600">{{ $alpaHariIni }}</p>
                <p class="text-xs text-gray-400 mt-1">hari ini</p>
            </div>
        </div>

        {{-- Kolom kanan: statistik mingguan --}}
        <div class="bg-white rounded-xl shadow-card border border-gray-100 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Statistik Kehadiran 7 Hari Terakhir</h3>

            <div class="flex items-end justify-between gap-2 h-40">
                @foreach ($weeklyStats as $day)
                    <div class="flex-1 flex flex-col items-center justify-end h-full">
                        <span class="text-[10px] font-semibold text-gray-600 mb-1">{{ $day['persentase'] }}%</span>
                        <div class="w-full bg-gray-100 rounded-t-lg relative flex items-end" style="height: 110px;">
                            <div class="w-full bg-gradient-to-t from-primary to-accent rounded-t-lg transition-all"
                                style="height: {{ max($day['persentase'], 3) }}%;"></div>
                        </div>
                        <span class="text-[10px] text-gray-500 mt-1.5">{{ $day['date'] }}</span>
                    </div>
                @endforeach
            </div>

            @if ($weeklyStats->sum('total') === 0)
                <p class="text-center text-sm text-gray-400 mt-4">Belum ada data absensi minggu ini.</p>
            @endif
        </div>
    </div>
</div>