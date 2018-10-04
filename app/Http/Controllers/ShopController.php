<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(){
        $products = Product::inRandomOrder()->take(8)->get();
        
        return view('shop', compact ('products'));
    }
            
} 
