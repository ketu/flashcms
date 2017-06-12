<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-6-12
 */

namespace App\FlashCMS\Helpers;


use Illuminate\Support\Facades\Config;

class FlashCMS
{
    public static function getBackendPrefix()
    {
        return Config::get('flashcms.backend.prefix');
    }
    public static function getBackendView()
    {
        return Config::get('flashcms.backend.view');
    }

    public static function getFrontendPrefix()
    {
        return Config::get('flashcms.frontend.prefix');
    }
    public static function getFrontendView()
    {
        return Config::get('flashcms.frontend.view');
    }
}