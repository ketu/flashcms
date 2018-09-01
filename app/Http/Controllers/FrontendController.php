<?php

namespace App\Http\Controllers;

use App\FlashCMS\Helpers\FlashCMS;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class FrontendController extends Controller
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

        $backendViewFolder = FlashCMS::getFrontendView();// Config::get('flashcms.frontend.view');


        if ($viewParts[0] != $backendViewFolder) {
            array_unshift($viewParts, $backendViewFolder);
        }

        $view = join($splitter, $viewParts);
        return view($view, $data, $mergeData);
    }


    protected function getFrontendRoutePrefix()
    {
        return FlashCMS::getFrontendPrefix();//Config::get('flashcms.frontend.prefix');
    }
}
