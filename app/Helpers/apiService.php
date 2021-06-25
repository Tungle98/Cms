<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Http;

class apiService
{
    private $base_url;

    function __construct($url)
    {
        $this->base_url = env("SERVICE_DOMAIN_BONUS", "") . "/api/v1/" . $url;
    }

    /**
     * @param $param
     * @param false $auth
     * @return \Illuminate\Http\Client\Response
     */
    public function GetMethod($slug, $params, $auth = false): \Illuminate\Http\Client\Response
    {

        if ($auth) {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $auth
            ]);
        }

        $params = (object)array_merge((array)[
            "timezone" => $param->timezone ?? "Asia/Ho_Chi_Minh",
            "limit" => $param->limit ?? 10,
            "page" => $param->page ?? 0,
            "pageSize" => $param->pageSize ?? 0,
        ], (array)$params);
        return Http::get($this->base_url . $slug, $params);
//        return  Http::get($this->base_url . $slug, $params);
    }

}
