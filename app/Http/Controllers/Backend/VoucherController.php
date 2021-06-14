<?php

namespace App\Http\Controllers\Backend;
use App\Model\Voucher;
use App\Model\Property;
use App\Model\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Illuminate\Support\Facades\Redirect;
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
        $voucher_db = DB::table('vouchers')
            ->join('voucher_types','vouchers.voucher_type_id', '=', 'voucher_types.id')
            ->select('vouchers.*','voucher_types.name')->orderBy('id','DESC')
            ->get();
        //dd($voucher_db);
        $property = Property::all();
        $voucher_type = VoucherType::all();
        //$voucherWithProperties = Voucher::query()->with('properties')->find(14);
        //dd($voucherWithProperties);
        return view('Admin.voucher.list_voucher',[
            'voucher_db'=>$voucher_db,
            'voucher_type'=>$voucher_type,
            'property'=>$property,
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
        $voucher_db = new Voucher();
        $imageUrl = '';
        if ($file = $request->file('image')) {
            $fileName = date("YmdHis")."_".$file->getClientOriginalName();
            $directory = 'admin/images/product_images/';
            $imageUrl = $directory.$fileName;
            $file->move($directory, $fileName);
            $voucher_db->image = $imageUrl;
        }
        if ($request->file('gallery_image')) {
            foreach ($request->file('gallery_image') as $image) {
                $fileName = $image->getClientOriginalName();
                $directory = 'admin/images/product_images/';
                $g_imageUrl = $directory.$fileName;
                $image->move($directory, $fileName);
                $data[] = $g_imageUrl;
            }
            $voucher_db->gallery_image = json_encode($data);
        }

        $voucher_db->name_voucher = $request->name_voucher;
        $voucher_db->date_create = $request->date_create;
        $voucher_db->date_ex = $request->date_ex;
        $voucher_db->golf_course = $request->golf_course;
        $voucher_db->voucher_type_id = $request->voucher_type_id;
        $voucher_db->status = $request->status;

        $voucher_db->save();
        $voucher_db->properties()->attach($request->properties);


        return redirect()->back()->with('message', 'Create voucher Successfully');
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
        $voucher_find = Voucher::where('id', '=', $id)->select('*')->first();
        return view('admin.voucher.view-voucher',[ 'voucher_find'=>$voucher_find,]);
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

        $voucherEdit =Voucher::query()->with('properties')->find($id);
        return response()->json($voucherEdit);
    }

    public function update(Request $request)
    {
        //
        $request->validate([
            'name_voucher' => 'required|max:255',
            'date_create' => '',
            'image' => 'image',
            'date_ex' =>'',
            'golf_course' => '',
            'voucher_type_id' => '',
            'status' => '',
        ]);

        $voucher_db = Voucher::find($request->id);

        if ($file = $request->file('image')) {
            $fileName = $file->getClientOriginalName();
            $directory = 'admin/images/';
            $imageUrl = $directory.$fileName;
            $file->move($directory, $fileName);

            $voucher_db->image = $imageUrl;
        }
        $voucher_db->name_voucher = $request->name_voucher;
        $voucher_db->date_create = $request->date_create;
        //$newDate = date("dd-mm-YYYY", strtotime($voucher_db->date_create));
        $voucher_db->date_ex = $request->date_ex;
        $voucher_db->golf_course = $request->golf_course;
        $voucher_db->voucher_type_id = $request->voucher_type_id;
        $voucher_db->properties()->attach($request->properties);

        $voucher_db->save();
        echo "done";
        //       // return Redirect::back()->with('message', 'Update voucher success');
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
