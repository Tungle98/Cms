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
            <form id="addProductForm" method="post" action="{{ route('admin.hotel') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Địa điểm </label>
                            <div class="form-group">
                                <select class="js-example-basic-single">
{{--                                    @foreach($coll as $item)--}}
{{--                                        <h1>{{$item->name}}</h1>--}}
{{--                                    @endforeach--}}

                                    <option value="AL">Alabama</option>
                                    ...
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label>Ngày nhận & trả phòng</label>
                            <div class="form-group">
                                <input id="button-picker" />
                                <button id="show-picker">Show picker</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Phòng & khách</label>
                            <div class="form-group">
                                <input type="text" placeholder="Số khách">

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tìm khách sạn</button>
                    </div>
                </div>
            </form>
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
    $(document).ready(function() {
        $(".js-example-basic-single").select2({
            dropdownParent: $("#addProductModal")
        });
    });
    mobiscroll.datepicker('#button-picker', {
        controls: ['calendar'],
        select:'range',
        touchUi: true,
        showOnClick: false,
        showOnFocus: false
    });

    document
        .getElementById('show-picker')
        .addEventListener('click', function () {
            instance.open();
            return false;
        });
</script>
