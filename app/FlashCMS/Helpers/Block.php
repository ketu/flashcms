<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-6-12
 */

namespace App\FlashCMS\Helpers;

use App;
use Illuminate\Support\Facades\Request;
use App\Models\Cms\Block as BlockModel;


class Block
{
    public static function show($code)
    {
        $block = BlockModel::where("slug", $code)->first();
        if ($block) {
            echo $block->content;
        }
    }
}