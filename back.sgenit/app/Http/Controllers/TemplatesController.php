<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Template;
use App\FooterImage;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = auth()->user()->templates()->with('footerImage')->get();
        foreach ($templates as $template) {
            $template->footerImage->url = FooterImage::getByTemplateId($template->id)->publicUrl;
        }
        return response($templates, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template();
        $template->title = $request->input('title');
        $template->description = $request->input('description');
        $template = auth()->user()->createTemplate($template);

        $file = base64_decode($request->input('file_base64'));

        $footer = new FooterImage();
        $footer->original_name = explode('.', $request->input('original_name'))[0];
        $footer->file_extension = explode('.', $request->input('original_name'))[1];
        $footer->hash_name = md5($footer->original_name);
        Storage::disk('footers')->put(auth()->user()->id . '/' . $footer->hash_name . '.' . $footer->file_extension, $file);
        return $template->createFooterImage($footer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $template = auth()->user()->templates()->find($id)->first();
            $file = auth()->user()->footerImages()->find($template->footer_image_id)->first();
            $file->url = $file->publicUrl;
            $template->footer_image = $file;
            return response($template, 200);
        } catch (\Exception $e) {
            return response(['error' => $e->errorInfo], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
