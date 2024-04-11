<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Lokasi;
use App\Models\LokasiImage;
use App\Models\LokasiJadwal;
use App\Models\LokasiLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    public function retrieve() {
        $lokasis = Lokasi::with(['layanans', 'jadwals'])->get();

        return response()->json([
            'lokasis' => $lokasis,
        ]);
    }
    public function create() {
        $admin = Auth::guard('admin')->user();
        $layanans = Layanan::all();
        
        return view('admin.lokasi.create', [
            'admin' => $admin,
            'layanans' => $layanans,
        ]);
    }
    public function store(Request $request) {
        $layanans = explode("||", $request->layanan);
        $coordinates = $request->latitude."||".$request->longitude;
        $jadwals = json_decode($request->jadwal);

        $saveData = Lokasi::create([
            'name' => $request->name,
            'bentuk' => $request->bentuk,
            'address' => $request->address,
            'gmaps_link' => $request->gmaps_link,
            'coordinates' => $coordinates,
        ]);

        $images = $request->file('images');
        foreach ($images as $i => $image) {
            $imageFileName = rand(1111, 9999)."_".$image->getClientOriginalName();
            if ($i == 0) {
                $updateDataImage = Lokasi::where('id', $saveData->id)->update([
                    'image' => $imageFileName,
                ]);
            }

            $saveImage = LokasiImage::create([
                'lokasi_id' => $saveData->id,
                'filename' => $imageFileName,
            ]);
            
            $image->storeAs('public/lokasi_images', $imageFileName);
        }

        foreach ($layanans as $layanan) {
            $saveLayanan = LokasiLayanan::create([
                'lokasi_id' => $saveData->id,
                'layanan_id' => $layanan,
            ]);
        }

        foreach ($jadwals as $jadwal) {
            $saveJadwal = LokasiJadwal::create([
                'lokasi_id' => $saveData->id,
                'hari' => $jadwal->hari,
                'jam_mulai' => $jadwal->jam_mulai,
                'jam_selesai' => $jadwal->jam_selesai,
            ]);
        }

        return redirect()->route('admin.lokasi')->with([
            'message' => "Berhasil menambahkan lokasi pelayanan baru"
        ]);
    }
    public function edit($id) {
        $admin = Auth::guard('admin')->user();
        $lokasi = Lokasi::where('id', $id)->with(['jadwals', 'layanans', 'images'])->first();
        $layanans = Layanan::all();

        $layananIDs = [];
        $jadwals = [];
        foreach ($lokasi->layanans as $layanan) {
            array_push($layananIDs, strval($layanan->pivot->layanan_id));
        }
        foreach ($lokasi->jadwals as $jadwal) {
            array_push($jadwals, [
                'hari' => $jadwal->hari,
                'jam_mulai' => $jadwal->jam_mulai,
                'jam_selesai' => $jadwal->jam_selesai,
            ]);
        }

        return view('admin.lokasi.edit', [
            'admin' => $admin,
            'lokasi' => $lokasi,
            'layanans' => $layanans,
            'layananIDs' => $layananIDs,
            'jadwals' => $jadwals,
        ]);
    }
    public function update($id, Request $request) {
        $id = $request->id;
        $data = Lokasi::where('id', $id);
        $lokasi = $data->first();
        $coordinates = $request->latitude."||".$request->longitude;

        $toUpdate = [
            'name' => $request->name,
            'bentuk' => $request->bentuk,
            'address' => $request->address,
            'gmaps_link' => $request->gmaps_link,
            'coordinates' => $coordinates,
        ];

        $updateData = $data->update($toUpdate);

        // HANDLING JADWAL
        $jadwals = json_decode($request->jadwal);
        $deleteAllJadwals = LokasiJadwal::where('lokasi_id', $id)->delete();
        foreach ($jadwals as $jadwal) {
            $saveJadwal = LokasiJadwal::create([
                'lokasi_id' => $id,
                'hari' => $jadwal->hari,
                'jam_mulai' => $jadwal->jam_mulai,
                'jam_selesai' => $jadwal->jam_selesai,
            ]);
        }

        // HANDLING LAYANAN
        $layanans = explode("||", $request->layanan);
        $deleteAllLayanans = LokasiLayanan::where('lokasi_id', $id)->delete();
        foreach ($layanans as $layanan) {
            $saveLayanan = LokasiLayanan::create([
                'lokasi_id' => $id,
                'layanan_id' => $layanan,
            ]);
        }

        return redirect()->route('admin.lokasi')->with([
            'message' => "Berhasil mengubah data lokasi pelayanan"
        ]);
    }

    public function delete(Request $request) {
        $data = Lokasi::where('id', $request->id);
        $lokasi = $data->with(['images'])->first();

        foreach ($lokasi->images as $image) {
            $deleteImage = Storage::delete('public/lokasi_images/' . $image->filename);
        }

        $data->delete();

        return redirect()->route('admin.lokasi')->with([
            'message' => "Berhasil menghapus data lokasi pelayanan"
        ]);
    }
}
