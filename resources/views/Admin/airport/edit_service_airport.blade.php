<div class="modal fade" id="editAirportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin voucher</h5>
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
            <div class="container">
                <form id="updateAirportForm" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Code</label>
                                    <input type="text" name="code" class="form-control"  id="edit_code" placeholder="Enter voucher Name" value="" required>
                                </div></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="short_desc">Người đại diện mua</label>
                                    <input type="text"  name="purchase_representative" class="form-control checkIn" id="edit_user"  required  >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="long_desc">số lượng vé </label>
                                    <input type="number" name="total_ticket" class="form-control checkOut" id="edit_total_ticket"  placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Ngày bay</label>
                                    <input type="date" name="flight_date" class="form-control" id="edit_flight_date" placeholder="golf course" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Giờ bay</label>
                                    <input type="text" name="flight_hour" class="form-control " id="edit_flight_hour" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Số hiệu chuyến bay</label>
                                    <input type="text" name="flight_number" class="form-control" id="edit_flight_number" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Dịch vụ mua kèm</label>
                                    <input type="text" name="bundled_service" class="form-control" id="edit_service" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Số tiền</label>
                                    <input type="text" name="money" class="form-control price_format" id="edit_money" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_status">Trạng thái </label>
                                    <select class="form-control" name="status" id="edit_status">
                                        <option value="1">Giữ chỗ</option>
                                        <option value="0">Đang thanh toán</option>
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
</div>
<script>
    //     $("input[type=date]").datepicker({
    //   dateFormat: 'yy-mm-dd',
    //   onSelect: function(dateText, inst) {
    //     $(inst).val(dateText); // Write the value in the input
    //   }
    // });
    //
    // // Code below to avoid the classic date-picker
    // $("input[type=date]").on('click', function() {
    //   return false;
    // });
    //dynamicAddField

</script>
