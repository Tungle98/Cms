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
use Image;
use Carbon\Carbon;
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
        //get property
        $property = Property::all();
        //get voucher_type
        $voucher_type = VoucherType::all();
        return view('Admin.voucher.list_voucher',[
            'voucher_db'=>$voucher_db,
            'voucher_type'=>$voucher_type,
            'property'=>$property,
        ]);
    }
    public function get()
    {
        $property = Property::all();
        $voucher_type = VoucherType::all();
        $d['vouchers'] = Voucher::orderby('id', 'DESC')->get();
        return view('Admin.voucher.getTableData', $d,['voucher_type'=>$voucher_type,'property'=>$property]);
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
        //dd($request->all());
//        $addMoreInputFields = $request->addMoreInputFields;
//        $convert = json_encode($addMoreInputFields);
//        $request->validate([
//            'addMoreInputFields.*.voucher_field' => 'required'
//        ]);
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $voucher_db = new Voucher();
        $imageUrl = '';
        if ($file = $request->file('image')) {
            $fileName = date("YmdHis")."_".$file->getClientOriginalName();
            $filePath = 'thumbnails/';
            $image_resize = Image::make($file->getRealPath());

            dd($image_resize->height());
            //check height <= 960 khong can resize
            $image_resize->resize(null,960, function ($constraint) {
                $constraint->aspectRatio();
            })->save($filePath.'/'.$fileName);
            $imageUrl = $filePath.$fileName;
          $file->move($filePath, $fileName);
          //dd($file);
            $voucher_db->image = $imageUrl;
           // dd($voucher_db);
//            $fileName = date("YmdHis")."_".$file->getClientOriginalName();
//            $directory = 'admin/images/product_images/';
//            $imageUrl = $directory.$fileName;
//            $file->move($directory, $fileName);
//            $voucher_db->image = $imageUrl;
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
        $voucher_db->date_create =$request->date_create;
        $voucher_db->date_ex = $request->date_ex;
        $voucher_db->golf_course = $request->golf_course;
        $voucher_db->money = $request->money;
        $voucher_db->voucher_content = $request->voucher_content;
        $voucher_db->voucher_number = $request->voucher_number;
        $voucher_db->voucher_type_id = $request->voucher_type_id;
        $voucher_db->status = $request->status;
        $voucher_db->voucher_field = json_encode($request->addMoreInputFields);

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
        $voucher_find = Voucher::find($id);

        return view('Admin.voucher.template.show',compact('voucher_find'));
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
            'money' => '',
            'voucher_content' => '',
            'voucher_number' => '',

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
        $voucher_db->date_ex = $request->date_ex;
        $voucher_db->golf_course = $request->golf_course;
        $voucher_db->money = $request->money;
        $voucher_db->status = $request->status;
        $voucher_db->voucher_content = $request->voucher_content;
        $voucher_db->voucher_number = $request->voucher_number;
        $voucher_db->voucher_type_id = $request->voucher_type_id;
        $voucher_db->voucher_field = json_decode($request->addMoreInputFields);
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
    public function publish($id){
        $voucher = Voucher::find($id);
        $voucher->status = 1;
        $voucher->save();

        echo "done";
        //return back()->with('message', 'voucher Status Published');
    }

    public function unpublish($id){
        $voucher = Voucher::find($id);
        $voucher->status = 0;
        $voucher->save();

        echo "done";
        //return back()->with('message', 'voucher Status Unpublished');
    }
    public function updateStatus(Request $request)
    {
        $voucher = Voucher::findOrFail($request->voucher_id);
        $voucher->status = $request->status;
        $voucher->save();

        return response()->json(['message' => 'Voucher status updated successfully.']);
    }
}
