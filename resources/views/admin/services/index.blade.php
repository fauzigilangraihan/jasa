@extends('layouts.admin')

@section('page-title', 'Manajemen Layanan')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
    <h1 class="text-2xl font-bold">Manajemen Layanan</h1>
    <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition whitespace-nowrap">
        <i class="fas fa-plus mr-2"></i>Tambah Layanan
    </a>
</div>

<div class="overflow-x-auto">
            @if(session('success'))
            <div class="mb-6 p-4 bg-success/10 text-success rounded-lg border border-success/20">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-xl border border-primary-dark/10 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
                        <thead class="bg-primary-dark/5">
                            <tr>
                                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Nama</th>
                                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary hidden md:table-cell">Deskripsi</th>
                                <th class="px-4 md:px-6 py-3 text-center text-sm font-semibold text-primary">Icon</th>
                                <th class="px-4 md:px-6 py-3 text-center text-sm font-semibold text-primary">Status</th>
                                <th class="px-4 md:px-6 py-3 text-center text-sm font-semibold text-primary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary-dark/10">
                            @forelse($services as $service)
                            <tr class="hover:bg-secondary/50 transition">
                                <td class="px-4 md:px-6 py-4 text-sm md:text-base">{{ $service->name }}</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-slate-600 hidden md:table-cell">{{ Str::limit($service->description, 50) }}</td>
                                <td class="px-4 md:px-6 py-4 text-center">
                                    <i class="fas {{ $service->icon }} text-lg text-primary"></i>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-center">
                                    <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $service->is_active ? 'bg-success/10 text-success' : 'bg-danger/10 text-danger' }}">
                                    {{ $service->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 flex justify-center gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="px-2 md:px-3 py-1 bg-primary/20 text-primary rounded hover:bg-primary/30 transition text-xs md:text-sm">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 md:px-3 py-1 bg-danger/20 text-danger rounded hover:bg-danger/30 transition text-xs md:text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 md:px-6 py-8 text-center text-slate-600">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Belum ada layanan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>

            @if($services->hasPages())
            <div class="mt-6">
                {{ $services->links() }}
            </div>
            @endif
        </div>
@endsection
