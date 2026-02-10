<!-- Mobile Menu Toggle -->
<div class="md:hidden fixed top-0 left-0 right-0 bg-primary text-white px-4 py-3 flex items-center justify-between z-50 shadow-sm">
    <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-secondary text-primary rounded-lg flex items-center justify-center font-bold text-sm">
            <i class="fas fa-code"></i>
        </div>
        <h1 class="text-base font-bold">fauziDev</h1>
    </div>
    <button id="menu-toggle" class="text-2xl focus:outline-none hover:text-secondary transition">
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- Sidebar -->
<div id="sidebar" class="fixed left-0 top-16 w-64 h-[calc(100vh-64px)] text-white border-r border-primary-dark overflow-y-auto z-40 md:static md:w-64 md:h-screen md:z-auto">
    <!-- Logo Section -->
    <div class="p-6 border-b border-white/10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
            <div class="w-10 h-10 bg-secondary text-primary rounded-lg flex items-center justify-center font-bold text-lg group-hover:scale-110 transition">
                <i class="fas fa-code"></i>
            </div>
            <div>
                <p class="font-bold text-white text-sm">fauziDev</p>
                <p class="text-xs text-white/60">Admin Panel</p>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-primary shadow-sm' : 'text-white/80 hover:bg-white/10' }} transition-all duration-200">
            <i class="fas fa-home w-5 text-center"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.services.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'bg-secondary text-primary shadow-sm' : 'text-white/80 hover:bg-white/10' }} transition-all duration-200">
            <i class="fas fa-briefcase w-5 text-center"></i>
            <span>Layanan</span>
        </a>
        <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.payments.*') ? 'bg-secondary text-primary shadow-sm' : 'text-white/80 hover:bg-white/10' }} transition-all duration-200">
            <i class="fas fa-credit-card w-5 text-center"></i>
            <span>Pembayaran</span>
        </a>
        <a href="{{ route('admin.customers.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.customers.*') ? 'bg-secondary text-primary shadow-sm' : 'text-white/80 hover:bg-white/10' }} transition-all duration-200">
            <i class="fas fa-users w-5 text-center"></i>
            <span>Customers</span>
        </a>
        <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.reports.*') ? 'bg-secondary text-primary shadow-sm' : 'text-white/80 hover:bg-white/10' }} transition-all duration-200">
            <i class="fas fa-chart-bar w-5 text-center"></i>
            <span>Laporan</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:bg-slate-400/20 hover:text-slate-100 transition-colors duration-75">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
