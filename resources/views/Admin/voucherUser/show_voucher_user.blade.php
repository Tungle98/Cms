<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View User Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form  method="post" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">Tên khách hàng:<b id="full_name"></b></div>
                            <div class="col-md-6">Id:  <b id="user_id"></b></div>
                            <div class="col-md-6">Tổng số voucher: <b id="total_voucher"></b></div>
                            <div class="col-md-6">Voucher id: <b id="name_voucher"></b></div>
                            <div class="col-md-6">Code: <b id="code"></b></div>
                            <div class="col-md-6">Trạng thái: <b id="status"></b></div>
                            <div class="col-md-6">Phương thức thanh toán: <b id="method_paid"></b></div>
                            <div class="col-md-6">Tên sân: <b id="golf_course"></b></div>
                        </div>
                       <!-- <table>
                            @foreach($voucherWithProperties as $s)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user"> {{$s->name}}</label>
                                            <input type="text" name="properties[{{$s->id}}]" class="form-control" id=""  value="" >
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>-->

                        <button type="submit" class="btn btn-primary" >Đồng ý</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
