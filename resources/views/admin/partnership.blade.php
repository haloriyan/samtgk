@extends('layouts.admin')

@section('title', "Rekam Data Kerjasama")

@php
    use Carbon\Carbon;
@endphp
    
@section('content')
<div class="bg-white rounded-lg p-3 flex items-center justify-center gap-4">
    <a href="{{ route('admin.partnership', 'rju') }}" class="flex grow items-center justify-center gap-4 rounded-lg text-sm h-12 {{ $type == 'rju' ? 'bg-blue-500 text-white font-bold' : 'text-blue-500'}}">
        Retribusi Jasa Usaha
    </a>
    <a href="{{ route('admin.partnership', 'pap') }}" class="flex grow items-center justify-center gap-4 rounded-lg text-sm h-12 {{ $type == 'pap' ? 'bg-blue-500 text-white font-bold' : 'text-blue-500'}}">
        Pajak Air Permukaan
    </a>
</div>

<div class="bg-white shadow p-8 rounded-lg mt-8">
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2"><i class="bx bx-user"></i> User</th>
                <th class="p-2"><i class="bx bx-calendar"></i> Tanggal Pengajuan</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">{{ $data->user->name }}</td>
                    <td class="p-2">{{ Carbon::parse($data->created_at)->isoFormat('DD MMMM Y') }}</td>
                    <td class="p-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm" onclick="detail('{{ base64_encode($data) }}')">
                            <i class="bx bx-show"></i> Detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="DetailModal" class="fixed top-0 left-0 right-0 bottom-0 z-10 bg-gray-400 bg-opacity-75 hidden row items-center justify-center">
    <div class="bg-white rounded-lg shadow-dark w-5/12 mobile:w-10/12">
        <form class="p-8 flex grow flex-col" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="flex gap-8 items-center mb-6">
                <h2 class="text-xl text-slate-700 flex grow">Detail Permohonan</h2>
                <button type="button" onclick="toggleModal('#DetailModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div id="renderForm" class="flex gap-4 flex-wrap"></div>

            <div class="mt-8 border-t-2 flex gap-4 justify-end">
                <button class="bg-gray-200 text-sm rounded p-2 px-4 mt-5" type="button" onclick="toggleModal('#DetailModal')">Tutup</button>
                {{-- <button class="bg-red-400 hover:bg-red-700 text-sm rounded text-white p-2 px-4 mt-5">Hapus</button> --}}
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const detail = data => {
        data = JSON.parse(atob(data));
        let record = JSON.parse(data.record);
        toggleModal("#DetailModal");
        select("#DetailModal #renderForm").innerHTML = "";
        record.forEach((item, i) => {
            if (item.type !== "view") {
                let el = document.createElement('div');
                el.classList.add('flex', 'flex-col', 'gap-2', 'grow');
                el.style.flexBasis = "32%";
                el.innerHTML = `<div class="text-slate-500 text-sm">${item.label}</div><div class="text-slate-700 font-bold">${item.value}</div>`;
                select("#DetailModal #renderForm").appendChild(el);
            }
        })
    }
</script>
@endsection