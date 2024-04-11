<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function user() {
        $now = Carbon::now();
        $filename = "Data Pengguna - Exported on " . $now->format('d M Y_H:i:s') . '.xlsx';
        $users = User::all();

        return Excel::download(new UserExport([
            'users' => $users
        ]), $filename);
    }
}
