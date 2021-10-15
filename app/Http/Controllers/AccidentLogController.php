<?php

namespace App\Http\Controllers;

use App\Models\AccidentLog;
use Illuminate\Http\Request;

class AccidentLogController extends Controller
{
    public function index()
    {
        $logs = AccidentLog::all()->toArray();
        return array_reverse($logs);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'location' => 'max:255',
            'licence_plate' => 'max:30',
            'flight_number' => 'max:30',
            'injured_people' => 'max:30',
            'description' => 'max:255',
            'date' => 'required|date',
        ]);

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

        return response()->json(['success_message'=>'The log successfully created']);
    }

    public function edit($id)
    {
        $log = AccidentLog::find($id);
        return response()->json($log);
    }

    public function update(Request $request, $id)
    {
        $log = AccidentLog::find($id);
        $log->update($request->all());

        return response()->json(['success_message'=>'The log successfully updated']);
    }

    public function destroy($id)
    {
        $log = AccidentLog::find($id);
        $log->delete();

        return response()->json(['success_message'=>'The log successfully deleted']);
    }
}
