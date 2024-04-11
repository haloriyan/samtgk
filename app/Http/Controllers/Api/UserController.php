<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Info;
use App\Models\PaymentLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request) {
        $u = User::where('email', $request->email);
        $user = $u->first();
        $status = 401;
        $message = "Kombinasi email dan password tidak tepat";

        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                $token = Str::random(16);
                $u->update(['token' => $token]);
                $user = $u->first();
                $message = "Berhasil login";
                $status = 200;
            }
        } else {
            $message = "Kami tidak dapat menemukan akun Anda";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'user' => $user,
        ]);
    }
    public function register(Request $request) {
        $token = Str::random(16);
        $saveData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'token' => $token,
        ]);

        return response()->json([
            'status' => 200,
            'user' => $saveData,
        ]);
    }
    public function auth(Request $request) {
        $user = User::where('token', $request->token)->first();

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }
    public function submitWa(Request $request) {
        $u = User::where('token', $request->token);
        $u->update([
            'nopol' => $request->nopol,
            'nik' => $request->nik,
            'whatsapp' => $request->whatsapp,
        ]);

        return response()->json(['ok']);
    }
    public function home() {
        $banners = Banner::orderBy('updated_at', 'DESC')->get();
        $socials = config('app')['socials'];
        $infos = Info::orderBy('created_at', 'DESC')->with('admin')->paginate(5);

        return response()->json([
            'banners' => $banners,
            'socials' => $socials,
            'infos' => $infos,
        ]);
    }
    public function paymentLink() {
        $links = PaymentLink::all();

        return response()->json([
            'links' => $links,
        ]);
    }
}
