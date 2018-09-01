<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-13
 */

namespace App\Http\Controllers;


use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function index(Request $request)
    {

        return $this->render('home');
    }
}