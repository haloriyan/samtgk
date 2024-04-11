@extends('layouts.admin')

@section('title', "Penyuratan")

@php
    use Carbon\Carbon;
@endphp

@section('head.dependencies')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
@endsection

@section('header.right')
<button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="toggleModal('#CreateModal')">
    <i class="bx bx-plus"></i>
    Tambah Data
</button>
@endsection
    
@section('content')
<div class="flex mobile:flex-col gap-4 mt-8">
    <div class="flex items-center w-4/12 mobile:w-full bg-white p-8 rounded-lg shadow">
        <div class="flex flex-col grow">
            <div class="text-xs text-slate-400">Surat Masuk</div>
            <div class="text-2xl font-black text-slate-800">{{ $masuk_count }}</div>
        </div>
        <div class="h-12 aspect-square rounded-full flex items-center justify-center bg-cyan-200 text-cyan-600">
            <i class="bx bx-down-arrow-alt text-2xl"></i>
        </div>
    </div>
    <div class="flex items-center w-4/12 mobile:w-full bg-white p-8 rounded-lg shadow">
        <div class="flex flex-col grow">
            <div class="text-xs text-slate-400">Surat Keluar</div>
            <div class="text-2xl font-black text-slate-800">{{ $keluar_count }}</div>
        </div>
        <div class="h-12 aspect-square rounded-full flex items-center justify-center bg-purple-200 text-purple-600">
            <i class="bx bx-down-arrow-alt text-2xl"></i>
        </div>
    </div>
    <div class="flex items-center w-4/12 mobile:w-full bg-white p-8 rounded-lg shadow">
        <div class="flex flex-col grow">
            <div class="text-xs text-slate-400">Surat Disposisi</div>
            <div class="text-2xl font-black text-slate-800">{{ $disposisi_count }}</div>
        </div>
        <div class="h-12 aspect-square rounded-full flex items-center justify-center bg-green-200 text-green-600">
            <i class="bx bx-envelope text-2xl"></i>
        </div>
    </div>
</div>

<div class="mt-8 flex gap-8 justify-end">
    <button class="bg-green-500 hover:bg-green-700 text-white text-sm rounded p-2 px-3" onclick="toggleModal('#FilterModal')">
        <i class="bx bx-cog"></i>
        Filter Pencarian
        @if ($filter_count > 0)
            ({{ $filter_count}})
        @endif
    </button>
</div>

@if ($message != "")
    <div class="bg-green-500 text-white rounded p-3 mt-8">
        {{ $message }}
    </div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $err)
        <div class="bg-red-500 text-white rounded p-3 mt-8">
            {{ $err }}
        </div>
    @endforeach
@endif
    

<div class="bg-white rounded-lg shadow p-6 mt-8">
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2">Nomor</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Arah</th>
                <th class="p-2">Pengirim</th>
                <th class="p-2">Kepada</th>
                <th class="p-2">Perihal</th>
                <th class="p-2">Sifat</th>
                <th class="p-2">Jenis</th>
                <th class="p-2">Petugas</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surats as $surat)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->nomor }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ Carbon::parse($surat->tanggal)->isoFormat('DD MMM Y') }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ ucwords($surat->arah) }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->pengirim }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->kepada }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->perihal }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->sifat }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->jenis }}</td>
                    <td class="p-2 text-slate-500 text-sm">{{ $surat->admin->name }}</td>
                    <td class="p-2">
                        <a href="{{ asset('storage/surat/' . $surat->filename) }}" class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-xs" target="_blank">
                            <i class="bx bx-show mr-1"></i>
                            Lihat File
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-8">
        {{ $surats->links() }}
    </div>
</div>

<div id="FilterModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-6/12 mobile:w-10/12">
        <form class="p-8 flex grow flex-col">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Filter Data</h2>
                <button type="button" onclick="toggleModal('#FilterModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="text-sm text-slate-500 mb-2">Nomor Surat :</div>
            <input type="text" name="nomor" id="nomor" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" value="{{ $request->nomor }}">

            <div class="flex items-center gap-8 mt-6 mb-6">
                <hr class="flex grow" color="#ddd" />
                <div>atau</div>
                <hr class="flex grow" color="#ddd" />
            </div>

            <div class="flex gap-6 items-center">
                <div class="flex grow text-slate-500">Isi dari</div>
                <div class="flex grow text-slate-700 font-bold">Arah Surat</div>
                <div class="flex grow text-slate-500">adalah</div>
                <select name="arah" id="arah" class="bg-slate-100 w-6/12 rounded h-14 p-1 ps-3 pe-3 outline-0">
                    <option value="">Semua Arah</option>
                    @foreach (arahSurat() as $arah)
                        <option value="{{ strtolower($arah) }}" {{ $arah == $request->arah ? "selected" : ""}}>{{ ucwords($arah) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-6 items-center mt-4">
                <div class="flex grow text-slate-500">Isi dari</div>
                <div class="flex grow text-slate-700 font-bold">Pengirim</div>
                <div class="flex grow text-slate-500">seperti</div>
                <input type="text" name="pengirim" id="pengirim" value="{{ $request->pengirim }}" class="bg-slate-100 w-6/12 rounded h-14 p-1 ps-3 pe-3 outline-0">
            </div>
            <div class="flex gap-6 items-center mt-4">
                <div class="flex grow text-slate-500">Isi dari</div>
                <div class="flex grow text-slate-700 font-bold">Kepada</div>
                <div class="flex grow text-slate-500">seperti</div>
                <input type="text" name="kepada" id="kepada" value="{{ $request->kepada }}" class="bg-slate-100 w-6/12 rounded h-14 p-1 ps-3 pe-3 outline-0">
            </div>
            <div class="flex gap-6 items-center mt-4">
                <div class="flex grow text-slate-500">Isi dari</div>
                <div class="flex grow text-slate-700 font-bold">Perihal</div>
                <div class="flex grow text-slate-500">seperti</div>
                <input type="text" name="perihal" id="perihal" value="{{ $request->perihal }}" class="bg-slate-100 w-6/12 rounded h-14 p-1 ps-3 pe-3 outline-0">
            </div>

            <div class="mt-6 flex gap-4 justify-end">
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4">Terapkan Filter Pencarian</button>
            </div>
        </form>
    </div>
</div>

<div id="CreateModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-6/12 mobile:w-10/12">
        <form action="{{ route('surat.store') }}" class="p-8 flex grow flex-col" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Tambah Data Surat</h2>
                <button type="button" onclick="toggleModal('#CreateModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex flex-row gap-4 mt-6">
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Nomor Surat :</div>
            <input type="text" name="nomor" id="nomor" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Tanggal :</div>
                    <input type="text" name="tanggal" id="tanggal" required placeholder="Tanggal" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
            </div>

            <div class="text-sm text-slate-500 mb-2 mt-6">Arah :</div>
            <select name="arah" id="arah" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required>
                <option value="">Pilih...</option>
                @foreach (arahSurat() as $arah)
                    <option value="{{ strtolower($arah) }}">{{ ucwords($arah) }}</option>
                @endforeach
            </select>

            <div class="flex flex-row gap-4 mt-6">
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Pengirim :</div>
                    <input type="text" name="pengirim" id="pengirim" required placeholder="Pengirim" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Kepada :</div>
                    <input type="text" name="kepada" id="kepada" required placeholder="Kepada" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
            </div>

            <div class="flex flex-row gap-4 mt-6">
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Perihal :</div>
                    <input type="text" name="perihal" id="perihal" required placeholder="Perihal" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
                <div class="flex flex-col w-6/12">
                    <div class="text-sm text-slate-500 mb-2">Sifat :</div>
                    <input type="text" name="sifat" id="sifat" required placeholder="Sifat" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
                </div>
            </div>

            <div class="text-sm text-slate-500 mb-2 mt-6">Jenis Surat :</div>
            <input type="text" name="jenis" id="jenis" required placeholder="Permohonan, Surat Tugas, Surat Jalan, dll" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">

            <div class="text-sm text-slate-500 mb-2 mt-6">Upload File :</div>
            <div class="bg-slate-100 p-2 px-4 rounded flex items-center gap-4">
                <input type="file" name="file" id="file" class="hidden" onchange="readFileName(this, '#filename')">
                <div id="filename" class="text-sm flex grow cursor-pointer" onclick="select('#file').click()">Tidak ada file dipilih</div>
                <button type="button" class="bg-white p-1 px-3 rounded text-blue-500 text-sm" onclick="select('#file').click()">Pilih File</button>
            </div>

            <div class="mt-6 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4" type="button" onclick="toggleModal('#CreateModal')">Batalkan</button>
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#CreateModal #tanggal", {
        dateFormat: 'Y-m-d'
    })
</script>
@endsection