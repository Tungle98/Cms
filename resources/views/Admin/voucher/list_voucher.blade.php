@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Voucher Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Voucher</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @if(session('message'))
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            @endif
        </section>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        @can('voucher-add')
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProductModal">
                                <i class="fa fa-plus"><b> Tạo voucher</b></i>
                            </button>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="VoucherDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên voucher</th>
                                    <th>Loại voucher</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Sân golf</th>
                                    <th>Giá tiền</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData">
                                @php($sl = 1)
                                @foreach($voucher_db as $vouchers)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{$vouchers->name_voucher}}</td>
                                        <td>{{$vouchers->name}}</td>
                                        <td>{!!date('d/m/y', strtotime($vouchers->date_create))!!}</td>
                                        <td>{!!date('d/m/y', strtotime($vouchers->date_ex))!!}</td>
                                        <td>{{$vouchers->golf_course}}</td>
                                        <td>{{$vouchers->money}} VND</td>
                                        <td>
                                            <img src="{{asset($vouchers->image)}}" height="100px" alt="image">
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" data-id="{{ $vouchers->id }}" name="status" class="js-switch" {{ $vouchers->status == 1 ? 'checked' : '' }}>
                                        </td>



                                        <td>
                                            <a  data-url="{{ url('admin/voucher/show',$vouchers->id) }}" type="button" href="#show" data-toggle="modal" class="btn btn-info btn-show"  >
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @can('voucher-edit')
                                            <a  id="{{$vouchers->id}}" href="#editVoucherModal"  class="edit btn btn-success" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--Add Product modal here--}}
    @include('Admin.voucher.add_voucher')

    {{--Edit Product modal here--}}
    @include('Admin.voucher.edit_voucher')

    {{--View Product modal here--}}
    @include('Admin.voucher.show_voucher')

@endsection
@push('page_scripts')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#VoucherDatatable').DataTable();

            //load table via ajax
            function loadDataTable(){
                $.ajax({
                    url: "{{ route('admin.voucher.getTableData') }}",
                    success: function(data){
                        $('#tableData').html(data);
                    }
                })
            };
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editVoucherModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/voucher/edit')}}/" + id,
                    method: "GET",
                    success: function (data) {
                        $('#edit_id').val(data.id);
                        $('#edit_voucher_type').val(data.voucher_type_id);
                        $('#edit_voucher_name').val(data.name_voucher);
                        $('#edit_golf_course').val(data.golf_course);
                        $('#edit_date_create').val(data.date_create);
                        $('#edit_date_ex').val(data.date_ex);
                        $('#previewHolder2').attr('src', "{{asset('')}}" + data.image);
                        $('#edit_status').val(data.status);
                        $('#edit_money').val(data.money);
                        $('#edit_voucher_number').val(data.voucher_number);
                        $('#edit_voucher_content').val(data.voucher_content);
                        $('#edit_voucher_field').val(data.voucher_field);
                        //console.log(data.properties);

                        for ( let property of data.properties) {

                            $('.properties-place').append(`<p>${property.name}</p>`)
                        }
                        // <input type="text" id="property_id" name="properties[]" class="form-control" placeholder="">
                        // $('#property_id').val(data.properties);
                    }
                })
            });
            //update voucher
            $('#updateVoucherForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ route('admin.voucher.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data == "done") {
                            $('#editVoucherModal').modal('hide');
                           loadDataTable();
                            Swal.fire({
                                title: 'voucher Updated',
                                icon: 'success',
                                timer: 2000
                            })
                        }
                    },
                });
            });
            //status change
            //category publish
            $(document).on('click', '.publish', function(e){
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/voucher/publish')}}/"+id,
                    method: "GET",
                    beforeSend: function(){
                        $('.loader').show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(data){
                        if (data == "done") {
                            loadDataTable();
                        };
                    }
                })
            });
            //voucher unpublish
            $(document).on('click', '.unpublish', function(e){
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/voucher/unpublish')}}/"+id,
                    method: "GET",
                    beforeSend: function(){
                        $('.loader').show();

                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(data){
                        if (data == "done") {
                            loadDataTable();
                        };
                    }
                })
            });
            //format money
            $('.price_format').simpleMoneyFormat();
            //show detail
            $('.btn-show').click(function () {
                var url = $(this).attr('data-url');
                console.log($(this).attr('data-url'));
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        //console.log(response)
                        $('.voucher-show').html(response);

                    },
                });
            });
            //toggle
            let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
                let switchery = new Switchery(html,  { size: 'small' });
            });
            //ajax change toggle
            $(document).ready(function(){
                $('.js-switch').change(function () {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let voucherId = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('admin.voucher.update-status') }}',
                        data: {'status': status, 'voucher_id': voucherId},
                        success: function (data) {
                            // console.log(data.message);
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.success(data.message);
                        }
                    });
                });
            });

        });
    </script>

@endpush
