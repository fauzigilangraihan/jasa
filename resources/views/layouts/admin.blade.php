<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - fauziDev</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #sidebar {
            display: none;
            position: fixed;
            left: 0;
            top: 64px;
            width: 256px;
            height: calc(100vh - 64px);
            z-index: 40;
            overflow-y: auto;
            background: linear-gradient(180deg, #1C3A5C 0%, #0F2438 100%);
        }

        #sidebar.active {
            display: block;
        }

        @media (min-width: 768px) {
            #sidebar {
                display: block !important;
                position: static;
                top: 0;
                height: 100vh;
            }
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="flex h-screen">
        <!-- Sidebar Component -->
        @include('layouts.components.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar Component -->
            @include('layouts.components.navbar')

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-8 bg-slate-50">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking menu items on mobile
            sidebar.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('active');
                    }
                });
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 &&
                    !sidebar.contains(event.target) &&
                    !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });
        }
