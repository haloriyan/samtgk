@extends('layouts.admin')

@section('title', "Administrator")

@section('header.right')
<button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="toggleModal('#CreateModal')">
    <i class="bx bx-plus"></i>
    Tambah Admin
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
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $adm)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">{{ $adm->name }}</td>
                    <td class="p-2">{{ $adm->email }}</td>
                    <td class="p-2">
                        <button class="bg-green-500 hover:bg-green-700 text-white p-2 px-3 rounded text-sm" onclick="edit('{{ $adm }}')">
                            <i class="bx bx-edit"></i>
                            Edit
                        </button>
                        @if ($adm->id != $admin->id)
                            <button class="bg-red-500 hover:bg-red-700 text-white p-2 px-3 rounded text-sm" onclick="del('{{ $adm }}')">
                                <i class="bx bx-trash"></i>
                                Hapus
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="CreateModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('admin.store') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Tambah User Administrator</h2>
                <button type="button" onclick="toggleModal('#CreateModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="text-sm text-slate-500 mb-2">Nama :</div>
            <input type="text" name="name" required placeholder="Nama" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-sm text-slate-500 mb-2 mt-6">Email :</div>
            <input type="email" name="email" required placeholder="Email" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-sm text-slate-500 mb-2 mt-6">Password :</div>
            <input type="password" name="password" required placeholder="Password" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DeleteModal')">Batalkan</button>
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4 mt-5">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
<div id="EditModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('admin.update') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Edit User Administrator</h2>
                <button type="button" onclick="toggleModal('#EditModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="text-sm text-slate-500 mb-2">Nama :</div>
            <input type="text" name="name" id="name" required placeholder="Password" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-sm text-slate-500 mb-2 mt-6">Email :</div>
            <input type="email" name="email" id="email" required placeholder="Email" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-sm text-slate-500 mb-2 mt-6">Ubah Password :</div>
            <input type="password" name="password" id="password" placeholder="Password" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0">
            <div class="text-xs text-slate-500 mb-2 mt-2">Biarkan kosong apabila tidak ingin mengganti password</div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DeleteModal')">Batalkan</button>
                <button class="bg-green-400 hover:bg-green-700 text-sm rounded text-white p-2 px-4 mt-5">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div id="DeleteModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('admin.delete') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Hapus Administrator</h2>
                <button type="button" onclick="toggleModal('#DeleteModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div>
                Yakin ingin menghapus administrator <span id="name"></span>? Data yang sudah terhapus tidak dapat dipulihkan kembali
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
    const edit = data => {
        data = JSON.parse(data);
        toggleModal('#EditModal');
        select('#EditModal #id').value = data.id;
        select('#EditModal #name').value = data.name;
        select('#EditModal #email').value = data.email;
    }
    const del = data => {
        data = JSON.parse(data);
        toggleModal('#DeleteModal');
        select('#DeleteModal #id').value = data.id;
        select('#DeleteModal #name').innerHTML = data.name;
    }
</script>
@endsection