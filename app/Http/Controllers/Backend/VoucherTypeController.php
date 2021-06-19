<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VoucherType;
use DataTables;
class VoucherTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $voucher_type = VoucherType::latest()->get();
        if ($request->ajax()) {
            $data = VoucherType::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editType">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteType">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.voucherType.list_voucher_type',compact('voucher_type'));
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
        //
//        $this->validate($request, [
//            'name' => 'required',
//            'type' => 'required',
//
//        ]);
//
//        $property = new Property();
//        $property->name = $request->name;
//        $property->type = $request->type;
//
//        $property->save();
//
//        return response()->json(['success'=>'Property saved successfully.']);
        VoucherType::updateOrCreate(['id' => $request->type_id],
            ['name' => $request->name]);

        return response()->json(['success'=>'Type voucher saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $voucher_type = VoucherType::find($id);
        return response()->json($voucher_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',

        ]);

        $voucher_type = VoucherType::find($request->id);
        $voucher_type->name = $request->name;

        $voucher_type->save();

        return response()->json(['success'=>'type voucher saved successfully.']);
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
        VoucherType::find($id)->delete();

        return response()->json(['success'=>'type voucher deleted successfully.']);
    }
}
