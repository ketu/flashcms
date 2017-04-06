<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstallerController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('installer.index');
    }
}
