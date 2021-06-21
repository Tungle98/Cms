<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add room</h5>
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
            <form id="addProductForm" method="post" action="{{ route('admin.hotel') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Ngươi mua</label>
                                <select class="form-control" name="voucher_user_id" id="voucher_id" style="width: 200px">
                                    @foreach($voucher_user as $v)
                                        <option value="{{$v->id}}">{{$v->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Tên khách sạn</label>
                                <input type="text" name="name_hotel" class="form-control" id="user_id"  required>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="full_name">Loại phòng</label>
                                <input type="text" name="type_room" class="form-control" id="full_name"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Check In</label>
                                <input type="date" name="check_in" class="form-control" id="check_in"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Check out</label>
                                <input type="date" name="check_out" class="form-control" id="check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số khách</label>
                                <input type="text" name="number_customer" class="form-control" id="check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số phòng cần đặt</label>
                                <input type="text" name="number_room" class="form-control" id="check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số tiền</label>
                                <input type="text" name="money" class="form-control" id="check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_voucher">Ghi chú</label>
                                <input type="text" name="description" class="form-control" id="total_voucher" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Book room</button>
                </div>

                </div></form>
        </div>
    </div>
</div>

<script>
    function check() {
        if(document.getElementById('').value < document.getElementById('').value)
        { console.log('pass')}
        else{
            alert("Ngày hết hạn phải lớn hơn ngày tạo");
        }

    }
</script>
