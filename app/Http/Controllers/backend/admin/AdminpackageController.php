<?php

namespace App\Http\Controllers\backend\admin;
use App\Models\Packages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminpackageController extends Controller
{
    public function view()
    {
        return view ('backend.admin.packages.add');
    }

    public function add_package(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'packagename' => 'required',
            'packageduration' => 'required',
            'packageprice'    => 'required|numeric',
        ],
        [
            'packagename.required' => 'Name is required',
            'packageprice.numeric' => 'Price must be in numbers',
        ]);

        if($validate->passes())
        {
            $package_add                   =  new Packages();
            $package_add->package_name     = $request->packagename;
            $package_add->package_duration = $request->packageduration;
            $package_add->package_price    = $request->packageprice;

            if($package_add->save())
            {
                session()->flash('success','Package added Successfully!');
                return redirect()->back();
            }
            else
            {
                session()->flash('error','Error! Please try again later');
                return redirect()->back();
            }
            
        }
        else
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    public function get_fee(Request $request)
    {
        $id            = $request->id;
        $package       = Packages::find($id);
        if($package)
        {
            $package_price = $package->package_price;
            return response()->json(['package_price' => $package_price]);
        }
    }

    public function list(Request $request)
    {
        $packages = Packages::all();
        return view('backend.admin.packages.list',['packages'=>$packages]);
    }
    

 
}
