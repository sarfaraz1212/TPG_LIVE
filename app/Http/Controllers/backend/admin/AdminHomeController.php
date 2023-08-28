<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
   public function viewlogin() 
   {
        return view('backend.admin.login');
   }

   public function viewdashboard() 
   {
        return view('backend.admin.dashboard');
   }
   
}
