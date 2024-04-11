@extends('layouts.admin')

@section('title', "Jenis Layanan")
    
@section('header.right')
<a href="{{ route('layanan.create') }}">
    <button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="toggleModal('#CreateModal')">
        <i class="bx bx-plus"></i>
        Tambah Jenis layanan
    </button>
</a>
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

<div class="bg-white rounded-lg p-8 shadow">
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2">Nama Layanan</th>
                <th class="p-2">Persyaratan</th>
                <th class="p-2">Alur</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layanans as $layanan)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">{{ $layanan->name }}</td>
                    <td class="p-2">
                        @foreach (explode("||", $layanan->requirement) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </td>
                    <td class="p-2">
                        @foreach (explode("||", $layanan->flow) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </td>
                    <td class="p-2">
                        <a href="{{ route('layanan.edit', $layanan->id) }}">
                            <button class="bg-green-500 hover:bg-green-700 text-white p-2 px-3 rounded text-sm">
                                <i class="bx bx-edit"></i>
                                Edit
                            </button>
                        </a>
                        <button class="bg-red-500 hover:bg-red-700 text-white p-2 px-3 rounded text-sm" onclick="del('{{ $layanan }}')">
                            <i class="bx bx-trash"></i>
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="DeleteModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('layanan.delete') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Hapus Layanan</h2>
                <button type="button" onclick="toggleModal('#DeleteModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div>
                Yakin ingin menghapus layanan ini? Data yang sudah terhapus tidak dapat dipulihkan kembali
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
</script>
@endsection