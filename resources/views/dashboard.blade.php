@extends('layouts.app')

@section('title', 'Dashboard - fauziDev')

@section('content')
<!-- Dashboard Header -->
<section class="pt-20 pb-10 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Dashboard</h1>
                <p class="text-lg opacity-90">Selamat datang, {{ auth()->user()->name }}!</p>
            </div>
            <div class="text-right">
                <p class="text-sm opacity-75">Perusahaan: {{ auth()->user()->company_name ?? 'Tidak ada' }}</p>
                <p class="text-sm opacity-75">Email: {{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <!-- Stats -->
        <div class="grid md:grid-cols-2 gap-6 mb-10">
            <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 mb-2">Total Pesanan</p>
                        <p class="text-4xl font-bold">{{ $totalOrders }}</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 mb-2">Total Pengeluaran</p>
                        <p class="text-4xl font-bold">Rp{{ number_format($totalSpent, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-secondary to-[#FFD93D] rounded-xl flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-6">Pesanan Terakhir</h2>
            @if($orders->count() > 0)
            <div class="overflow-x-auto bg-white rounded-xl border border-slate-200">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Service</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Total</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm">{{ $order->package->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-semibold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'completed') bg-success/10 text-success
                                    @elseif($order->status === 'pending') bg-warning/10 text-warning
                                    @else bg-slate-200 text-slate-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 bg-slate-50 rounded-xl text-center">
                <i class="fas fa-inbox text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-600">Anda belum memiliki pesanan</p>
            </div>
            @endif
        </div>

        <!-- Payments Section -->
        <div>
            <h2 class="text-2xl font-bold mb-6">Riwayat Pembayaran</h2>
            @if($payments->count() > 0)
            <div class="grid gap-4">
                @foreach($payments as $payment)
                <div class="p-6 bg-white border border-slate-200 rounded-xl hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600">Nomor Transaksi</p>
                            <p class="text-lg font-bold">#{{ $payment->transaction_id }}</p>
                            <p class="text-sm text-slate-600 mt-2">Tanggal: {{ $payment->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold">Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold mt-2
                                @if($payment->status === 'completed') bg-success/10 text-success
                                @elseif($payment->status === 'pending') bg-warning/10 text-warning
                                @else bg-danger/10 text-danger @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-8 bg-slate-50 rounded-xl text-center">
                <i class="fas fa-credit-card text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-600">Belum ada riwayat pembayaran</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
