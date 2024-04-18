@extends('layouts.admin')

@section('title', "Edit Jenis Layanan")

@section('content')
@if ($errors->count() > 0)
    @foreach ($errors->all() as $err)
        <div class="bg-red-500 text-white rounded p-3 mb-8">
            {{ $err }}
        </div>
    @endforeach
@endif

<div class="bg-white rounded-lg p-8 shadow">
    <a href="{{ route('admin.layanan') }}">
        <i class="bx bx-left-arrow-alt text-lg"></i>
    </a>

    <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
        @csrf
        <div class="text-sm text-slate-500 mb-2 mt-8">Nama Layanan :</div>
        <input type="text" name="name" placeholder="contoh: Balik Nama Kendaraan, Her Tahunan" value="{{ $layanan->name }}" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required>
        
        <input type="hidden" class="h-8 bg-red-500 w-full" name="requirement" id="requirement" value="{{ $layanan->requirement }}">
        <input type="hidden" class="h-8 bg-red-500 w-full" name="flow" id="flow" value="{{ $layanan->flow }}">

        <div class="flex gap-8 mt-8">
            <div class="flex flex-col grow">
                <h3 class="text-lg font-bold text-slate-700 mb-4">Persyaratan</h3>
                <input type="text" name="requirement_input" id="requirement_0" oninput="typing('requirement', 0)" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required>
                <div id="requirement_input_area"></div>

                <div class="flex mt-4 justify-end">
                    <div class="cursor-pointer text-green-500" onclick="addInput('requirement')">
                        <i class="bx bx-plus"></i> Tambah
                    </div>
                </div>
            </div>
            <div class="flex flex-col grow">
                <h3 class="text-lg font-bold text-slate-700 mb-4">Alur</h3>
                <input type="text" name="flow_input" id="flow_0" oninput="typing('flow', 0)" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required>
                <div id="flow_input_area"></div>

                <div class="flex mt-4 justify-end">
                    <div class="cursor-pointer text-green-500" onclick="addInput('flow')">
                        <i class="bx bx-plus"></i> Tambah
                    </div>
                </div>
            </div>
        </div>

        <button class="w-full h-16 bg-green-500 hover:bg-green-700 text-lg font-bold text-white rounded-lg mt-8">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    let state = {
        requirement: select("#requirement").value.split("||"),
        flow: select("#flow").value.split("||"),
    }

    setTimeout(() => {
        state.requirement.map((item, i) => {
            if (i > 0) {
                addInput('requirement', item);
            } else if (i === 0) {
                select("#requirement_0").value = item;
            }
        })
        state.flow.map((item, i) => {
            if (i > 0) {
                addInput('flow', item);
            } else if (i === 0) {
                select("#flow_0").value = item;
            }
        })
    }, 500);

    const typing = (target, index) => {
        let value = select(`#${target}_${index}`).value;
        state[target][index] = value;
        renderToInput(target);
    }
    const renderToInput = target => {
        select(`#${target}`).value = state[target].join("||");
    }
    const addInput = (target, defaultValue = '') => {
        if (defaultValue === "") {
            state[target].push("");
        }
        let dom = document.createElement('div');
        let currentIndex = state[target].length - 1;
        dom.classList.add('flex', 'gap-4', 'items-center', 'mt-4');
        dom.innerHTML = `<input name="${target}_input" id="${target}_${currentIndex}" value="${defaultValue}" oninput="typing('${target}', ${currentIndex})" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" required>
                        <div onclick="removeInput(this, '${target}', '${currentIndex}')" class="h-14 aspect-square cursor-pointer text-red-500 hover:text-white hover:bg-red-500 text-xl rounded-lg flex items-center justify-center"><i class="bx bx-trash"></i>`;
        select(`#${target}_input_area`).appendChild(dom);
        renderToInput(target);
    }
    const removeInput = (dom, target, index) => {
        let area = dom.parentNode;
        area.remove();
        state[target].splice(index, 1);
        renderToInput(target);
    }

</script>
@endsection