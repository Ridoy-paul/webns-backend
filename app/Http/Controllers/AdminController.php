<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Artisan;
use Cache;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {   
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'admin_helper') {
            return view('backend.dashboard');
        }

        return Redirect()->route('index');
    }

    function clearCache(Request $request)
    {
        // Artisan::call('optimize:clear');
        // flash('Cache cleared successfully')->success();
        // return back();
    }

    
    



}
