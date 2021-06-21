<div class="modal fade" id="editHotelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update book room</h5>
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
            <form id="updateHotelForm" method="put" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_status">Người mua</label>
                                <select class="form-control voucher_edit" name="voucher_user_id" id="edit_voucher_user_id">
                                    <option value="">Select voucher</option>
                                    @foreach($voucher_user as $v)
                                        <option value="{{$v->id}}">{{$v->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user"> Tên khách sạn</label>
                                <input type="text" name="name_hotel" class="form-control" id="edit_name_hotel"  value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="voucher_name"> loại phòng </label>
                                <input type="text" name="type_room" class="form-control" id="edit_type_room"  value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_quantity">check in</label>
                                <input type="date" name="check_in" class="form-control" id="edit_check_in" placeholder="">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> check out</label>
                                <input type="date" name="check_out" class="form-control" id="edit_check_out"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số khách</label>
                                <input type="text" name="number_customer" class="form-control" id="edit_number_customer"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số phòng cần đặt</label>
                                <input type="text" name="number_room" class="form-control" id="edit_number_room"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code"> Số tiền</label>
                                <input type="text" name="money" class="form-control" id="edit_money"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_quantity">Ghi chú</label>
                                <input type="text" name="description" class="form-control" id="edit_description" placeholder="">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update book room</button>
                </div>
            </form>
        </div>
    </div>
</div>
