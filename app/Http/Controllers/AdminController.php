<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Info;
use App\Models\Layanan;
use App\Models\Lokasi;
use App\Models\Partnership;
use App\Models\PaymentLink;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function loginPage(Request $request) {
        if (Auth::guard('admin')->check()) {
            if ($request->r != "") {
                $r = base64_decode($request->r);
                return redirect($r);
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
        $message = Session::get('message');
        
        return view('admin.login', [
            'message' => $message,
            'request' => $request,
        ]);
    }
    public function login(Request $request) {
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$loggingIn) {
            return redirect()->route('admin.loginPage')->withErrors(['Wrong email and password combination']);
        }

        if ($request->r != "") {
            $r = base64_decode($request->r);
            return redirect($r);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
    public function logout() {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.loginPage')->with([
            'message' => "Successfully logged out"
        ]);
    }

    public function dashboard() {
        $admin = Auth::guard('admin')->user();
        $users = User::all(['id']);
        $surats = Surat::all(['id']);
        $partnerships = Partnership::all(['id']);

        return view('admin.dashboard', [
            'admin' => $admin,
            'users' => $users,
            'surats' => $surats,
            'partnerships' => $partnerships,
        ]);
    }
    public function banner() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $banners = Banner::paginate(25);

        return view('admin.banner', [
            'admin' => $admin,
            'message' => $message,
            'banners' => $banners,
        ]);
    }
    public function info() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $infos = Info::paginate(25);

        return view('admin.info', [
            'admin' => $admin,
            'message' => $message,
            'infos' => $infos,
        ]);
    }
    public function layanan() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $layanans = Layanan::all();

        return view('admin.layanan.index', [
            'admin' => $admin,
            'message' => $message,
            'layanans' => $layanans,
        ]);
    }
    public function lokasi() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $lokasis = Lokasi::with(['layanans', 'jadwals'])->get();

        return view('admin.lokasi.index', [
            'admin' => $admin,
            'message' => $message,
            'lokasis' => $lokasis,
        ]);
    }
    public function user(Request $request) {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $filter = [];
        if ($request->q != "") {
            array_push($filter, ['name', 'LIKE', '%'.$request->q.'%']);
        }
        $users = User::where($filter)->paginate(25);

        return view('admin.user', [
            'admin' => $admin,
            'message' => $message,
            'request' => $request,
            'users' => $users,
        ]);
    }
    public function partnership($type) {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $datas = Partnership::where('type', $type)->with('user')->paginate(25);

        return view('admin.partnership', [
            'admin' => $admin,
            'message' => $message,
            'datas' => $datas,
            'type' => $type,
        ]);
    }
    public function paymentLink() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $links = PaymentLink::all();

        return view('admin.paymentLink', [
            'admin' => $admin,
            'message' => $message,
            'links' => $links,
        ]);
    }
    public function surat(Request $request) {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');

        $masuk_count = Surat::where('arah', 'masuk')->get(['id'])->count();
        $keluar_count = Surat::where('arah', 'keluar')->get(['id'])->count();
        $disposisi_count = Surat::where('arah', 'disposisi')->get(['id'])->count();

        $filter = [];
        $filterCount = 0;
        if ($request->nomor != "") {
            array_push($filter, ['nomor', $request->nomor]);
        } else {
            if ($request->pengirim != "") {
                array_push($filter, ['pengirim', 'LIKE', '%'.$request->pengirim.'%']);
                $filterCount++;
            }
            if ($request->kepada != "") {
                array_push($filter, ['kepada', 'LIKE', '%'.$request->kepada.'%']);
                $filterCount++;
            }
            if ($request->perihal != "") {
                array_push($filter, ['perihal', 'LIKE', '%'.$request->perihal.'%']);
                $filterCount++;
            }
            if ($request->arah != "") {
                array_push($filter, ['arah', 'LIKE', '%'.$request->arah.'%']);
                $filterCount++;
            }
        }

        $surats = Surat::where($filter)->orderBy('created_at', 'DESC')->with('admin')->paginate(25);

        return view('admin.surat', [
            'admin' => $admin,
            'message' => $message,
            'surats' => $surats,
            'request' => $request,
            'filter_count' => $filterCount,
            'masuk_count' => $masuk_count,
            'keluar_count' => $keluar_count,
            'disposisi_count' => $disposisi_count,
        ]);
    }

    public function admin() {
        $admin = Auth::guard('admin')->user();
        $message = Session::get('message');
        $admins = Admin::all();

        return view('admin.admin', [
            'admin' => $admin,
            'message' => $message,
            'admins' => $admins,
        ]);
    }
    public function store(Request $request) {
        $saveData = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.admin')->with([
            'message' => "Berhasil menambahkan administrator"
        ]);
    }
    public function update(Request $request) {
        $data = Admin::where('id', $request->id);
        $admin = Auth::guard('admin')->user();
        $toUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password != "") {
            $toUpdate['password'] = bcrypt($request->password);
        }
        
        $updateData = $data->update($toUpdate);

        if ($admin->id == $request->id && $request->password != "") {
            $loggingOut = Auth::guard('admin')->logout();

            return redirect()->route('admin.loginPage')->with([
                'message' => "Berhasil mengubah administrator. Mohon login kembali menggunakan password baru"
            ]);
        } else {
            return redirect()->route('admin.admin')->with([
                'message' => "Berhasil mengubah administrator"
            ]);
        }
    }
    public function delete(Request $request) {
        $data = Admin::where('id', $request->id);
        $deleteData = $data->delete();

        return redirect()->route('admin.admin')->with([
            'message' => "Berhasil menghapus administrator"
        ]);
    }
}
