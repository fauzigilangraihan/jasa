@extends('layouts.admin')

@section('page-title', 'Manajemen Customer')

@section('content')
<div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Manajemen Customer</h1>
            <p class="text-slate-400">Kelola semua pelanggan Anda</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Customers</div>
                <div class="text-3xl font-bold text-white">{{ $customers->total() }}</div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Orders</div>
                <div class="text-3xl font-bold text-primary">
                    {{ \App\Models\Order::whereHas('user', fn($q) => $q->where('role', 'client'))->count() }}
                </div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Revenue</div>
                <div class="text-3xl font-bold text-secondary">
                    Rp{{ number_format(\App\Models\Payment::where('status', 'confirmed')->sum('amount'), 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Daftar Customer</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Perusahaan</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-300">Total Belanja</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold">{{ $customer->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $customer->email }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $customer->company_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-primary/20 text-primary rounded-full text-sm font-semibold">
                                    {{ $customer->orders_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-white font-semibold">
                                Rp{{ number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="inline-flex items-center px-3 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition text-sm font-semibold">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-2 block opacity-50"></i>
                                Belum ada customer
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-700">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
