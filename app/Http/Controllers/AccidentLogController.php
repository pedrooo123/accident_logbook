<?php

namespace App\Http\Controllers;

use App\Models\AccidentLog;
use Illuminate\Http\Request;

class AccidentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = AccidentLog::all()->toArray();
        return array_reverse($logs);
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
        $log = new AccidentLog([
            'type' => $request->input('type'),
            'location' => $request->input('location'),
            'licence_plate' => $request->input('licence_plate'),
            'flight_number' => $request->input('flight_number'),
            'injured_people' => $request->input('injured_people'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);
        $log->save();

        return response()->json('The log successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccidentLog  $accidentLog
     * @return \Illuminate\Http\Response
     */
    public function show(AccidentLog $accidentLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccidentLog  $accidentLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $log = AccidentLog::find($id);
        return response()->json($log);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccidentLog  $accidentLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $log = AccidentLog::find($id);
        $log->update($request->all());

        return response()->json('The log successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccidentLog  $accidentLog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = AccidentLog::find($id);
        $log->delete();

        return response()->json('The log successfully deleted');
    }
}
