
<form id="addUserForm" method="post" action="">
    @csrf
    <div class="row">
        <div class="col-md-12">Tên khách hàng:<b id="full_name">{{$user_v->full_name}}</b></div>
        <div class="col-md-6">Id:  <b id="user_id">{{$user_v->user_id}}</b></div>
        <div class="col-md-6">Tổng số voucher: <b id="total_voucher">{{$user_v->total_voucher}}</b></div>
        <div class="col-md-6">Voucher id: <b id="name_voucher">{{$user_v->name_voucher}}</b></div>
        <div class="col-md-6">Code: <b id="code">{{$user_v->code}}</b></div>
        <div class="col-md-6">Trạng thái: <b id="status">{{$user_v->status}}</b></div>
        <div class="col-md-6">Phương thức thanh toán: <b id="method_paid">{{$user_v->method_paid}}</b></div>
        <div class="col-md-6">Tên sân: <b id="golf_course">{{$user_v->golf_course}}</b></div>
    </div>
    <div>
        <h5>Nhập thông tin chi tiết cho khách hàng</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @foreach($list_tem as $value)
            <label for="">{{$value->name}}</label>
            @if($value->type=='2')
                    <input type="text" name="value" class="form-control-input" id="value" >
                @else
                    <input type="date" name="value" class="form-control-input" id="value" >
                @endif

            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary submit-show" >Đồng ý</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</form>
