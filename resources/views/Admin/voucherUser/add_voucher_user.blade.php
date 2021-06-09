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
            <form id="addProductForm" method="post" action="{{ route('user_vouchers.store') }}" enctype="multipart/form-data">
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
                                <label for="product_name">Id user</label>
                                <input type="text" name="user_id" class="form-control" id="user_id"  required>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="short_desc">Tên khách hàng</label>
                                <input type="text" name="full_name" class="form-control" id="product_name"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="long_desc">Số lượng voucher</label>
                                <input type="text" name="total_voucher" class="form-control" id="product_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price"> Mã code</label>
                                <input type="text" name="code" class="form-control" id="product_name"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Trạng thái</label>
                                <select class="form-control" name="status" id="product_status">
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
