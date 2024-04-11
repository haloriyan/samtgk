@extends('layouts.admin')

@section('title', "Banner")
    
@section('header.right')
<button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="toggleModal('#CreateModal')">
    <i class="bx bx-plus"></i>
    Tambah Banner
</button>
@endsection

@section('content')
@if ($message != "")
    <div class="bg-green-500 text-white rounded p-3 mb-8">
        {{ $message }}
    </div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $err)
        <div class="bg-red-500 text-white rounded p-3 mb-8">
            {{ $err }}
        </div>
    @endforeach
@endif

<div class="bg-white rounded-lg shadow p-8">
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2"><i class="bx bx-image"></i></th>
                <th class="p-2"><i class="bx bx-link"></i></th>
                <th class="p-2"><i class="bx bx-show"></i></th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">
                        <img src="{{ asset('storage/banner_images/' . $banner->filename) }}" alt="Banner {{ $banner->location }}" class="w-32">
                    </td>
                    <td class="p-2">
                        <a href="{{ $banner->link }}" class="underline text-blue-500" target="_blank">{{ $banner->link }}</a>
                    </td>
                    <td class="p-2 text-sm">{{ $banner->hit }} klik</td>
                    <td class="p-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white p-2 px-3 rounded text-sm" onclick="edit('{{ $banner }}')">
                            <i class="bx bx-edit"></i>
                            Edit
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white p-2 px-3 rounded text-sm" onclick="del('{{ $banner }}')">
                            <i class="bx bx-trash"></i>
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="CreateModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-6/12 mobile:w-10/12">
        <form action="{{ route('banner.store') }}" class="p-8 flex grow flex-col" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Tambah Banner</h2>
                <button type="button" onclick="toggleModal('#CreateModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex flex-col grow">
                    <div class="font-bold text-slate-700">File Gambar</div>
                    <div class="text-sm text-slate-500"> Pilih gambar dari komputer Anda</div>
                </div>
                <div class="bg-gray-200 p-2 px-4 rounded flex items-center gap-4">
                    <input type="file" name="image" id="image" class="hidden" onchange="readFileName(this, '#filename')" required>
                    <div id="filename" class="text-sm">Tidak ada file dipilih</div>
                    <button type="button" class="bg-green-500 p-1 px-3 rounded text-white" onclick="select('#image').click()">Pilih File</button>
                </div>
            </div>

            <div class="text-sm text-slate-500 mb-2 mt-8">Link :</div>
            <input type="text" name="link" required placeholder="Tautan yang akan dilihat user saat klik banner" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-xs text-slate-400 mt-2">Isi "#" jika tidak ada tautan yang dituju</div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DeleteModal')">Batalkan</button>
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4 mt-5">Tambahkan</button>
            </div>
        </form>
    </div>
</div>

<div id="EditModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-6/12 mobile:w-10/12">
        <form action="{{ route('banner.update') }}" class="p-8 flex grow flex-col" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Edit Banner</h2>
                <button type="button" onclick="toggleModal('#EditModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex flex-col grow">
                    <div class="font-bold text-slate-700">File Gambar</div>
                    <div class="text-sm text-slate-500"> Biarkan jika tidak ingin mengganti gambar</div>
                </div>
                <div class="bg-gray-200 p-2 px-4 rounded flex items-center gap-4">
                    <input type="file" name="image" id="image" class="hidden" onchange="readFileName(this, '#filename')">
                    <div id="filename" class="text-sm">Tidak ada file dipilih</div>
                    <button type="button" class="bg-green-500 p-1 px-3 rounded text-white" onclick="select('#image').click()">Pilih File</button>
                </div>
            </div>

            <div class="text-sm text-slate-500 mb-2 mt-8">Link :</div>
            <input type="text" name="link" id="link" required placeholder="Tautan yang akan dilihat user saat klik banner" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-xs text-slate-400 mt-2">Isi "#" jika tidak ada tautan yang dituju</div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DeleteModal')">Batalkan</button>
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4 mt-5">Tambahkan</button>
            </div>
        </form>
    </div>
</div>

<div id="DeleteModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('banner.delete') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Hapus Banner</h2>
                <button type="button" onclick="toggleModal('#DeleteModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div>
                Yakin ingin menghapus banner ini? Data yang sudah terhapus tidak dapat dipulihkan kembali
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
        data = JSON.parse(data);
        toggleModal("#DeleteModal");
        select("#DeleteModal #id").value = data.id;
    }
    const edit = data => {
        data = JSON.parse(data);
        toggleModal("#EditModal");
        select("#EditModal #id").value = data.id;
        select("#EditModal #link").value = data.link;
        select("#EditModal #filename").innerHTML = data.filename;
    }
</script>
@endsection