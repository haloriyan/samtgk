<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    public function create() {
        $admin = Auth::guard('admin')->user();
        return view('admin.layanan.create', [
            'admin' => $admin,
        ]);
    }
    public function store(Request $request) {
        $saveData = Layanan::create([
            'name' => $request->name,
            'requirement' => $request->requirement,
            'flow' => $request->flow,
        ]);

        return redirect()->route('admin.layanan')->with([
            'message' => "Berhasil menambahkan layanan baru"
        ]);
    }
    public function edit($id) {
        $admin = Auth::guard('admin')->user();
        $layanan = Layanan::where('id', $id)->first();

        return view('admin.layanan.edit', [
            'admin' => $admin,
            'layanan' => $layanan,
        ]);
    }
    public function update($id, Request $request) {
        $data = Layanan::where('id', $id);
        $layanan = $data->first();

        // return $request->requirement;

        $data->update([
            'name' => $request->name,
            'requirement' => $request->requirement,
            'flow' => $request->flow,
        ]);

        return redirect()->route('admin.layanan')->with([
            'message' => "Berhasil mengubah layanan"
        ]);
    }
    public function delete(Request $request) {
        $data = Layanan::where('id', $request->id);
        $layanan = $data->first();

        $data->delete();

        return redirect()->route('admin.layanan')->with([
            'message' => "Berhasil menghapus layanan"
        ]);
    }
}
