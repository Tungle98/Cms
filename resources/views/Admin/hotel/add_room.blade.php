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
            <form id="addProductForm" method="post" action="{{ route('admin.search') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
{{--                            <label style="text-align: center">Địa điểm </label>--}}
                            <div class="form-group">
                                <input type="name" class="form-control search-input" name="address_name" id="address_name" autocomplete="off" placeholder="Nhập địa điểm">

                                <div id="countryList" >

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
{{--                            <label style="text-align: center">Ngày đến & ngày đi</label>--}}
{{--                           <input type="text" id="rangeDate" name="date-range" placeholder="Please select date" data-input height="75px">--}}
                            <input type="date" name="checkin">
                            <input type="date" name="checkout">
                        </div>
                        <div class="col-md-4">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h6>Số khách và phòng</h6>
                                            </div>
                                            <div class="col-md-3">  <i class="arrow fas fa-chevron-down"></i></div>
                                            <div class="col-md-3"><i class="fa fa-key" aria-hidden="true"></i> 1</div>
                                            <div class="col-md-6 "  id="counter"><i class="fa fa-users" aria-hidden="true"> 1</i></div>
                                            <div class="col-md-3"><i class="fa fa-child" aria-hidden="true"></i> 0</div>
                                        </div>
                                    </div>
                                    <div class="accordion-body" >
                                        <div id="dynamicAddRemove">
                                            <h6>Số phòng 1:</h6>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    Người lớn:
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="buttons_added">
                                                        <input class="minus is-form" type="button" value="-">
                                                        <input aria-label="quantity" class="input-qty" max="8" min="1" name="adult" type="number" value="1">
                                                        <input class="plus is-form" type="button" value="+">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-5">
                                                    Trẻ em:
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="buttons_added">
                                                        <input class="minus is-form" type="button" value="-">
                                                        <input aria-label="quantity" class="input-qty" max="4" min="0" name="child" type="number" value="0">
                                                        <input class="plus is-form" type="button" value="+">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <button type="button" name="add" id="add-btn" class="btn btn-outline-primary">+ Thêm Phòng</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tìm khách sạn</button>
                    </div>
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
    .accordion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 10px;
        margin-bottom: 10px;
        cursor: pointer;
        border: 1px solid;
    }
    /*down up icon*/
    .accordion-item.active .accordion-header {

    }

    .arrow {
        transition: all 0.3s;
    }

    .accordion-item.active .arrow {
        transform: rotate(180deg);
    }

    .accordion-body {
        padding: 10px 10px;
        display: none;
        border: 1px solid gray;
    }

    .buttons_added {
        opacity:1;
        display:inline-block;
        display:-ms-inline-flexbox;
        display:inline-flex;
        white-space:nowrap;
        vertical-align:top;
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
    //js hidden/show
    $(document).ready(function() {
        $('.accordion-item.active .accordion-body').slideDown();
        $('.accordion-header').click(function() {
            $(this).parent().toggleClass('active');
            $(this).parent().children('.accordion-body').slideToggle();
        });
    });
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
    // $(document).ready(function() {
    //     $('#show-hidden-menu').click(function() {
    //         $('.hidden-menu').slideToggle("slow");
    //         // Alternative animation for example
    //         // slideToggle("fast");
    //     });
    // });
//gán giá trị option cho thẻ input
    function run() {
        document.getElementById("address_name").value = document.getElementById("address").value;
    }
</script>
