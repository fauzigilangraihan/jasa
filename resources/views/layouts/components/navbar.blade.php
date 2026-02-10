<!-- Top Bar -->
<div class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-30 shadow-sm">
    <div class="flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold text-primary truncate">@yield('page-title', 'Admin Panel')</h1>
        <div class="flex items-center space-x-3 md:space-x-4">
            <span class="text-sm md:text-base text-slate-600 hidden sm:inline font-medium">{{ auth()->user()->name }}</span>
            <div class="w-8 md:w-10 h-8 md:h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>
</div>
