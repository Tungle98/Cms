<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Model\Airport;
use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class AirportController extends Controller
{
    //
    public function index()
    {
        $airports = Airport::all();
        //dd($airports);
        return view('Admin.airport.list_service_airport',[
            'airports'=>$airports,
        ]);
    }
    public function get()
    {

        $d['airports'] = Airport::orderby('id', 'DESC')->get();
        return view('Admin.airport.getTableData', $d);
    }
    public function store(Request $request)
    {
        $airport_db = new Airport();
        $airport_db->code = $request->code;
        $airport_db->purchase_representative =$request->purchase_representative;
        $airport_db->total_ticket = $request->total_ticket;
        $airport_db->flight_date = $request->flight_date;
        $airport_db->flight_hour = $request->flight_hour;
        $airport_db->flight_number = $request->flight_number;
        $airport_db->bundled_service = $request->bundled_service;
        $airport_db->status = $request->status;
        $airport_db->money = $request->money;
        $airport_db->user_id = $request->user_id;
        $airport_db->save();



        return redirect()->back()->with('message', 'Create service Successfully');
    }

    public function edit(Request $request, $id)
    {
      $airport_edit = Airport::find($id);
        return response()->json($airport_edit);
    }
    public function update(Request $request)
    {
        $request->validate([
            'code' => 'required|max:255',
            'purchase_representative' => '',
            'flight_hour' => '',
            'total_ticket' =>'',
            'flight_date' => '',
            'flight_number' => '',
            'status' => '',
            'money' => '',
            'bundled_service' => '',
        ]);

        $airport_db = Airport::find($request->id);

        $airport_db->code = $request->name_voucher;
        $airport_db->purchase_representative = $request->purchase_representative;
        $airport_db->flight_hour = $request->flight_hour;
        $airport_db->total_ticket = $request->total_ticket;
        $airport_db->money = $request->money;
        $airport_db->status = $request->status;
        $airport_db->flight_date = $request->flight_date;
        $airport_db->flight_number = $request->flight_number;
        $airport_db->bundled_service = $request->bundled_service;

        $airport_db->save();
        echo "done";
    }

    //export ra file excell
    //thêm export sau đường dẫn để export file
    public function export()
    {
        return Excel::download(new UsersExport, 'airports.xlsx');
    }

}
