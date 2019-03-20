<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscription;
use App\Event;

class InscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $inscription = new Inscription();
        $inscription->name = $request->input('name');
        $inscription->email = $request->input('email');
        $inscription->bond_id = $request->input('bond');
        $inscription->area = $request->input('area');
        $inscription->institution = $request->input('institution');
        $inscription->phone = $request->input('phone');

        return Event::find($request->input('eventId'))->first()->createInscription($inscription);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Inscription::find($id)->first(), 200);
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
        try {
            $inscription = auth()->user()->events()->find($request->input('eventId'))->first()->inscriptions()->find($id)->first();
            $inscription->genre_id = $request->input('genreId');
            $inscription->save();
            return response($inscription, 200);
        } catch (\Exception $e) {
            return response(['error' => $e->errorInfo], 500);
        }
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
