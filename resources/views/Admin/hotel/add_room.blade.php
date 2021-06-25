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
                                <input type="name" class="form-control search-input" name="address_name" id="address_name" autocomplete="off" placeholder="Nhập địa điểm">

                                <div id="countryList">

                                </div>

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
                                    <div class="col-md-6 "  id="counter"><i class="fa fa-users" aria-hidden="true"></i><input aria-label="quantity" class="input-qty" max="8" min="1" name="" type="number" value="1"></div>
                                    <div class="col-md-3"><i class="fa fa-child" aria-hidden="true"></i> 0</div>
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
                                            <div class="buttons_added" style="padding-left: 20px">
                                                <input class="minus is-form" type="button" value="-">
                                                <input aria-label="quantity" class="input-qty" max="8" min="1" name="" type="number" value="1">
                                                <input class="plus is-form" type="button" value="+">
                                            </div>
                                        </div>
                                        <div class="col-lg-12  flex-container" style="padding-top: 30px">
                                            <div>
                                                Trẻ em:
                                            </div>
                                            <div class="buttons_added" style="padding-left: 50px">
                                                <input class="minus is-form" type="button" value="-">
                                                <input aria-label="quantity" class="input-qty" max="4" min="0" name="" type="number" value="0">
                                                <input class="plus is-form" type="button" value="+">
                                            </div>
                                        </div>
                                        <div class="col-lg-12" style="display: none" id="addChild">
                                           <span>Độ tuổi của trẻ em</span>

                                        </div>
                                    </div>
                                    <hr>
                                    <span>+ Thêm phòng</span>
                                </div>
                            </div>
                        <div id="show-hidden-menu">Click Me!</div>
                        <div class="hidden-menu" style="display: none;">
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
                                    <div class="col-md-6 "  id="counter"><i class="fa fa-users" aria-hidden="true"></i><input aria-label="quantity" class="input-qty" max="8" min="1" name="" type="number" value="1"></div>
                                    <div class="col-md-3"><i class="fa fa-child" aria-hidden="true"></i> 0</div>
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
                                        <div class="buttons_added" style="padding-left: 20px">
                                            <input class="minus is-form" type="button" value="-">
                                            <input aria-label="quantity" class="input-qty" max="8" min="1" name="" type="number" value="1">
                                            <input class="plus is-form" type="button" value="+">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  flex-container" style="padding-top: 30px">
                                        <div>
                                            Trẻ em:
                                        </div>
                                        <div class="buttons_added" style="padding-left: 50px">
                                            <input class="minus is-form" type="button" value="-">
                                            <input aria-label="quantity" class="input-qty" max="4" min="0" name="" type="number" value="0">
                                            <input class="plus is-form" type="button" value="+">
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="display: none" id="addChild">
                                        <span>Độ tuổi của trẻ em</span>

                                    </div>
                                </div>
                                <hr>
                                <span>+ Thêm phòng</span>
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
/**/
    .buttons_added {
        opacity:1;
        display:inline-block;
        display:-ms-inline-flexbox;
        display:inline-flex;
        white-space:nowrap;
        vertical-align:top;
                       }
    .is-form {
        overflow:hidden;
        position:relative;
        background-color:#f9f9f9;
        height:2.2rem;
        width:1.9rem;
        padding:0;
        text-shadow:1px 1px 1px #fff;
        border:1px solid #ddd;
    }
    .is-form:focus,.input-text:focus {
        outline:none;
    }
    .is-form.minus {
        border-radius:4px 0 0 4px;
    }
    .is-form.plus {
        border-radius:0 4px 4px 0;
    }
    .input-qty {
        width: 50px;
        background-color:#fff;
        height:2.2rem;
        text-align:center;
        font-size:1rem;
        display:inline-block;
        vertical-align:top;
        margin:0;
        border-top:1px solid #ddd;
        border-bottom:1px solid #ddd;
        border-left:0;
        border-right:0;
        padding:0;
    }
    .input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
        -webkit-appearance:none;
        margin:0;
    }

</style>
<script>
    //check date input
    function check() {
        if(document.getElementById('').value < document.getElementById('').value)
        { console.log('pass')}
        else{
            alert("Ngày hết hạn phải lớn hơn ngày tạo");
        }

    }

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
    $('input.input-qty').each(function() {
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = 0
        } else d = min
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
                if (d > min) d += -1
            } else if ($(this).hasClass('plus')) {
                var x = Number($this.val()) + 1
                if (x <= max) d += 1
            }
            $this.attr('value', d).val(d)
        })
    })

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
                        // $('#countryList').fadeIn();
                        // $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                        return data;
                    }
                }).done(function (response){
                    $("#countryList").empty();
                    $("#countryList").prepend(response);
                });
            }
        });
        $(document).on('click', 'li', function(){
            $('#address_name').val($(this).text());
            $('#countryList').fadeIn();
        });

    });
    $(document).ready(function() {
        $('#show-hidden-menu').click(function() {
            $('.hidden-menu').slideToggle("slow");
            // Alternative animation for example
            // slideToggle("fast");
        });
    });
</script>
