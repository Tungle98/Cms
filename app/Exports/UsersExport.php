<?php

namespace App\Exports;

use App\Model\Airport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Airport::all();
    }
    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
        return ["STT", "code", "tên tai khoản", "flight_date","Giờ bay","Số hiệu","Dịch vụ mua kèm","trang thái","money"];
    }
}
