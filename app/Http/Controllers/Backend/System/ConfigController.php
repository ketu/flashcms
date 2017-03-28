<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Backend\BackendController;
use App\Models\System\Config;
use Illuminate\Http\Request;

class ConfigController extends BackendController
{
    public function index(Request $request)
    {

        $configs = [];
        $collection = Config::all();
        foreach($collection as $config){
            $configs[$config->group][] = $config;
        }

       return $this->render('system.config', ['configs'=> $configs]);
    }
}