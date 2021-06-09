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
            <form id="updateVoucherUserForm" method="post" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_status">voucher</label>
                        <select class="form-control" name="voucher_id" id="edit_voucher_id">
                            <option value="">Select voucher</option>
                            @foreach($voucher as $v)
                                <option value="{{$v->id}}">{{$v->name_voucher}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="voucher_name"> Id khach hang</label>
                        <input type="text" name="user_id" class="form-control" id="edit_user_id"  value="" required>
                    </div>
                    <div class="form-group">
                        <label for="voucher_name"> Name </label>
                        <input type="text" name="full_name" class="form-control" id="edit_full_name"  value="" required>
                    </div>
                    <div class="form-group">
                        <label for="e_quantity">So luong voucher</label>
                        <input type="text" name="total_voucher" class="form-control" id="edit_total_voucher" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="product_status">Trạng thái</label>
                        <select class="form-control" name="status" id="edit_status">
                            <option value="Chưa sử dụng">Chưa sử dụng</option>
                            <option value="Hết hạn">Hết hạn</option>
                            <option value="Đã sử dụng">Đã sử dụng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_status">Phương thức tt</label>
                        <select class="form-control" name="method_paid" id="edit_method_paid">
                            <option value="Chưa thanh toán">Chưa thanh toán</option>
                            <option value="Vn pay">Vn pay</option>
                            <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                        </select>
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
