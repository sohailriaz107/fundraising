<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class FundraisingController extends Controller
{
    //
    public function home(){
      $funds=Campaign::all();
        return view('fund.index',compact('funds'));
    }
      public function about(){
        return view('fund.about');
    }
      public function blog(){
        return view('fund.blog');
    }
      public function blog_single(){
        return view('fund.blog-single');
    }
      public function contact(){
        return view('fund.contact');
    }
      public function gallary(){
        return view('fund.gallery');
    }
      public function How_Works(){
        return view('fund.how-it-works');
    }
      public function donate(){
        return view('fund.donate');
    }
}
