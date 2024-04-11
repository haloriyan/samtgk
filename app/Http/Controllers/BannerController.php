<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function store(Request $request) {
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();

        $saveData = Banner::create([
            'link' => $request->link,
            'filename' => $imageFileName,
            'hit' => 0,
            'location' => "HOME"
        ]);

        $image->storeAs('public/banner_images', $imageFileName);

        return redirect()->route('admin.banner')->with([
            'message' => "Berhasil menambahkan banner"
        ]);
    }
    public function delete(Request $request) {
        $data = Banner::where('id', $request->id);
        $banner = $data->first();

        $deleteData = $data->delete();
        $deleteFile = Storage::delete('public/banner_images/' . $banner->filename);
        
        return redirect()->route('admin.banner')->with([
            'message' => "Berhasil menghapus banner"
        ]);
    }
    public function update(Request $request) {
        $data = Banner::where('id', $request->id);
        $banner = $data->first();

        $toUpdate = ['link' => $request->link];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName();
            $deleteOldFile = Storage::delete('public/banner_images/' . $banner->filename);
            $image->storeAs('public/banner_images', $imageFileName);
            $toUpdate['filename'] = $imageFileName;
        }

        $updateData = $data->update($toUpdate);
        
        return redirect()->route('admin.banner')->with([
            'message' => "Berhasil mengubah data banner"
        ]);
    }
    public function hit(Request $request) {
        $data = Banner::where('id', $request->id);

        $updateData = $data->increment('hit');

        return response()->json(['ok']);
    }
}
