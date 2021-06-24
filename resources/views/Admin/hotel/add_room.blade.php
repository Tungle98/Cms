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
{{--                                <select class="js-example-basic-single" name="address">--}}
{{--                                    <option></option>--}}
{{--                                    @foreach($addRess as $item)--}}
{{--                                        <option>{{$item->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                <input type="name" class="form-control search-input" name="address_name" id="address_name" autocomplete="off" placeholder="Nhập địa điểm">
                                <div id="countryList"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label style="text-align: center">Ngày đến & ngày đi</label>
                           <input type="text" id="rangeDate" name="date-range" placeholder="Please select date" data-input>
                        </div>
                        <div class="col-md-4">
                            <label style="text-align: center">Phòng & khách</label>
                            <div class="form-group panel-heading collapsed"  data-toggle="collapse" data-target="#collapseOrderItems1" style="border: 1px solid gray">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6>Phòng và khách</h6>
                                    </div>
                                    <div class="col-md-3 ">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3"><i class="fa fa-key" aria-hidden="true"></i> 1</div>
                                    <div class="col-md-3"><i class="fa fa-users" aria-hidden="true"></i> 0</div>
                                    <div class="col-md-3"><i class="fa fa-child" aria-hidden="true"></i> 1</div>
                                </div>
                            </div>

                                <div class="collapse" id="collapseOrderItems1" style="border: 1px solid gray">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>Phòng: 1</p>
                                        </div>
                                        <div class="col-lg-12 flex-container" >
                                            <div>
                                                Người lớn:
                                            </div>
                                            <div class=" flex-container">
                                                <div style="padding-right: 20px;padding-left: 30px;"><button onclick="buttonClick()">-</button></div>
                                                <div style="padding-right: 20px;" id="inc" value="0" >1</div>
                                                <div style=""><button onclick="buttonAddClick()">+</button></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12  flex-container" style="padding-top: 30px">
                                            <div>
                                                Trẻ em:
                                            </div>
                                            <div class=" flex-container">
                                                <div style="padding-right: 20px;padding-left: 60px;"><button onclick="buttonClick()">-</button></div>
                                                <div style="padding-right: 20px;">0</div>
                                                <div style=""><a onclick="buttonAddClick()">+</a></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12" style="display: none">
                                           <span>Độ tuổi của trẻ em</span>
                                            <ul>
                                                <li>1</li>
                                            </ul>
                                        </div>
                                    </div>



                                    <hr>
                                    <span>+ Thêm phòng</span>
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
    .panel-heading .chevron:after {
        content: "\f078";
    }
    .panel-heading.collapsed .chevron:after {
        content: "\f054";
    }
    /*flex box*/
    .flex-container {
        display: flex;
        flex-wrap: nowrap;
    }

    .flex-container > div {

        text-align: center;
        line-height: 15px;
        font-size: 20px;
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
    //Toggle chevrons
    $(document).ready(function() {
        $('div.accordion-body').on('shown', function () {
            $(this).parent("div").find(".icon-chevron-down").removeClass("icon-chevron-down").addClass("icon-chevron-up");

        });

        $('div.accordion-body').on('hidden', function () {
            $(this).parent("div").find(".icon-chevron-up").removeClass("icon-chevron-up").addClass("icon-chevron-down");
        });

    });
//    js them ng
    var i = 0;
    function buttonAddClick() {
        document.getElementById('inc').value = ++i;
    }
    function buttonClick() {
        document.getElementById('inc').value = --i;
    }
    //ajax call api search
    $(document).ready(function(){

        $('#address_name').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $(this).val(); //lấy gía trị ng dùng gõ
            if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url:"{{ route('search') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                    method:"POST", // phương thức gửi dữ liệu.
                    data:{query:query, _token:_token},
                    success:function(data){ //dữ liệu nhận về
                        $('#countryList').fadeIn();
                        $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                    }
                });
            }
        });

        $(document).on('click', 'li', function(){
            $('#address_name').val($(this).text());
            $('#countryList').fadeOut();
        });

    });
</script>
