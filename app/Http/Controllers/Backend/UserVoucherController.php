<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Voucher;
use App\Model\VoucherUser;
use App\Model\Property;
use DB;
class UserVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //join user voucher voi voucher
        $voucher_user = DB::table('voucher_users')
            ->join('vouchers','voucher_users.voucher_id','=','vouchers.id')
            //->join('property_voucher','vouchers.id','=','property_voucher.voucher_id')
            ->select('voucher_users.*','vouchers.name_voucher')->orderBy('id','DESC')
            ->get();
           // dd($voucher_user);
        $voucher =  DB::table('vouchers')->join('property_voucher','property_voucher.voucher_id','=','vouchers.id')->get();
        //dd($voucher);
        $voucherWithProperties = Property::query()->with('vouchers')->get();
        //dd($voucherWithProperties->toArray());
        return view('Admin.voucherUser.list_voucher_user',[
            'voucher_user'=>$voucher_user,
            'voucher'=>$voucher,
            'voucherWithProperties'=>$voucherWithProperties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user_vouchers.create');
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
        $request->validate([
            'user_id' => 'required|unique:voucher_users|max:255',
            'full_name' => '',
            'total_voucher' => '',
            'voucher_id' => '',
            'code' => '',
            'status' => '',
            'method_paid'
        ]);
        $voucher_user = new VoucherUser();
        $voucher_user->user_id = $request->user_id;
        $voucher_user->full_name = $request->full_name;
        $voucher_user->total_voucher = $request->total_voucher;
        $voucher_user->voucher_id = $request->voucher_id;
        $voucher_user->code = $request->code;
        $voucher_user->status = $request->status;
        $voucher_user->method_paid = $request->method_paid;

        $voucher_user->save();

        /*return response()->json(['message'=>'brand Added Successfully']);*/
        return redirect()->back()->with('message', 'User  voucher Successfully');
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
        $user_v = VoucherUser::find($id);
        return response()->json(['data'=>$user_v],200);
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
        $voucherEdit =VoucherUser::find($id);
        return response()->json($voucherEdit);
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
        $request->validate([
            'user_id' => '',
            'full_name' => '',
            'total_voucher' => '',
            'voucher_id' => '',
            'code' => '',
            'method_paid' => '',
            'status' => '',
        ]);
        $voucher_user = VoucherUser::find($request->id);
        $voucher_user->user_id = $request->user_id;
        $voucher_user->full_name = $request->full_name;
        $voucher_user->total_voucher = $request->total_voucher;
        $voucher_user->code = $request->code;
        $voucher_user->voucher_id = $request->voucher_id;
        $voucher_user->method_paid = $request->method_paid;
        $voucher_user->status = $request->status;
        $voucher_user->save();

        echo "done";
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
        $voucher_user = VoucherUser::find($id);
        if ($voucher_user){
            $voucher_user->delete();
        }
        //echo "done";
        return back()->with('message', 'Voucher user Deleted Successfully');
    }
}
