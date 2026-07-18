<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">

            {{-- Panel kiri: branding --}}
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center p-12"
                style="background: linear-gradient(160deg, #1E293B 0%, #1E3A8A 45%, #2563EB 100%);">

                {{-- Blob dekoratif blur --}}
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-32 -left-16 w-80 h-80 bg-accent/30 rounded-full blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>

                <div class="relative z-10 max-w-md text-white">
                    <div class="flex items-center gap-3 mb-10">
                        <span class="w-12 h-12 bg-white/10 backdrop-blur border border-white/20 rounded-2xl flex items-center justify-center font-bold text-xl shadow-lg">AS</span>
                        <span class="font-bold text-xl">Absensi Sekolah</span>
                    </div>

                    <h1 class="text-4xl font-bold leading-tight mb-4 tracking-tight">
                        Kelola kehadiran<br>siswa jadi lebih mudah
                    </h1>
                    <p class="text-white/70 leading-relaxed mb-10 text-[15px]">
                        Catat, rekap, dan pantau kehadiran siswa secara digital — tidak perlu lagi kertas absensi yang mudah hilang.
                    </p>

                    <div class="space-y-5">
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur border border-white/10 flex items-center justify-center text-lg shrink-0">📋</span>
                            <div>
                                <p class="text-sm font-semibold">Absensi Massal per Kelas</p>
                                <p class="text-xs text-white/60">Input kehadiran satu kelas sekaligus</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur border border-white/10 flex items-center justify-center text-lg shrink-0">📊</span>
                            <div>
                                <p class="text-sm font-semibold">Rekap & Laporan Otomatis</p>
                                <p class="text-xs text-white/60">Persentase kehadiran per siswa, siap export</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur border border-white/10 flex items-center justify-center text-lg shrink-0">📅</span>
                            <div>
                                <p class="text-sm font-semibold">Kalender & Dashboard</p>
                                <p class="text-xs text-white/60">Pantau tren kehadiran secara visual</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel kanan: form --}}
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12 bg-gray-50 relative">
                <div class="lg:hidden flex items-center gap-2 mb-8">
                    <span class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center text-white font-bold shadow-md">AS</span>
                    <span class="font-bold text-primary text-lg">Absensi Sekolah</span>
                </div>

                <div class="w-full sm:max-w-sm bg-white shadow-[0_2px_4px_rgba(16,24,40,0.04),0_12px_32px_rgba(16,24,40,0.08)] p-8 rounded-2xl border border-gray-100">
                    {{ $slot }}
                </div>

                <p class="text-xs text-gray-400 mt-6">© {{ date('Y') }} Absensi Sekolah — Student Attendance System</p>
            </div>
        </div>
    </body>
</html>