<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class DashboardController extends BackendController
{
    //
    public function dashboard(Request $request)
    {

        return $this->render('backend.layout', [

        ]);
    }
}
