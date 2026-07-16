<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
            style="background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15) 0%, transparent 40%),
                               radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 40%),
                               linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%);">

            <div class="flex items-center gap-3 mb-2 relative z-10">
                <a href="/" wire:navigate class="flex items-center gap-3">
                    <span class="w-14 h-14 bg-white/15 border border-white/30 rounded-2xl flex items-center justify-center text-white font-bold text-2xl">AS</span>
                    <span class="text-white font-bold text-2xl">Absensi Sekolah</span>
                </a>
            </div>
            <p class="text-white/80 text-sm mb-6 relative z-10">Student Attendance System</p>

            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-card overflow-hidden sm:rounded-2xl relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>