<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;

class IndexController extends Controller
{
    public function index(){
        
        $pages = Page::getPagesForFrontend('header', 0);
        $page = $pages[0];
        
        return view('frontend.page', compact('page'));
    }
}
