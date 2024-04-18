@extends('layouts.admin')

@section('title', "Data Pengguna")

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
    <div class="flex items-center gap-8 justify-end mb-4">
        <form class="border border-slate-300 rounded-lg p-2 w-4/12">
            <div class="text-xs text-slate-400">Cari berdasarkan nama</div>
            <div class="flex grow">
                <input type="text" name="q" class="flex grow h-10 outline-0" value="{{ $request->q }}">
            </div>
        </form>
        <div class="flex grow"></div>
        <a href="{{ route('export.user') }}" class="bg-green-500 hover:bg-green-700 text-white text-sm rounded-lg w-2/12 h-10 flex items-center justify-center">
            Download Excel
        </a>
    </div>
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="detail('{{ $user }}')">
                            <i class="bx bx-show"></i>
                            Detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="DetailModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form action="{{ route('banner.delete') }}" class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Detail Data Pengguna</h2>
                <button type="button" onclick="toggleModal('#DetailModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="flex flex-col grow basis-5/12">
                    <div class="text-slate-500 text-sm">Nama</div>
                    <div class="text-slate-700 font-bold mt-1" id="name"></div>
                </div>
                <div class="flex flex-col grow basis-5/12">
                    <div class="text-slate-500 text-sm">Email</div>
                    <div class="text-slate-700 font-bold mt-1" id="email"></div>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 WhatsappArea mt-4">
                <div class="flex flex-col grow basis-5/12">
                    <div class="text-slate-500 text-sm">NIK</div>
                    <div class="text-slate-700 font-bold mt-1" id="nik"></div>
                </div>
                <div class="flex flex-col grow basis-5/12">
                    <div class="text-slate-500 text-sm">Nomor Polisi</div>
                    <div class="text-slate-700 font-bold mt-1" id="nopol"></div>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 WhatsappArea mt-4">
                <div class="flex flex-col grow basis-5/12">
                    <div class="text-slate-500 text-sm">No. WhatsApp</div>
                    <a class="text-slate-700 font-bold mt-1" target="_blank" id="wa"></a>
                </div>
            </div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button type="button" onclick="toggleModal('#DeleteModal')" class="bg-blue-400 hover:bg-blue-700 text-sm rounded text-white p-2 px-4 mt-5">Tutup</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const detail = data => {
        data = JSON.parse(data);
        toggleModal("#DetailModal");

        select("#DetailModal #name").innerHTML = data.name;
        select("#DetailModal #email").innerHTML = data.email;
        select("#DetailModal #nik").innerHTML = data.nik;
        select("#DetailModal #nopol").innerHTML = data.nopol;
        select("#DetailModal #wa").innerHTML = `+62 ${data.whatsapp}`;
        select("#DetailModal #wa").setAttribute('href', `https://wa.me/62${data.whatsapp}`);
    }
</script>
@endsection