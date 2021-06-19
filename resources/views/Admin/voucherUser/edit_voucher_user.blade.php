<div class="modal fade" id="editVoucherUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Voucher User</h5>
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
            <form id="updateVoucherUserForm" method="put" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">voucher</label>
                                <select class="form-control voucher_edit" name="voucher_id" id="edit_voucher_id">
                                    <option value="">Select voucher</option>
                                    @foreach($voucher as $v)
                                        <option value="{{$v->id}}">{{$v->name_voucher}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user"> Id khách hàng</label>
                                <input type="text" name="user_id" class="form-control" id="edit_user"  value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="voucher_name"> Tên khách hàng </label>
                                <input type="text" name="full_name" class="form-control" id="edit_full_name"  value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_quantity">Số lượng voucher</label>
                                <input type="text" name="total_voucher" class="form-control" id="edit_total_voucher" placeholder="">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_quantity">Code</label>
                                <input type="text" name="code" class="form-control" id="edit_code" placeholder="">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số điện thoại</label>
                                <input type="number" name="phone" class="form-control" id="edit_phone"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Email </label>
                                <input type="email" name="email" class="form-control" id="edit_email"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Trạng thái</label>
                                <select class="form-control" name="status" id="edit_status">
                                    <option value="Chưa sử dụng">Chưa sử dụng</option>
                                    <option value="Hết hạn">Hết hạn</option>
                                    <option value="Đã sử dụng">Đã sử dụng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Phương thức tt</label>
                                <select class="form-control" name="method_paid" id="edit_method_paid">
                                    <option value="Chưa thanh toán">Chưa thanh toán</option>
                                    <option value="Vn pay">Vn pay</option>
                                    <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Check in</label>
                                <input type="date" name="check_in" class="form-control" id="edit_check_in"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Check out </label>
                                <input type="date" name="check_out" class="form-control" id="edit_check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số lượng người lớn </label>
                                <input type="text" name="number_adult" class="form-control" id="edit_number_adult"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số lượng trẻ em (dưới 12 tuổi) </label>
                                <input type="text" name="number_children" class="form-control" id="edit_number_children" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số lượng em bé (dưới 2 tuổi)</label>
                                <input type="text" name="number_babie" class="form-control" id="edit_number_babie" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Dịch vụ đặt thêm (nếu có) </label>
                                <input type="text" name="booking_service" class="form-control" id="edit_booking_service"  >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Ghi chú (nếu có)</label>
                                <input type="text" name="note" class="form-control" id="edit_note"  >
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update book voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>
