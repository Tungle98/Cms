<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm khách sạn</h5>
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
            <form id="addProductForm" method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label style="text-align: center">Địa điểm </label>
                            <div class="form-group">
                                <select class="js-example-basic-single" name="address">
                                    <option></option>
                                    @foreach($addRess as $item)
                                        <option>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label style="text-align: center">Ngày đến & ngày đi</label>
                           <input type="text" id="rangeDate" name="date-range" placeholder="Please select date" data-input>
                        </div>
                        <div class="col-md-4">
                            <label style="text-align: center">Phòng & khách</label>
                            <div class="form-group" style="border: 1px solid gray">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6>Phòng và khách</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><i class="fa fa-key" aria-hidden="true"></i> 1</div>
                                    <div class="col-md-3"><i class="fa fa-users" aria-hidden="true"></i> 0</div>
                                    <div class="col-md-3"><i class="fa fa-child" aria-hidden="true"></i> 1</div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Tìm khách sạn</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    input {
        border: 2px solid #aaa;
        border-radius: 5px;
        padding: 12px 10px;
        text-align: center;
        width: 250px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 35px;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 5px;
        height: 50px;
    }
</style>
<script>
    function check() {
        if(document.getElementById('').value < document.getElementById('').value)
        { console.log('pass')}
        else{
            alert("Ngày hết hạn phải lớn hơn ngày tạo");
        }

    }
    $(document).ready(function() {
        $(".js-example-basic-single").select2({
            dropdownParent: $("#addProductModal"),
            placeholder: "Select a address",
            allowClear: true
        });
    });

//thu vien flatpickr của datetimepicker
    $("#rangeDate").flatpickr({
        mode: 'range',
        dateFormat: "d-m-Y"
    });


</script>
