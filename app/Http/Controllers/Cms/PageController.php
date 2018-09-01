<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-13
 */

namespace App\Http\Controllers\Cms;


use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

use App\Models\Cms\Page;

class PageController extends FrontendController
{
    public function info(Request $request, $slug)
    {
        $page = Page::where(["slug"=> $slug])->firstOrFail();

        $template = $page->template??"page";

        return $this->render('cms/'.$template, ["page"=> $page]);
    }
}