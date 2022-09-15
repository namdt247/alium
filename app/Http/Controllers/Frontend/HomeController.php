<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 17/02/2017
 * Time: 21:45 CH
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(){
        return view('frontend.home');
    }

}