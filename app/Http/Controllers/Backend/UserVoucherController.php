<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\PropertyVoucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Model\Voucher;
use App\Model\VoucherUser;
use App\Model\Property;
use DB;
use App\Product;
use App\Model\UserVoucherPro;
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
            ->select('voucher_users.*','vouchers.name_voucher')->orderBy('id','DESC')
            ->get();
        $voucher =  DB::table('vouchers')->join('property_voucher','property_voucher.voucher_id','=','vouchers.id')->get();
        return view('Admin.voucherUser.list_voucher_user',[
            'voucher_user'=>$voucher_user,
            'voucher'=>$voucher,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

    }
    private function mapProperties($properties)
    {
        return collect($properties)->map(function ($i) {
            return ['value' => $i];
        });
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
        $user_v = VoucherUser::query()->join('vouchers','voucher_users.voucher_id','vouchers.id')
            ->select('voucher_users.*','vouchers.name_voucher','vouchers.golf_course')
            ->find($id);
        // dd($user_v);
        //list temp
        $list_tem =PropertyVoucher::query()->join('properties','property_voucher.property_id','properties.id')
            ->where('voucher_id', $user_v->voucher_id)
            ->get();
        //dd($list_tem);
        return view('Admin.voucherUser.template.show',compact('user_v','list_tem'));
    }

    public function addVoucherUser(Request $request)
    {
////        dd($request->all());
//        $data = $request->validate([
//            'voucher_user_id'=>'',
//            'voucher_id' => 'required',
//            'property_id'=>'required',
//           'value ' =>'required',
//        ]);
        $voucher_user_pro = Product::create($request->all());

        $properties = collect($request->input('properties', []))
            ->map(function ($property){
               return ['value' => $property];
            });
        //dd($properties);
        $voucher_user_pro->properties()->sync($properties);
//        $voucher_user_pro = new UserVoucherPro();
//        $voucher_user_pro->voucher_user_id = $request->user_id;
//        $voucher_user_pro->voucher_id = $request->voucher_id;
//        $voucher_user_pro->property_id = $request->property;
//        $voucher_user_pro->value = $request->value;
//
//        $voucher_user_pro->save();
        //$voucher_user_pro->properties()->attach($this->mapProperties($data['properties']));

        return redirect()->route('admin.user_voucher.index');
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
