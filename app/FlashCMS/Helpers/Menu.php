<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-6-12
 */

namespace App\FlashCMS\Helpers;


use Illuminate\Support\Facades\Request;

class Menu
{
    public static function isActive($url = '', $backend = true)
    {
        if ($backend) {
            $prefix = FlashCMS::getBackendPrefix();
            $url = $prefix . ($url? '/'.ltrim($url, '/'):"");
        }

        return Request::is($url);
    }


}