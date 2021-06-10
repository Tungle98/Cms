<div class="modal fade" id="editVoucherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Voucher</h5>
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
                <form id="updateVoucherForm" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_status">loai voucher</label>
                                    <select class="form-control" name="voucher_type_id" id="edit_voucher_type">
                                        <option value="">Select type voucher</option>
                                        @foreach($voucher_type as $vt)
                                            <option value="{{$vt->id}}">{{$vt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="voucher_name"> Name voucher</label>
                                    <input type="text" name="name_voucher" class="form-control" id="edit_voucher_name"  value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="e_quantity">Ten san</label>
                                    <input type="text" name="golf_course" class="form-control" id="edit_golf_course" placeholder="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="filePhoto5">Ngay tao</label>
                                    <input type="date" name="date_create" class="form-control-file" id="edit_date_create" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="filePhoto5">Ngay het han</label>
                                    <input type="date" name="date_ex" class="form-control-file" id="edit_date_ex" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="filePhoto">Voucher Image</label>
                                    <input type="file" name="image" class="form-control-file" id="filePhoto2">
                                    <img src="" id="previewHolder2" width="150px">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="product_status">Properties: </label>
                                    @foreach($property as $pro)
                                        <label style="padding-right: 30px"><input type="checkbox" name="properties[]"  value="{{$pro->id}}" id="property_id" >{{$pro->name}} </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update voucher</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
