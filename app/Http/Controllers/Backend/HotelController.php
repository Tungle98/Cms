<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\apiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\VoucherUser;
use Illuminate\Support\Facades\Http;
use DB;
use function App\Helpers\search_address;
use Ixudra\Curl\Facades\Curl;
class HotelController extends Controller
{



    public $base_url;
//    public $apiService;


    function __construct()
    {
        $this->base_url = env("SERVICE_DOMAIN_BONUS", "") . "/api/v1/hotel/";
        $this->apiService = new apiService("hotel/");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $coll = Curl::to($this->base_url . "/history_booking")->get();
            if (check_code($coll)) {
                $coll = json_decode($coll);
                return view('Admin.hotel.list_room', compact('coll'));
            } else {
                return view('Admin.hotel.list_room', compact('coll'));
            }
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

    }

    public function find(Request $request)
    {

        //https://api-dev.vgstravel.com/api/v1/hotel/search_hotel_keyword?uid=20736&token=3d187a618fe34e736bc0a538ed12cca1&language=vi&timezone=Asia/Ho_Chi_Minh&token_wallet=&keyword=A&page=0&pageSize=10
        //config api
        $url = $this->base_url . "search_hotel_keyword";
        $uid = 20736;
        $token = "3d187a618fe34e736bc0a538ed12cca1";
        $language = "vi";
        $address = Http::get($url, [
            "uid" => $uid,
            "token" => $token,
            "language" => $language,
            "timezone" => $timezone ?? "Asia/Ho_Chi_Minh",
            "keyword"=> $request->get('query') ?? "",
        ]);
        $addRess = (object)json_decode($address,true);
    //    dd($addRess);
        return view('Admin/ajax/search-address', [
            'addRess' => $addRess->data,
        ]);
    }

    public  function search(Request $request)
    {

        dd($request->all());
        //https://api-dev.vgstravel.com/api/v1/hotel/search_best_hotel?uid=99999&token=069d2483f6f94e306cea25b01d0d6771&language=vi&timezone=Asia/Ho_Chi_Minh&token_wallet=&searchCode=6034264&searchType=MULTI_CITY_VICINITY&checkin=2021-04-23&checkout=2021-04-24&supplier=EXPEDIA&paxInfos=2-1&page=0&pageSize=10
        $url = $this->base_url . "search_best_hotel";
        $uid = 99999;
        $token = "069d2483f6f94e306cea25b01d0d6771";
        $language = "vi";
        $room = Http::get($url, [
            "uid" => $uid,
            "token" => $token,
            "language" => $language,
            "timezone" => $timezone ?? "Asia/Ho_Chi_Minh",
            "searchCode"=>$request->get('address_name') ?? "",
            "checkin"=>$request->get('checkin') ?? "",
            "checkout"=>$request->get('checkout') ?? "",
            "paxInfos"=>$request->get('adult') ?? "",
        ]);
        //dd($room);
        $room = (object)json_decode($room,true);
        //dd($room);
        return view('Admin/hotel/result_room', [
            'room' => $room->data,
        ]);
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
