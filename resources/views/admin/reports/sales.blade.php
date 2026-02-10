@extends('layouts.admin')

@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <a href="{{ route('admin.reports.index') }}" class="text-primary hover:text-primary/80 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-4xl font-bold text-white mb-2">Laporan Penjualan</h1>
        <p class="text-slate-400">Analisis data penjualan dan pesanan</p>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Total Penjualan</p>
                <p class="text-3xl font-bold text-white">Rp{{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Rata-rata Nilai Order</p>
                <p class="text-3xl font-bold text-primary">Rp{{ number_format($averageOrderValue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Pesanan Tertunda</p>
                <p class="text-3xl font-bold text-amber-700">Rp{{ number_format($pendingAmount, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Filter -->
        <form method="GET" class="bg-slate-800 rounded-xl border border-slate-700 p-6 mb-8">
            <div class="grid md:grid-cols-5 gap-4 items-end">
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Dari Tanggal</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Hingga Tanggal</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div></div>
                <button type="submit" class="w-full px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition font-semibold">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>

        <!-- Sales Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Daftar Pesanan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Layanan</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-300">Total</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold">{{ $order->project_name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $order->service->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-right text-white font-semibold">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'completed') bg-emerald-900/20 text-emerald-700
                                    @elseif($order->status === 'in_progress') bg-blue-900/20 text-blue-700
                                    @elseif($order->status === 'pending') bg-amber-900/20 text-amber-700
                                    @else bg-slate-900/20 text-slate-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                Tidak ada data pesanan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-700">
                {{ $orders->links() }}
            </div>
        </div>
@endsection
