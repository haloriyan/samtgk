<?php

namespace App\Http\Controllers;

use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentLinkController extends Controller
{
    public function store(Request $request) {
        $image = $request->file('image');
        $imageFileName = rand(1111, 9999)."_".$image->getClientOriginalName();

        $saveData = PaymentLink::create([
            'name' => $request->name,
            'link' => $request->link,
            'image' => $imageFileName,
        ]);

        $image->storeAs('public/payment_link_images', $imageFileName);

        return redirect()->route('admin.paymentLink')->with(([
            'message' => "Berhasil menambahkan data pembayaran online"
        ]));
    }
    public function update(Request $request) {
        $data = PaymentLink::where('id', $request->id);
        $payment = $data->first();
        $toUpdate = [
            'name' => $request->name,
            'link' => $request->link,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = rand(1111, 9999)."_".$image->getClientOriginalName();
            $toUpdate['image'] = $imageFileName;
            if ($payment->image != null) {
                $deleteOldImage = Storage::delete('public/payment_link_images/' . $payment->image);
            }
            $image->storeAs('public/payment_link_images', $imageFileName);
        }

        $data->update($toUpdate);

        return redirect()->route('admin.paymentLink')->with(([
            'message' => "Berhasil mengubah data pembayaran online"
        ]));
    }
    public function delete(Request $request) {
        $data = PaymentLink::where('id', $request->id);
        $payment = $data->first();

        $deleteData = $data->delete();
        if ($payment->image != null) {
            $deleteImage = Storage::delete('public/payment_link_images/' . $payment->image);
        }
        
        return redirect()->route('admin.paymentLink')->with(([
            'message' => "Berhasil menghapus data pembayaran online"
        ]));
    }
}
