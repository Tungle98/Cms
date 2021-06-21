<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo đơn</h5>
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
            <form id="addProductForm" method="post" action="{{ route('admin.airport') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Code</label>
                                <input type="text" name="code" class="form-control"  id="product_name" placeholder="Enter voucher Name" value="" required>
                            </div></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_desc">Người đại diện mua</label>
                                <input type="text"  name="purchase_representative" class="form-control checkIn" id="date_create"  required  >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="long_desc">số lượng vé </label>
                                <input type="number" name="total_ticket" class="form-control checkOut" id="date_ex" onchange="check()" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Ngày bay</label>
                                <input type="date" name="flight_date" class="form-control" id="product_name" placeholder="golf course" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Giờ bay</label>
                                <input type="text" name="flight_hour" class="form-control " id="product_name" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Số hiệu chuyến bay</label>
                                <input type="text" name="flight_number" class="form-control" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Dịch vụ mua kèm</label>
                                <input type="text" name="bundled_service" class="form-control" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Số tiền</label>
                                <input type="text" name="money" class="form-control price_format" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Người làm lệnh</label>
                                <input type="text" name="user_id" class="form-control" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Trạng thái </label>
                                <select class="form-control" name="status" id="product_status">
                                    <option value="0">Giữ chỗ</option>
                                    <option value="1">Đang thanh toán</option>
                                    <option value="2">Thanh toán sau</option>
                                    <option value="3">Đã thanh toán</option>
                                </select>
                            </div>
                        </div>

                    </div>


                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tạo service</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function check() {
        if(document.getElementById('date_create').value < document.getElementById('date_ex').value)
        { console.log('pass')}
        else{
            alert("Ngày hết hạn phải lớn hơn ngày tạo");
        }

    }

</script>
