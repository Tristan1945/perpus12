<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'EduLib - Sistem Katalog &amp; Sirkulasi Perpustakaan')</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS & Alpine.js -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @layer base {
            html, body {
                margin: 0;
                padding: 0;
            }
            body {
                overscroll-behavior: none;
            }
        }
        ::-webkit-scrollbar {
            display: none;
        }
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body class="bg-background font-body-md text-on-surface antialiased overflow-x-hidden">

    <!-- MOBILE BACKDROP OVERLAY -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 bg-on-surface/50 backdrop-blur-sm z-40 lg:hidden" x-cloak>
    </div>

    <!-- PANGGIL SIDEBAR -->
    @include('components.sidebar')

    <!-- PANGGIL HEADER -->
    @include('components.header')

    <!-- MAIN CONTENT WRAPPER -->
    <main :class="{ 'lg:pl-64': !sidebarCollapsed, 'lg:pl-20': sidebarCollapsed }"
        class="w-full pt-16 bg-background min-h-screen transition-all duration-300">
        @yield('content')
    </main>

</body>
</html>