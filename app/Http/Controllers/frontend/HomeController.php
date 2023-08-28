<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function viewhome()
    {
        return view('frontend.index');
    }
    public function viewaboutus()
    {
        return view('frontend.about');
    }

    public function viewblog()
    {
        return view('frontend.blog');
    }

    public function viewcontact()
    {
        return view('frontend.contact');
    }

    public function viewfeature()
    {
        return view('frontend.feature');
    }

    public function viewclasses()
    {
        return view('frontend.class');
    }
}
