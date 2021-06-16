
<form id="addUserForm" method="post" action="{{route('admin.voucher_user.add')}}">
    @csrf
    <div class="row">
        <div class="col-md-12">Tên khách hàng:<b id="full_name">{{$user_v->full_name}}</b></div>
        <div class="col-md-6">Tổng số voucher: <b id="total_voucher">{{$user_v->total_voucher}}</b></div>
        <div class="col-md-6">Voucher id: <b >{{$user_v->name_voucher}}</b></div>
        <div class="col-md-6">Code: <b id="code">{{$user_v->code}}</b></div>
        <div class="col-md-6">Số điện thoại: <b id="code">{{$user_v->phone}}</b></div>
        <div class="col-md-6">Check_in: <b id="code">{!!date('d/m/y', strtotime($user_v->check_in))!!}</b></div>
        <div class="col-md-6">Check_out: <b id="code">{!!date('d/m/y', strtotime($user_v->check_out))!!}</b></div>
        <div class="col-md-6">Trạng thái: <b id="status">{{$user_v->status}}</b></div>
        <div class="col-md-6">Phương thức thanh toán: <b id="method_paid">{{$user_v->method_paid}}</b></div>
        <div class="col-md-6">Tên sân: <b id="golf_course">{{$user_v->golf_course}}</b></div>
    </div>
    <div>
        <h5>Nhập thông tin chi tiết cho khách hàng</h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" name="">Id khách hàng</label>
                <input type="text" name="id" value="{{$user_v->id}}" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" name="">Id voucher</label>
                <input type="text" name="voucher_id" value="{{$user_v->voucher_id}}" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">

                    @foreach($list_tem as $list_t)
                        <tr>
                            <div class="col-md-6">
                            <td><input {{ $list_t->value ? 'checked' : null }} data-id="{{ $list_t->id }}" type="checkbox" class="ingredient-enable"></td>
                            <td>{{ $list_t->name }}</td>
                            </div>
                            <div class="col-md-6">
                            @if($list_t->type ==2)
                            <td><input value="{{ $list_t->value ?? null }}" {{ $list_t->value ? null : 'disabled' }} data-id="{{ $list_t->id }}" name="properties[{{ $list_t->id }}]" type="text" class="property-value form-control" placeholder="Value"></td>
                            @else
                            <td><input value="{{ $list_t->value ?? null }}" {{ $list_t->value ? null : 'disabled' }} data-id="{{ $list_t->id }}" name="properties[{{ $list_t->id }}]" type="date" class="property-value form-control" placeholder="Value"></td>
                            @endif
                            </div>
                        </tr>

                    @endforeach

            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="user-submit" >Đồng ý</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


</form>
<script>
    $('document').ready(function () {
        $('.ingredient-enable').on('click', function () {
            let id = $(this).attr('data-id')
            let enabled = $(this).is(":checked")
            $('.property-value[data-id="' + id + '"]').attr('disabled', !enabled)
            $('.property-value[data-id="' + id + '"]').val(null)
        })
    });
</script>
