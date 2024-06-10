<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OtpController;
use App\Models\Banner;
use App\Models\Info;
use App\Models\Layanan;
use App\Models\PaymentLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function privacy() {
        return view('privacy');
    }
    public function download() {
        $filePath = public_path('SAGARA_Connect.apk');
        return file_exists($filePath) ? response()->download($filePath) : abort(404);
    }
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
        $request->validate([
            'email' => "required|unique:users",
            'name' => "required",
            'password' => "required|min:6"
        ], [
            'unique' => 'Email telah digunakan. Mohon gunakan alamat email lainnya',
            'required' => ":Attribute tidak boleh kosong",
            'min' => ":Attribute paling tidak ada :min karakter"
        ]);

        $token = Str::random(16);
        $saveData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'token' => $token,
        ]);

        return response()->json([
            'status' => 200,
            'user' => $saveData,
        ]);
    }
    public function forgetPassword(Request $request) {
        $email = $request->email;
        $res = [
            'status' => 404,
            'message' => "Kami tidak dapat menemukan akun dengan email Anda",
            'token' => null,
            'user' => null,
        ];

        $data = User::where('email', $email);
        $user = $data->first();

        if ($user != "") {
            $res['status'] = 200;
            $res['token'] = Str::random(32);
            $res['message'] = "Berhasil mengirim OTP";
            $data->update(['token' => $res['token']]);
            $res['user'] = $data->first();
            $createOtp = OtpController::create($user, 'reset_password');
        }

        return response()->json($res);
    }
    public function resetPassword(Request $request) {
        $data = User::where('id', $request->user_id);
        $data->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => 200
        ]);
    }
    public function update(Request $request) {
        $u = User::where('token', $request->token);
        $u->update([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
        ]);
    }
    public function auth(Request $request) {
        $user = User::where('token', $request->token)->first();

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }
    public function logout(Request $request) {
        $u = User::where('token', $request->token);
        $u->update(['token' => null]);
        return response()->json([
            'ok'
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
    public function home(Request $request) {
        $banners = Banner::orderBy('updated_at', 'DESC')->get();
        $socials = config('app')['socials'];
        $infos = Info::orderBy('created_at', 'DESC')->with('admin')->paginate(5);
        $layanans = Layanan::all();
        $user = null;
        Log::info($request->t);

        if ($request->t != "") {
            $user = User::where('token', $request->t)->first();
        }

        return response()->json([
            'user' => $user,
            'banners' => $banners,
            'socials' => $socials,
            'infos' => $infos,
            'layanans' => $layanans,
        ]);
    }
    public function paymentLink() {
        $links = PaymentLink::all();

        return response()->json([
            'links' => $links,
        ]);
    }
}
