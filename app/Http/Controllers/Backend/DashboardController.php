<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends BackendController
{
    //
    public function dashboard(Request $request)
    {

        return $this->render('backend.layout', [

        ]);
    }
}
