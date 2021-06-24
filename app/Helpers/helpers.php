<?php

namespace App\Helpers;

if (!function_exists(search_address())) {
    function search_address($needle, array $data)
    {
        foreach ($data as $item) {
            if ($item['name'] === $needle) {
                return $item['searchCode'];
            }
            continue;
        }
    }
}
