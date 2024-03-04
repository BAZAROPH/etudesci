<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function bannerIndex(){
        $elements = Banners::all();
        return view('admin.banners.index', [
            'medias' => $elements,
        ]);
    }

    public function spotIndex(){
        $elements = Banners::all();
        return view('admin.banners.index', [
            'medias' => $elements,
        ]);
    }

    public function storeBanner(Request $request){
        $request->validate([
            'media' => 'required',
        ]);

        $banner = Banners::create([
            'text' => $request->text,
            'link' => $request->link,
        ]);

        if(!is_null($banner)){
            $banner->addMediaFromRequest('media')->toMediaCollection('banners');
        }

        return redirect()->back();
    }
}
