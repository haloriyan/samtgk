@extends('layouts.admin')

@section('title', "Lokasi Layanan")

@section('header.right')
<a href="{{ route('lokasi.create') }}">
    <button class="bg-green-500 hover:bg-green-700 text-white p-2 px-3 rounded text-sm" onclick="toggleModal('#CreateModal')">
        <i class="bx bx-plus"></i>
        Tambah Lokasi
    </button>
</a>
@endsection
    
@section('content')
<div class="flex flex-wrap gap-8">
    @foreach ($lokasis  as $lokasi)
        <div class="bg-white rounded-lg shadow p-4 flex flex-col grow w-3/12 relative">
            <img src="{{ asset('storage/lokasi_images/' . $lokasi->image) }}" alt="{{ $lokasi->name }}" class="w-100 aspect-video rounded-lg object-cover">
            <div class="text-lg text-slate-700 font-bold mt-2">{{ $lokasi->name }}</div>
            <div class="flex flex-col gap-2 mt-2">
                <a href="{{ $lokasi->gmaps_link }}" target="_blank" class="flex gap-2 text-slate-500">
                    <i class="bx bx-map mt-1"></i>
                    <div class="text-xs">{{ $lokasi->address }}</div>
                </a>
            </div>

            <div class="flex gap-4 items-center mt-4">
                <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="flex grow justify-center p-2 rounded text-sm bg-green-500 text-white">
                    Edit
                </a>
                <div class="flex grow justify-center p-2 rounded text-sm bg-red-500 text-white cursor-pointer" onclick="del('{{ $lokasi }}')">
                    Hapus
                </div>
            </div>

            <div class="absolute top-0 right-0 m-4 bg-blue-500 text-white rounded text-sm p-1 px-3">
                {{ $lokasi->bentuk }}
            </div>
        </div>
    @endforeach
</div>

<div class="h-16"></div>

<div id="DeleteModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('lokasi.delete') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Hapus Lokasi Pelayanan</h2>
                <button type="button" onclick="toggleModal('#DeleteModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div>
                Yakin ingin menghapus lokasi ini? Data yang sudah terhapus tidak dapat dipulihkan kembali
            </div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DeleteModal')">Batalkan</button>
                <button class="bg-red-400 hover:bg-red-700 text-sm rounded text-white p-2 px-4 mt-5">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('javascript')
<script>
    const del = data => {
        data = jsonEscape(data);
        console.log(data);
        data = JSON.parse(data);
        toggleModal("#DeleteModal");
        select("#DeleteModal #id").value = data.id;
    }
</script>
@endsection