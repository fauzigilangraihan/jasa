@extends('layouts.admin')

@section('page-title', $customer->name)

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <a href="{{ route('admin.customers.index') }}" class="text-primary hover:text-primary/80 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-4xl font-bold text-white mb-2">{{ $customer->name }}</h1>
        <p class="text-slate-400">{{ $customer->email }}</p>
    </div>
</div>

<!-- Customer Info & Stats -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Pesanan</div>
                <div class="text-3xl font-bold text-white">{{ $totalOrders }}</div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Pesanan Selesai</div>
                <div class="text-3xl font-bold text-emerald-700">{{ $completedOrders }}</div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Pesanan Menunggu</div>
                <div class="text-3xl font-bold text-amber-700">{{ $pendingOrders }}</div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Belanja</div>
                <div class="text-3xl font-bold text-primary">Rp{{ number_format($totalSpending, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="md:col-span-1 bg-slate-800 rounded-xl border border-slate-700 p-6">
                <h2 class="text-xl font-bold text-white mb-6">Informasi Customer</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Nama</p>
                        <p class="text-white font-semibold">{{ $customer->name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Email</p>
                        <p class="text-white font-semibold">{{ $customer->email }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Telepon</p>
                        <p class="text-white font-semibold">{{ $customer->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Perusahaan</p>
                        <p class="text-white font-semibold">{{ $customer->company_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Alamat</p>
                        <p class="text-white font-semibold">{{ $customer->address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Bergabung</p>
                        <p class="text-white font-semibold">{{ $customer->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="md:col-span-2 bg-slate-800 rounded-xl border border-slate-700 p-6">
                <h2 class="text-xl font-bold text-white mb-6">Pesanan Terbaru</h2>
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($orders->take(5) as $order)
                    <div class="p-4 bg-slate-700/50 rounded-lg border border-slate-600 hover:border-primary transition">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="font-semibold text-white">{{ $order->project_name }}</p>
                                <p class="text-sm text-slate-400">{{ $order->service->name ?? 'N/A' }}</p>
                            </div>
                            <span class="text-sm px-3 py-1 rounded font-semibold
                                @if($order->status === 'completed') bg-emerald-900/20 text-emerald-700
                                @elseif($order->status === 'in_progress') bg-blue-900/20 text-blue-700
                                @elseif($order->status === 'pending') bg-amber-900/20 text-amber-700
                                @else bg-slate-900/20 text-slate-700 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-slate-400">
                            <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            <span>{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-center py-8">Belum ada pesanan</p>
                    @endforelse
                </div>
                @if($orders->count() > 5)
                <div class="mt-4 pt-4 border-t border-slate-600">
                    <a href="#" class="text-primary hover:text-primary/80 text-sm font-semibold">Lihat semua pesanan →</a>
                </div>
                @endif
            </div>
        </div>

        <!-- Payments History -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
            <h2 class="text-xl font-bold text-white mb-6">Riwayat Pembayaran</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Jumlah</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Metode</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold">
                                {{ $payment->order->project_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-white font-semibold">
                                Rp{{ number_format($payment->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <i class="fas fa-credit-card mr-2"></i>{{ ucfirst($payment->payment_method) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($payment->status === 'confirmed') bg-emerald-900/20 text-emerald-700
                                    @elseif($payment->status === 'pending') bg-amber-900/20 text-amber-700
                                    @else bg-slate-900/20 text-slate-700 @endif">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $payment->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                Belum ada pembayaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($payments->count() > 0)
            <div class="mt-4 pt-4 border-t border-slate-600">
                {{ $payments->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection
