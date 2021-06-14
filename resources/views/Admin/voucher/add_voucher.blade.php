<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo Voucher</h5>
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
            <form id="addProductForm" method="post" action="{{ route('admin.voucher') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Loại voucher</label>
                                <select class="form-control" name="voucher_type_id" id="product_cat">
                                    <option value="">Select type voucher</option>
                                    @foreach($voucher_type as $vt)
                                        <option value="{{$vt->id}}">{{$vt->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Voucher Name</label>
                                <input type="text" name="name_voucher" class="form-control"  id="product_name" placeholder="Enter voucher Name" required>
                            </div></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_desc">Ngày tạo</label>
                                <input type="date"  name="date_create" class="form-control" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="long_desc">Ngày hết hạn</label>
                                <input type="date" name="date_ex" class="form-control" id="product_name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_price">Tên sân</label>
                                <input type="text" name="golf_course" class="form-control" id="product_name" placeholder="golf course" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filePhoto">Voucher Image</label>
                                <input type="file" name="image" class="form-control-file" id="filePhoto4" >
                                <img src="" id="previewHolder" width="150px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Trạng thái </label>
                                <select class="form-control" name="status" id="product_status">
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                    <option value="2">Time-expired</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-group">
                    <label for="product_status">Thuộc tính: </label>
                    @foreach($property as $pro)
                        <label style="padding-right: 30px"><input type="checkbox" name="properties[]"  value="{{$pro->id}}" >{{$pro->name}} </label>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>
