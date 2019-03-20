<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Event;
use App\Theme;
use App\Banner;
use App\Workshop;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::with('theme', 'banner', 'workshops')->whereDate('event_end','>', Carbon::now())->get();
        foreach ($events as $key => $event) {
            $event->banner_url = Banner::getByEventId($event->id)->publicUrl;
        }
        return response($events, 200);
    }

    public function privateIndex()
    {
        return response(auth()->user()->events()->with('inscriptions')->get(), 200);
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
        // return Carbon::createFromFormat('d/m/Y', $request->input('eventStart'));
        $event = new Event();
        $event->title =  $request->input('title');
        $event->site_url = $request->input('siteUrl');
        $event->template_id = $request->input('templateId');
        $event->description = $request->input('description');
        $event->subscriptions_start = Carbon::createFromFormat('d/m/Y', $request->input('inscriptionsStart'));
        $event->subscriptions_end = Carbon::createFromFormat('d/m/Y', $request->input('inscriptionsEnd'));
        $event->event_start = Carbon::createFromFormat('d/m/Y', $request->input('eventStart'));
        $event->event_end = Carbon::createFromFormat('d/m/Y', $request->input('eventEnd'));
        $event->location = $request->input('location');
        $event->sponsor = $request->input('sponsor');
        $event->edital = $request->input('edital');
        $event->hours_listener = $request->input('hoursListener');
        $event->hours_staff = $request->input('hoursStaff');

        $theme = new Theme();
        $theme->dark_muted = $request->input('theme.darkMuted');
        $theme->dark_vibrant = $request->input('theme.darkVibrant');
        $theme->light_muted = $request->input('theme.lightMuted');
        $theme->light_vibrant = $request->input('theme.lightVibrant');
        $theme->muted = $request->input('theme.muted');
        $theme->vibrant = $request->input('theme.vibrant');

        $file = base64_decode($request->input('banner.file_base64'));
        $banner = new Banner();
        $banner->original_name = explode('.', $request->input('banner.original_name'))[0];
        $banner->file_extension = explode('.', $request->input('banner.original_name'))[1];
        $banner->hash_name = md5($banner->original_name);
        Storage::disk('banners')->put(auth()->user()->id . '/'. $banner->hash_name . '.' . $banner->file_extension, $file);

        $event = auth()->user()->createEvent($event);
        $event->createBanner($banner);
        $event->createTheme($theme);
        $workshops = $request->input('workshops');
        foreach ($workshops as $workshop) {
            $ws = new Workshop();
            $ws->title = $workshop['title'];
            $ws->description = $workshop['description'];
            $ws->hours = $workshop['hours'];
            $ws->workshop_day = $workshop['workshopDay'];
            $event->createWorkshop($ws);
        }
        return $event;

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
            $event = Event::find($id)->with('theme', 'workshops')->first();
            $event->banner_url = $event->banner->publicUrl;
            return response($event, 200);
        } catch (\Exception $e) {
            return response(['error' => $e->errorInfo], 500);
        }
    }

    public function privateShow($id)
    {
        try {
            $event = auth()->user()->events()->find($id)->first();
            $event->inscriptions = $event->inscriptions()->with('bond', 'genre')->get();
            return response($event, 200);
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
