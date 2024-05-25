@extends('layouts.admin')

@section('title', "Edit Lokasi Pelayanan")

@php
    $coordinates = explode("||", $lokasi->coordinates);
@endphp

@section('content')
<div class="bg-white rounded-lg shadow p-8">
    <form action="{{ route('lokasi.update', $lokasi->id) }}" class="flex flex-col grow" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="initial_layanans" name="initial_layanans" value="{{ json_encode($layananIDs) }}">
        <input type="hidden" id="initial_jadwals" name="initial_jadwals" value="{{ json_encode($jadwals) }}">
        {{-- <input type="hidden" id="initial_images" value="{{ json_encode($lokasi->images) }}"> --}}
        <input type="hidden" id="image_to_delete" name="image_to_delete">

        <div class="flex gap-8 items-center mb-6">
            <h2 class="text-xl text-slate-700 flex grow">Edit Lokasi</h2>
            <button type="button" onclick="toggleModal('#CreateModal')" class="close-btn text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-md aspect-square h-12 flex items-center justify-center">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div id="ImageInputArea" class="flex gap-4 items-center flex-wrap">
            @foreach ($lokasi->images as $img)
                <div class="h-20 aspect-square rounded input_wrapper relative" id="image_{{ $img->id }}">
                    <div class="absolute top-0 left-0 right-0 bottom-0 z-5 bg-white border rounded flex items-center justify-center" style="color: rgba(0, 0, 0, 0.01);background-size: cover; background-repeat: no-repeat; background-position: center center;background-image: url({{ asset('storage/lokasi_images/' . $img->filename) }})">
                        <i class="bx bx-image-add text-2xl"></i>
                    </div>
                    <button type="button" onclick="deleteImage({{ $img->id }})" class="h-6 aspect-square rounded bg-red-100 text-red-500 hover:bg-red-500 hover:text-white z-20 absolute top-0 right-0 mt-1 me-1 text-xs"><i class="bx bx-trash"></i></button>
                </div>
            @endforeach
            <div class="h-20 aspect-square rounded input_wrapper relative" id="wrapper_0">
                <input type="file" name="images[]" id="images_0" class="absolute top-0 left-0 right-0 bottom-0 z-10 h-20 aspect-square opacity-0 cursor-pointer" onchange="readImage(this, '0')">
                <div id="preview_0" class="absolute top-0 left-0 right-0 bottom-0 z-5 bg-white border rounded flex items-center justify-center">
                    <i class="bx bx-image-add text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="flex gap-8">
            <div class="flex flex-col grow">
                <div class="text-sm text-slate-500 mb-2 mt-4 ">Nama :</div>
                <input type="text" name="name" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="{{ $lokasi->name }}">
                <div class="text-sm text-slate-500 mb-2 mt-4">Alamat :</div>
                <textarea name="address" id="address" rows="4" class="bg-slate-100 w-full rounded p-1 ps-3 pe-3 outline-0">{{ $lokasi->address }}</textarea>
                <div class="text-sm text-slate-500 mb-2 mt-4">Link Google Maps :</div>
                <input type="text" name="gmaps_link" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="{{ $lokasi->gmaps_link }}">
    
                <div class="flex gap-8">
                    <div class="flex flex-col grow">
                        <div class="text-sm text-slate-500 mb-2 mt-4">Koordinat Latitude :</div>
                        <input type="text" name="latitude" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="{{ $coordinates[0] }}">
                    </div>
                    <div class="flex flex-col grow">
                        <div class="text-sm text-slate-500 mb-2 mt-4">Koordinat Longitude :</div>
                        <input type="text" name="longitude" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="{{ $coordinates[1] }}">
                    </div>
                </div>
    
                <div class="text-sm text-slate-500 mb-2 mt-4 ">Bentuk Layanan :</div>
                <input type="text" name="bentuk" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="{{ $lokasi->bentuk }}">
            </div>
            <div class="flex flex-col w-6/12">
                <div class="text-sm text-slate-500 mb-2 mt-4">Jenis Layanan yang Tersedia :</div>
                <div class="flex flex-col gap-4 mt-2">
                    @foreach ($layanans as $item)
                        <div class="flex items-center gap-4 rounded-lg border p-4 cursor-pointer {{ in_array($item->id, $layananIDs) ? 'border-green-500' : null }}" onclick="toggleLayanan('{{ $item->id }}', this)">
                            <div class="flex grow text-sm text-slate-700">{{ $item->name }}</div>
                            <div class="h-6 aspect-square rounded-lg border {{ in_array($item->id, $layananIDs) ? 'border-green-500' : 'border-slate-500' }} checkbox flex items-center justify-center">
                                @if (in_array($item->id, $layananIDs))
                                    <div class="h-4 aspect-square rounded bg-green-500"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" class="h-20" name="layanan" id="layanan" value="{{ implode('||', $layananIDs) }}" required>
            </div>
        </div>

        <div class="text-2xl font-bold text-slate-700 mb-2 mt-8">Jadwal Pelayanan :</div>
        <div id="JadwalArea" class="mt-2 flex flex-col gap-4"></div>
        <input type="text" class="h-2 opacity-0" name="jadwal" id="jadwal" required>

        <div class="mt-4 flex justify-end">
            <div class="cursor-pointer text-green-500 text-sm" onclick="addJadwal()">
                <i class="bx bx-plus"></i> Tambah Jadwal
            </div>
        </div>

        <button class="bg-green-500 hover:bg-green-700 text-white h-12 mt-6 rounded-lg font-bold w-full">
            Tambahkan
        </button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    let state = {
        layanan: JSON.parse(select("#initial_layanans").value),
        image: [],
        jadwal: JSON.parse(select("#initial_jadwals").value),
        image_to_delete: [],
    };

    const toggleLayanan = (data, btn) => {
        let index = state.layanan.indexOf(data);
        if (index > -1) {
            state.layanan.splice(index, 1);
            btn.classList.remove('border-green-500');
            btn.childNodes.forEach(child => {
                if (child.classList?.contains('checkbox')) {
                    child.classList.remove('border-green-500');
                    child.innerHTML = ``;
                }
            });
        } else {
            state.layanan.push(data);
            btn.classList.add('border-green-500');
            btn.childNodes.forEach(child => {
                if (child.classList?.contains('checkbox')) {
                    child.classList.add('border-green-500');
                    child.innerHTML = `<div class="h-4 aspect-square rounded bg-green-500"></div>`;
                }
            });
        }
        select("input#layanan").value = state.layanan.join('||');
    }

    const populateInputImage = () => {
        let currentIndex = state.image.length;
        let wrapper = document.createElement("div");
        wrapper.classList.add('h-20', 'aspect-square', 'rounded', 'relative', 'input_wrapper');
        wrapper.setAttribute('id', `wrapper_${currentIndex}`)
        wrapper.innerHTML = `<input type="file" name="images[]" id="images_${currentIndex}" class="absolute top-0 left-0 right-0 bottom-0 z-10 h-20 aspect-square opacity-0 cursor-pointer" onchange="readImage(this, ${currentIndex})">
            <div id="preview_${currentIndex}" class="absolute top-0 left-0 right-0 bottom-0 z-5 bg-white border rounded flex items-center justify-center">
                <i class="bx bx-image-add text-2xl"></i>
            </div>`;

        select("#ImageInputArea").appendChild(wrapper);
    }
    const readImage = (input, index) => {
        let preview = select(`#preview_${index}`);
        let file = input.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);

        reader.addEventListener("load", () => {
            preview.style.color = "rgba(0,0,0,0.01)";
            preview.style.backgroundImage = `url(${reader.result})`;
            preview.style.backgroundSize = "cover";
            preview.style.backgroundRepeat = "no-repeat";
            preview.style.backgroundPosition = "center center";
            state.image.push(file.name);

            // render delete button
            let btn = document.createElement('button');
            btn.setAttribute('type', 'button');
            btn.setAttribute('onclick', `removeImage(${index})`);
            btn.classList.add('h-6', 'aspect-square', 'rounded', 'bg-red-100', 'text-red-500', 'hover:bg-red-500', 'hover:text-white', 'z-20', 'absolute', 'top-0', 'right-0', 'mt-1', 'me-1', 'text-xs');
            btn.innerHTML = `<i class="bx bx-trash"></i>`;
            select(`#wrapper_${index}`).appendChild(btn);

            populateInputImage();
        });
    }
    const removeImage = index => {
        select(`#wrapper_${index}`).remove();
        state.image.splice(index, 1);
    }
    const deleteImage = id => {
        state.image_to_delete.push(id);
        select(`#image_${id}`).remove();
        select("input#image_to_delete").value = state.image_to_delete.join('||');
    }

    const renderJadwal = () => {
        select("#JadwalArea").innerHTML = "";
        state.jadwal.forEach((item, i) => {
            let wrapper = document.createElement('div');
            wrapper.classList.add('flex', 'gap-4', 'items-center');
            wrapper.setAttribute('id', `jadwal_${i}`);
            let wrapperContent = `    <div class="flex flex-col w-6/12">
                <div class="text-sm text-slate-500 mb-2">Hari :</div>
                <input type="text" oninput="typingJadwal(${i}, 'hari', this.value)" name="hari" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="${item.hari}">
            </div>
            <div class="flex flex-col w-3/12">
                <div class="text-sm text-slate-500 mb-2">Jam Mulai :</div>
                <input type="text" oninput="typingJadwal(${i}, 'jam_mulai', this.value)" name="jam_mulai" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="${item.jam_mulai}">
            </div>
            <div class="flex flex-col w-3/12">
                <div class="text-sm text-slate-500 mb-2">Jam Selesai :</div>
                <input type="text" oninput="typingJadwal(${i}, 'jam_selesai', this.value)" name="jam_selesai" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required value="${item.jam_selesai}">
            </div>`;
            if (i > 0) {
                wrapperContent += `<button type="button" onclick="removeJadwal(${i})" class="h-12 text-xl mt-6 aspect-square rounded bg-red-500 hover:bg-red-700 text-white"><i class="bx bx-trash"></i></button>`;
            } else {
                wrapperContent += "<div class='h-14 aspect-square'></div>";
            }

            wrapper.innerHTML = wrapperContent;
            select("#JadwalArea").appendChild(wrapper);
        });
        select("input#jadwal").value = JSON.stringify(state.jadwal);
    }
    const addJadwal = () => {
        state.jadwal.push({
            hari: '', jam_mulai: '', jam_selesai: ''
        });
        renderJadwal();
    }
    const typingJadwal = (index, key, value) => {
        state.jadwal[index][key] = value;
        select("input#jadwal").value = JSON.stringify(state.jadwal);
    }
    const removeJadwal = index => {
        state.jadwal.splice(index, 1);
        renderJadwal();
    }

    renderJadwal();
</script>
@endsection