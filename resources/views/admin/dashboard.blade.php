@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
    <!-- Total Customers Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Customers</p>
                <p class="text-3xl font-bold text-primary">{{ $totalClients }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-900/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-blue-700 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Pesanan</p>
                <p class="text-3xl font-bold text-primary">{{ $totalOrders }}</p>
            </div>
            <div class="w-12 h-12 bg-emerald-900/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-shopping-cart text-emerald-700 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Revenue Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Revenue</p>
                <p class="text-2xl font-bold text-primary">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-emerald-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Payments Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Pending Pembayaran</p>
                <p class="text-3xl font-bold text-warning">{{ $pendingPayments }}</p>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-amber-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Payments Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-900/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-list text-blue-700"></i>
            </div>
            <h2 class="text-lg font-bold text-slate-900">Pesanan Terbaru</h2>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-primary/30 transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                    <p class="font-semibold text-slate-900">#{{ $order->id }} - {{ $order->user->name }}</p>
                    <span class="inline-flex items-center text-sm px-3 py-1 rounded-full w-fit
                        @if($order->status === 'completed') bg-emerald-900/20 text-emerald-700
                        @elseif($order->status === 'in_progress') bg-blue-900/20 text-blue-700
                        @else bg-amber-100 text-amber-700 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <p class="text-slate-600 text-sm">Rp{{ number_format($order->total_amount, 0, ',', '.') }} • {{ $order->created_at->format('d M Y') }}</p>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-inbox text-slate-300 text-3xl mb-2 block"></i>
                <p class="text-slate-500 text-sm">Belum ada pesanan</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-emerald-900/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-credit-card text-emerald-700"></i>
            </div>
            <h2 class="text-lg font-bold text-slate-900">Pembayaran Terbaru</h2>
        </div>
        <div class="space-y-3">
            @forelse($pendingPayments as $payment)
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-primary/30 transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                    <p class="font-semibold text-slate-900">{{ $payment->order->user->name }}</p>
                    <span class="inline-flex items-center text-sm px-3 py-1 rounded-full w-fit
                        @if($payment->status === 'confirmed') bg-green-100 text-green-700
                        @elseif($payment->status === 'pending') bg-amber-100 text-amber-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                <p class="text-slate-600 text-sm">Rp{{ number_format($payment->amount, 0, ',', '.') }} • {{ $payment->created_at->format('d M Y H:i') }}</p>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-inbox text-slate-300 text-3xl mb-2 block"></i>
                <p class="text-slate-500 text-sm">Belum ada pembayaran</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
