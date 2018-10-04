<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use App\User;

class FrontendController extends Controller
{
    public function page(Page $page){
                
        return view('frontend.page', compact('page'));
    }
}
