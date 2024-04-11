<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function fetch(Request $request) {
        $limit = $request->limit ?? 5;
        $infos = Info::orderBy('created_at', 'DESC')->paginate($limit);
        $infos->increment('hit');
        
        return response()->json([
            'infos' => $infos,
        ]);
    }
    public function read($id) {
        $q = Info::where('id', $id);
        $q->increment('hit');
        $info = $q->first();
        
        return response()->json([
            'info' => $info,
        ]);
    }
    public function create() {
        $admin = Auth::guard('admin')->user();

        return view('admin.info.create', [
            'admin' => $admin,
        ]);
    }
    public function edit($id) {
        $admin = Auth::guard('admin')->user();
        $info = Info::where('id', $id)->first();

        return view('admin.info.edit', [
            'admin' => $admin,
            'info' => $info,
        ]);
    }
    public function store(Request $request) {
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();
        $admin = Auth::guard('admin')->user();

        $saveData = Info::create([
            'admin_id' => $admin->id,
            'featured_image' => $imageFileName,
            'title' => $request->title,
            'body' => $request->body,
            'labels' => $request->label,
            'hit' => 0,
        ]);

        $image->storeAs('public/info_images', $imageFileName);

        return redirect()->route('admin.info')->with([
            'message' => "Berhasil mempublikasikan informasi"
        ]);
    }
    public function update($id, Request $request) {
        $data = Info::where('id', $id);
        $info = $data->first();

        $toUpdate = [
            'title' => $request->title,
            'body' => $request->body,
            'label' => $request->label,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName();
            if ($info->featured_image != null) {
                $deleteOldImage = Storage::delete('public/info_images/' . $info->featured_image);
            }
            $toUpdate['featured_image'] = $imageFileName;
            $image->storeAs('public/info_images', $imageFileName);
        }

        $updateData = $data->update($toUpdate);
        
        return redirect()->route('admin.info')->with([
            'message' => "Berhasil mempublikasikan perubahan informasi"
        ]);
    }
    public function handleBodyImage(Request $request) {
        $upl = $request->file('upload');
        $ogName = $upl->getClientOriginalName();
        $fileName = pathinfo($ogName, PATHINFO_FILENAME);
        $extension = $upl->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        $upl->storeAs('public/info_medias', $fileName);
        $url = asset('storage/info_medias/' . $fileName);

        return response()->json([
            'fileName' => $fileName,
            'uploaded' => 1,
            'url' => $url,
        ]);
    }
}
