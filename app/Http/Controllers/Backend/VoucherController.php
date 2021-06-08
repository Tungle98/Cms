<?php

namespace App\Http\Controllers\Backend;
use App\Model\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vouchers = Voucher::latest()->paginate(8);
        return view('Admin.voucher.list_voucher',compact('vouchers'))->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vouchers.create');
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
        $r=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $custId = $request->cust_id;
        Voucher::updateOrCreate(['id' => $custId],['name' => $request->name, 'email' => $request->email,'address'=>$request->address]);
        if(empty($request->cust_id))
            $msg = 'Customer entry created successfully.';
        else
            $msg = 'Customer data is updated successfully';
        return redirect()->route('vouchers.index')->with('success',$msg);
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
        return view('vouchers.show',compact('vouchers'));
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

        $where = array('id' => $id);
        $voucher = Voucher::where($where)->first();
        return Response::json($voucher);
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

        $cust = Voucher::where('id',$id)->delete();
        return Response::json($cust);
    }
}
