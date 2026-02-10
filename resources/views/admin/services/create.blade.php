@extends('layouts.admin')

@section('page-title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="mb-6">
    <div>
        <h1 class="text-2xl font-bold">{{ isset($service) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h1>
        <p class="text-slate-400 text-sm mt-1">
            <a href="{{ route('admin.services.index') }}" class="hover:underline">Layanan</a>
            / {{ isset($service) ? 'Edit' : 'Tambah' }}
        </p>
    </div>
</div>

<div>
            @if($errors->any())
            <div class="mb-6 p-4 bg-danger/10 text-danger rounded-lg border border-danger/20">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="bg-slate-800 rounded-xl border border-slate-700 p-8 max-w-2xl">
                <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}">
                    @csrf
                    @if(isset($service))
                        @method('PUT')
                    @endif

                    <!-- Nama -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">Nama Layanan</label>
                        <input type="text" name="name" value="{{ $service->name ?? old('name') }}" required
                            class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:border-primary transition @error('name') border-danger @enderror">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" required
                            class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:border-primary transition resize-none @error('description') border-danger @enderror">{{ $service->description ?? old('description') }}</textarea>
                    </div>

                    <!-- Icon -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">Icon (Font Awesome Class)</label>
                        <input type="text" name="icon" value="{{ $service->icon ?? old('icon') }}" placeholder="fa-globe"
                            class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:border-primary transition @error('icon') border-danger @enderror">
                        <p class="text-xs text-slate-400 mt-1">Contoh: fa-globe, fa-paint-brush, fa-mobile-alt</p>
                    </div>

                    <!-- Features -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">Fitur (Pisahkan dengan koma)</label>
                        <textarea name="features" rows="3" placeholder="Responsive Design, SEO Friendly, Fast Loading"
                            class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:border-primary transition resize-none @error('features') border-danger @enderror">
                            @if($service)
{{ is_array($service->features) ? implode(', ', $service->features) : (is_string($service->features) ? json_encode($service->features) : '') }}
                            @endif
{{ old('features') }}
                        </textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-8">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" name="is_active" value="1" {{ (isset($service) && $service->is_active) || old('is_active') ? 'checked' : '' }}
                                class="w-4 h-4">
                            <span class="text-sm font-semibold">Aktif</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition font-semibold">
                            {{ isset($service) ? 'Update' : 'Tambah' }}
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition font-semibold">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
@endsection
