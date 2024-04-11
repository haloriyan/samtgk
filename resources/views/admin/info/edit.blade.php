@extends('layouts.admin')

@section('title', "Edit Data Informasi")
    
@section('content')
<form action="{{ route('info.update', $info->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg p-8 shadow">
    @csrf
    <div class="flex items-center gap-4">
        <div class="flex flex-col grow">
            <div class="font-bold text-slate-700">Featured Image</div>
            <div class="text-sm text-slate-500">Gambar utama yang ditampilkan</div>
        </div>
        <div class="bg-gray-200 p-2 px-4 rounded flex items-center gap-4">
            <input type="file" name="image" id="image" class="hidden" onchange="readFileName(this, '#filename')">
            <div id="filename" class="text-sm">{{ $info->featured_image == null ? 'Tidak ada file dipilih' : $info->featured_image }}</div>
            <button type="button" class="bg-green-500 p-1 px-3 rounded text-white" onclick="select('#image').click()">Ganti File</button>
        </div>
    </div>
    
    <div class="text-sm text-slate-700 mb-2 mt-6">Judul</div>
    <input type="text" name="title" class="bg-slate-100 w-full rounded h-14 p-1 ps-3 pe-3 outline-0" value="{{ $info->title}}" required>

    <div class="h-8"></div>

    <div class="text-sm text-slate-700 mb-2 mt-6">Konten</div>
    <div id="editor">{!! $info->body !!}</div>
    <textarea name="body" id="body" rows="10" class="hidden"></textarea>

    <div class="text-sm text-slate-700 mb-2 mt-6">Label</div>
    <div class="bg-slate-100 w-full rounded min-h-14 p-3  outline-0 flex flex-wrap gap-2 items-center">
        <div class="flex gap-2 items-center flex-wrap" id="renderLabel"></div>
        <input type="text" class="bg-transparent h-14 outline-0 flex grow" placeholder="Ketik label" oninput="typeLabel(this)">
    </div>

    <input type="hidden" name="label" id="label" value="{{ $info->label }}">

    <div class="flex mt-8 justify-end">
        <button class="bg-blue-500 text-white p-3 px-5">
            Submit
        </button>
    </div>
</form>
@endsection

@section('javascript')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>
<script>
    let editor;
    let editorDOM = select("#editor");
    let labels = select("input#label").value.split(",");

    const typeLabel = input => {
        let value = input.value;
        let lastChara = value.slice(-1);
        let theLabel = value.slice(0, -1);
        if (lastChara == "," && theLabel != "") {
            labels.push(theLabel);
            renderLabel();
            input.value = "";
        }
    }
    const renderLabel = () => {
        let area = select("#renderLabel");
        area.innerHTML = "";
        labels.map((label, l) => {
            let el = document.createElement('div');
            el.classList.add('p-1', 'px-3', 'rounded-full', 'bg-blue-500', 'text-white', 'text-sm', 'flex', 'items-center', 'gap-2');
            el.innerHTML = `${label} <div class="h-8 flex items-center justify-center cursor-pointer" onclick="removeLabel(${l})"><i class="bx bx-x"></i></div>`;
            area.appendChild(el);
        });
        select("input#label").value = labels.join(',');
    }
    const removeLabel = index => {
        labels.splice(index, 1);
        renderLabel();
    }

    renderLabel();

    if (editorDOM != null) {
        ClassicEditor.create( select( '#editor' ),{
            ckfinder: {
                uploadUrl: "{{route('block.handleBodyImage').'?_token='.csrf_token()}}",
            }
        })
        .then(newEditor => {
            editor = newEditor;
        })
        .catch( error => {
            console.error( error );
        });

        setInterval(() => {
            let bodyData = editor.getData();
            select("#body").value = bodyData;
        }, 50);
    }
</script>
@endsection