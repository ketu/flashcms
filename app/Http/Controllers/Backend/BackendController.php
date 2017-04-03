<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class BackendController extends Controller
{
    protected function render($view = null, $data = [], $mergeData = [])
    {
        // dd.xx
        // vv/sss
        $splitter = '';
        $viewParts = [];
        if (strpos($view, '.') !== false) {
            $splitter = '.';
            $viewParts = explode('.', $view);
        } else {
            $splitter = '/';
            $viewParts = explode('/', $view);
        }

        $backendViewFolder = Config::get('flashcms.backend.view');


        if ($viewParts[0] != $backendViewFolder) {
            array_unshift($viewParts, $backendViewFolder);
        }

        $view = join($splitter, $viewParts);
        return view($view, $data, $mergeData);
    }


    protected function getBackendRoutePrefix()
    {
        return Config::get('flashcms.backend.prefix');
    }
}
