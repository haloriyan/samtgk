@extends('layouts.admin')

@section('title', "Dashboard")
    
@section('content')
<div class="flex gap-8 mobile:flex-col">
    <a href="{{ route('admin.user') }}" class="flex flex-col grow p-8 bg-white rounded-lg shadow w-4/12 mobile:w-full">
        <div class="flex gap-4 items-center">
            <div class="flex flex-col grow">
                <div class="text-slate-500 text-sm">Pengguna</div>
                <div class="text-slate-700 font-bold text-2xl">{{ $users->count() }}</div>
            </div>
            <div class="h-14 aspect-square rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                <i class="bx bx-user text-2xl"></i>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.partnership', 'rju') }}" class="flex flex-col grow p-8 bg-white rounded-lg shadow w-4/12 mobile:w-full">
        <div class="flex gap-4 items-center">
            <div class="flex flex-col grow">
                <div class="text-slate-500 text-sm">Permohonan Kerja Sama</div>
                <div class="text-slate-700 font-bold text-2xl">{{ $partnerships->count() }}</div>
            </div>
            <div class="h-14 aspect-square rounded-full bg-green-100 text-green-500 flex items-center justify-center">
                <i class="bx bx-edit text-2xl"></i>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.surat') }}" class="flex flex-col grow p-8 bg-white rounded-lg shadow w-4/12 mobile:w-full">
        <div class="flex gap-4 items-center">
            <div class="flex flex-col grow">
                <div class="text-slate-500 text-sm">Data Surat</div>
                <div class="text-slate-700 font-bold text-2xl">{{ $surats->count() }}</div>
            </div>
            <div class="h-14 aspect-square rounded-full bg-orange-100 text-orange-500 flex items-center justify-center">
                <i class="bx bx-envelope text-2xl"></i>
            </div>
        </div>
    </a>
</div>
@endsection