<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-primary to-accent rounded-2xl p-6 mb-6 text-white shadow-card">
        <p class="text-xs font-bold uppercase tracking-wide opacity-80 mb-1">Attendance</p>
        <h2 class="text-2xl font-bold">Input Absensi Massal</h2>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error (misal coba submit ulang padahal terkunci) --}}
    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-6">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filter kelas & tanggal --}}
    <div class="bg-white rounded-2xl shadow-card border border-gray-100 p-5 mb-6">
        <div class="flex gap-4 flex-wrap">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select wire:model.live="class_room_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}">{{ $classRoom->name }} - {{ $classRoom->major->code }}</option>
                    @endforeach
                </select>
                @error('class_room_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" wire:model.live="date"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-accent focus:outline-none">
                @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        @if ($isLocked)
            <div class="mt-3 text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 inline-block">
                🔒 Absensi untuk kelas dan tanggal ini sudah dikunci, tidak bisa diubah lagi.
            </div>
        @endif
    </div>

    {{-- Tabel siswa untuk input status --}}
    @if ($class_room_id && count($students) > 0)
        <div class="bg-white rounded-2xl shadow-card border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Siswa</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr wire:key="student-{{ $student->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $student->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    @foreach (['hadir' => 'Hadir', 'sakit' => 'Sakit', 'izin' => 'Izin', 'alpa' => 'Alpa'] as $value => $label)
                                        <label class="{{ $isLocked ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                                            <input type="radio" wire:model="statuses.{{ $student->id }}" value="{{ $value }}"
                                                class="peer hidden"
                                                @checked($statuses[$student->id] === $value)
                                                @disabled($isLocked)>
                                            <span
                                                class="inline-block px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors
                                                    {{ $isLocked
                                                        ? ($statuses[$student->id] === $value
                                                            ? 'bg-gray-400 text-white border-gray-400'
                                                            : 'bg-gray-100 text-gray-400 border-gray-200')
                                                        : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50 peer-checked:bg-accent peer-checked:text-white peer-checked:border-accent' }}">
                                                {{ $label }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            @if ($isLocked)
                <span class="text-sm text-gray-500 italic">🔒 Absensi kelas ini untuk tanggal {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }} sudah dikunci.</span>
            @else
                <button wire:click="save"
                    class="bg-accent hover:bg-primary text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-colors">
                    Simpan Absensi
                </button>
            @endif
        </div>
    @elseif ($class_room_id)
        <div class="bg-white rounded-2xl shadow-card border border-gray-100 p-10 text-center text-sm text-gray-500">
            Belum ada siswa di kelas ini.
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-card border border-gray-100 p-10 text-center text-sm text-gray-500">
            Pilih kelas terlebih dahulu untuk menampilkan daftar siswa.
        </div>
    @endif
</div>