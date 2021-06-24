<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\VoucherUser;
use Illuminate\Support\Facades\Http;
use DB;
use function App\Helpers\search_address;

class HotelController extends Controller
{

    public $base_url;



    function __construct()
    {
        $this->base_url = env("SERVICE_DOMAIN_BONUS", "") . "/api/v1/hotel/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $url = $this->base_url . "/history_booking";
            //join user voucher voi voucher
            $hotel = DB::table('hotels')
                ->join('voucher_users', 'hotels.voucher_user_id', '=', 'voucher_users.id')
                ->select('hotels.*', 'voucher_users.full_name')->orderBy('id', 'DESC')
                ->get();
            //call api search address
//        .'/history_booking?uid=20736&token=7374b1bb58d5fade098d579d5e1f6285&language=vi&timezone=Asia/Ho_Chi_Minh&page=1&number=10'
            $uid = 20736;
            $token = "7374b1bb58d5fade098d579d5e1f6285";
            $language = "VN";

            $collection = Http::get($url, [
                "uid" => $uid,
                "token" => $token,
                "language" => $language,
//            "timezone" => $timezone ?? "Asia/Ho_Chi_Minh",
                "page" => $page ?? 0,
                "number" => $number ?? 10
            ]);

            // dd($collection);
            //convert string to array
            $coll = json_decode($collection);
            //dd($addRess->data);
            $voucher_user = VoucherUser::all();
            return response()->view('Admin.hotel.list_room', [
                'hotel' => $hotel,
                'voucher_user' => $voucher_user,
//            goi data 2 lan
                'coll' => $coll->data->data,
//            'addRess'=>$addRess->data
            ]);
        }catch (\Exception $exception){
            var_dump($exception->getMessage());
        }

    }

    public function find(Request $request)
    {
        $address = Http::get('https://api-dev.vgstravel.com/api/v1/hotel/recent_search_keyword?uid=99999&token=7374b1bb58d5fade098d579d5e1f6285&language=vi&timezone=Asia/Ho_Chi_Minh');
        $addRess = json_decode($address);
        $dataAddress = $addRess->data;
        $needle = search_address($request, $dataAddress);
        dd($needle);
        $filter = in_array($request, $dataAddress);
        dd($filter, $dataAddress);
        $hotels = Hotel::where('name_hotel', 'like', '%' . $request->get('q') . '%')->get();
        return response()->json($hotels, $addRess);
    }

    public function get()
    {
        $voucher_user = VoucherUser::all();
        $d['hotels'] = Hotel::orderby('id', 'DESC')->get();
        return view('Admin.hotel.getTableData', $d, compact('voucher_user'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name_hotel' => '',
            'type_room' => '',
            'description' => '',
            'voucher_user_id' => '',
            'check_in' => '',
            'check_out' => '',
            'number_room' => '',
            'number_customer' => '',
            'money' => '',
        ]);
        $hotel = new Hotel();
        $hotel->name_hotel = $request->name_hotel;
        $hotel->type_room = $request->type_room;
        $hotel->description = $request->description;
        $hotel->voucher_user_id = $request->voucher_user_id;
        $hotel->check_in = $request->check_in;
        $hotel->check_out = $request->check_out;
        $hotel->number_room = $request->number_room;
        $hotel->number_customer = $request->number_customer;
        $hotel->money = $request->money;

        $hotel->save();

        return redirect()->back()->with('message', 'Hotel create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hotel = Hotel::find($id);
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name_hotel' => '',
            'type_room' => '',
            'description' => '',
            'voucher_user_id' => '',
            'check_in' => '',
            'check_out' => '',
            'number_room' => '',
            'number_customer' => '',
            'money' => '',
        ]);
        $hotel = Hotel::find($request->id);
        $hotel->name_hotel = $request->name_hotel;
        $hotel->type_room = $request->type_room;
        $hotel->description = $request->description;
        $hotel->voucher_user_id = $request->voucher_user_id;
        $hotel->check_in = $request->check_in;
        $hotel->check_out = $request->check_out;
        $hotel->number_room = $request->number_room;
        $hotel->number_customer = $request->number_customer;
        $hotel->money = $request->money;

        $hotel->save();

        echo "done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
