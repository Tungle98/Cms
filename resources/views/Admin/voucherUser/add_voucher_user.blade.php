<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="addProductForm" method="post" action="{{ route('admin.voucher_user') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Voucher</label>
                                <select class="form-control" name="voucher_id" id="product_cat">
                                    <option value="">Select voucher</option>
                                    @foreach($voucher as $v)
                                        <option value="{{$v->id}}">{{$v->name_voucher}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Mã khách hàng</label>
                                <input type="text" name="user_id" class="form-control" id="user_id"  required>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="full_name">Tên khách hàng</label>
                                <input type="text" name="full_name" class="form-control" id="full_name"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_voucher">Số lượng voucher</label>
                                <input type="text" name="total_voucher" class="form-control" id="total_voucher" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Mã code</label>
                                <input type="text" name="code" class="form-control" id="code"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số điện thoại</label>
                                <input type="number" name="phone" class="form-control" id="phone"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
{{--                            <div class="form-group">--}}
{{--                                <label for="code"> Ngày đến </label>--}}
{{--                                <input type="date" name="check_in" class="form-control" id="check_in"  required>--}}
{{--                            </div>--}}
                            <label for="checkin">Check-in</label>
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" class="form-control" id="from_date" name="check_in" />
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon">
                                </span></span>
                            </div>
                        </div>
                        <div class="col-md-6">
{{--                            <div class="form-group">--}}
{{--                                <label for="code"> Ngày đi</label>--}}
{{--                                <input type="date" name="check_out" class="form-control" id="check_out"  required>--}}
{{--                            </div>--}}
                            <label for="checkout">Check-out</label>
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" class="form-control" id="to_date" name="check_out" />
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon">
    </span></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Chưa sử dụng">Chưa sử dụng</option>
                                    <option value="Hết hạn">Hết hạn</option>
                                    <option value="Đã sử dụng">Đã sử dụng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Phương thức thanh toán</label>
                                <select class="form-control" name="method_paid" id="product_status">
                                    <option value="Chưa thanh toán">Chưa thanh toán</option>
                                    <option value="Vn pay">Vn pay</option>
                                    <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add user voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let $checkIn = $('#datetimepicker1');
        let $checkOut = $('#datetimepicker2');

        $checkIn.datetimepicker({
            useCurrent: false,
            format: 'dd/mm/yyyy',
            minDate: moment()
        });

        $checkOut.datetimepicker({
            useCurrent: false,
            format: 'dd/mm/yyyy',
        });

        $checkIn.on("dp.change", function(e) {
            $checkOut.data("DateTimePicker").minDate(e.date.add(1, 'day'));
        });

        $checkOut.on("dp.change", function(e) {
            $checkIn.data("DateTimePicker").maxDate(e.date);
        });

    });
</script>
