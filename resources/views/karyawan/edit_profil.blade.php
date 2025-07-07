@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-8">
    <div class="max-w-xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Profil
            </h1>
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Foto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                    <div class="flex items-center space-x-4 mb-2">
                        @if($karyawan->foto)
                            <img src="{{ asset('storage/foto_karyawan/'.$karyawan->foto) }}" alt="Foto Profil" class="w-16 h-16 rounded-full object-cover border">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/*" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                    </div>
                    <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ $karyawan->nama }}" required
                        class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ $karyawan->jabatan }}" required
                        class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" />
                </div>
                <div class="flex items-center space-x-4 mt-6">
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-200 shadow">
                        Simpan
                    </button>
                    <a href="{{ route('beranda') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-all duration-200 shadow">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection