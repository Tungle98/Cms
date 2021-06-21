<form id="addUserForm" method="post" action="">
    @csrf
    <div class="row">
        <div class="col-md-6" style="padding-bottom: 10px;">Tên voucher: <b >{{$voucher_find->name_voucher}}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;">Trạng thái: <b id="status">{{$voucher_find->status}}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;" >Tên sân: <b id="golf_course">{{$voucher_find->golf_course}}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;" >Giá tiền: <b id="golf_course">{{$voucher_find->money}}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;" >Ngày bắt đầu: <b id="golf_course">{!!date('d/m/y', strtotime($voucher_find->check_in))!!}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;" >Ngày hết hạn: <b id="golf_course">{!!date('d/m/y', strtotime($voucher_find->check_out))!!}</b></div>
        <div class="col-md-6" style="padding-bottom: 10px;" >Ưu đãi voucher: <b id="golf_course">{{$voucher_find->voucher_field}}</b></div>
    </div>
</form>
