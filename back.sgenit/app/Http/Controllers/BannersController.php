<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
class BannersController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $file = base64_decode($request->input('file_base64'));

        $banner = new Banner();
        $banner->original_name = explode('.', $request->input('original_name'))[0];
        $banner->file_extension = explode('.', $request->input('original_name'))[1];
        $banner->hash_name = md5($banner->original_name);
        Storage::disk('banners')->put(auth()->user()->id . '/' . $banner->hash_name . '.' . $banner->file_extension, $file);
        return auth()->user()->createFooterImage($banner);
    }
}
