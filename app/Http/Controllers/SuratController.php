<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'nomor' => "unique:surats"
        ], [
            'nomor.unique' => "Nomor surat telah digunakan, mohon gunakan yang lain dan coba kembali"
        ]);
        $admin = Auth::guard('admin')->user();
        $nomor = $request->nomor;
        if ($nomor == "") {
            $nomor = rand(111111, 999999);
        }
        $file = $request->file('file');
        $fileName = $nomor."_".$file->getClientOriginalName();

        $saveData = Surat::create([
            'admin_id' => $admin->id,
            'nomor' => $nomor,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'sifat' => $request->sifat,
            'pengirim' => $request->pengirim,
            'kepada' => $request->kepada,
            'jenis' => $request->jenis,
            'arah' => $request->arah,
            'filename' => $fileName,
        ]);

        $file->storeAs('public/surat', $fileName);

        return redirect()->route('admin.surat');
    }
}
