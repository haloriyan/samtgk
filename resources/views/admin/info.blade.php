@extends('layouts.admin')

@section('title', "Informasi")

@php
    use Carbon\Carbon;
@endphp
    
@section('header.right')
<a href="{{ route('info.create') }}">
    <button class="bg-blue-500 hover:bg-blue-700 text-white p-2 px-3 rounded text-sm">
        <i class="bx bx-plus"></i>
        Tambah Data
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

<div class="bg-white rounded-lg shadow p-8">
    <table class="table w-full border-collapse">
        <thead class="text-left">
            <tr>
                <th class="p-2"><i class="bx bx-image"></i></th>
                <th class="p-2">Judul</th>
                <th class="p-2">Tanggal Publikasi</th>
                <th class="p-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infos as $info)
                <tr class="even:bg-gray-100 hover:bg-gray-200">
                    <td class="p-2">
                        <img src="{{ asset('storage/info_images/' . $info->featured_image) }}" alt="{{ $info->title }}" class="h-16 object-cover rounded aspect-video">
                    </td>
                    <td>{{ $info->title }}</td>
                    <td class="p-2">{{ Carbon::parse($info->created_at)->isoFormat('DD MMM Y') }}</td>
                    <td class="p-2 flex items-center gap-4">
                        <a href="{{ route('info.edit', $info->id) }}" class="flex items-center">
                            <div class="bg-green-500 hover:bg-green-700 text-white text-sm rounded p-2 px-3">
                                <i class="bx bx-edit"></i>
                                Edit
                            </div>
                        </a>
                        <button class="bg-red-500 hover:bg-red-700 text-white text-sm rounded p-2 px-3" onclick="del('{{ $info }}')">
                            <i class="bx bx-trash"></i>
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection