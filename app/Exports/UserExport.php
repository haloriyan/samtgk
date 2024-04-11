<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromView, ShouldAutoSize
{
    public $users;
    public function __construct($props)
    {
        $this->users = $props['users'];
    }
    public function view(): View
    {
        return view('exports.user', [
            'users' => $this->users,
        ]);
    }
}
