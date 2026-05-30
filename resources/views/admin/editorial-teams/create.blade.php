@extends('layouts.admin')

@section('title', 'Tambah Anggota Redaksi')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-3 mb-2">
        <div class="h-0.5 w-8 bg-red-600"></div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Tambah Anggota</h1>
    </div>
    <div class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase ml-11">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        <a href="{{ route('admin.editorial-teams.index') }}" class="hover:text-red-500 transition-colors">Tim Redaksi</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        <span class="text-red-500">Tambah</span>
    </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl shadow-sm max-w-3xl">
    <form action="{{ route('admin.editorial-teams.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            {{-- Kiri: Foto --}}
            <div class="md:col-span-4 flex flex-col items-center">
                <label class="block text-[11px] font-black text-gray-700 uppercase tracking-widest mb-4">Foto Profil</label>
                <div class="relative group cursor-pointer mb-3">
                    <div class="w-40 h-40 rounded-full border-4 border-gray-50 bg-gray-100 shadow-inner overflow-hidden relative flex items-center justify-center">
                        <img id="photo-preview" src="" class="w-full h-full object-cover hidden">
                        <svg id="photo-placeholder" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        
                        <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all">
                            <span class="text-white text-[10px] font-bold uppercase tracking-widest">Pilih Foto</span>
                        </div>
                    </div>
                    <input type="file" name="photo" id="photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(this)">
                </div>
                <p class="text-[10px] font-medium text-gray-400 text-center">Format: JPG, PNG, WEBP<br>Maks: 2MB. Rasio: 1:1</p>
                @error('photo')
                    <p class="mt-2 text-xs text-red-600 font-bold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kanan: Detail --}}
            <div class="md:col-span-8 space-y-6">
                <div>
                    <label for="name" class="block text-[11px] font-black text-gray-700 uppercase tracking-widest mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm font-medium rounded-xl focus:ring-red-500 focus:border-red-500 block px-4 py-3 transition-colors"
                        placeholder="Contoh: Budi Santoso, S.I.Kom">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-[11px] font-black text-gray-700 uppercase tracking-widest mb-2">Jabatan <span class="text-red-500">*</span></label>
                    <select name="role" id="role" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm font-medium rounded-xl focus:ring-red-500 focus:border-red-500 block px-4 py-3 transition-colors">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($roles as $order => $roleOption)
                            @php
                                $isSingle = in_array($roleOption, $singleRoles);
                                $isTaken  = in_array($roleOption, $takenSingleRoles);
                            @endphp
                            <option value="{{ $roleOption }}"
                                {{ old('role') == $roleOption ? 'selected' : '' }}
                                {{ $isTaken ? 'disabled' : '' }}>
                                {{ $roleOption }}{{ $isTaken ? ' (sudah terisi)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
                    @enderror
                    <p class="text-[10px] font-medium text-gray-400 mt-1">Jabatan Pemimpin, Wakil, dan Redaktur Pelaksana hanya boleh 1 orang.</p>
                </div>

                <div>
                    <label for="description" class="block text-[11px] font-black text-gray-700 uppercase tracking-widest mb-2">Keterangan (Opsional)</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm font-medium rounded-xl focus:ring-red-500 focus:border-red-500 block px-4 py-3 transition-colors"
                        placeholder="Contoh: New Media, Lingkar Barat, dll.">
                    @error('description')
                        <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Urutan otomatis berdasarkan jabatan, tidak perlu diisi --}}
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.editorial-teams.index') }}" class="px-6 py-2.5 text-[11px] font-black text-gray-500 uppercase tracking-widest hover:bg-gray-50 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-800 transition-all shadow-lg active:scale-95">
                Simpan Data
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
                document.getElementById('photo-preview').classList.remove('hidden');
                document.getElementById('photo-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
