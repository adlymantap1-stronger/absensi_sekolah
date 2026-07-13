<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-6 mb-6 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Attendance</p>
        <h2 class="text-2xl font-bold">Riwayat Absensi</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-card border border-gray-100 p-5 mb-6">
        <div class="flex gap-4 flex-wrap">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" wire:model.live="date"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select wire:model.live="filterClassRoom"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    <option value="">Semua Kelas</option>
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}">{{ $classRoom->name }} - {{ $classRoom->major->code }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                <input type="text" wire:model.live.debounce.300ms="filterStudent" placeholder="Nama siswa..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-card border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Dicatat Oleh</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($attendances as $attendance)
                    <tr wire:key="attendance-{{ $attendance->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $attendance->student->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $attendance->student->classRoom->name }}</td>
                        <td class="px-4 py-3 text-center">
                            @php
                                $badgeColor = match($attendance->status) {
                                    'hadir' => 'bg-green-100 text-green-700',
                                    'sakit' => 'bg-yellow-100 text-yellow-700',
                                    'izin' => 'bg-blue-100 text-blue-700',
                                    'alpa' => 'bg-red-100 text-red-700',
                                };
                            @endphp
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $attendance->recorder->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-500">Belum ada data absensi untuk tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
</div>