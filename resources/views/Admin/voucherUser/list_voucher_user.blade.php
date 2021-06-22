@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông tin khách hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">customer</li>
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
                           @can('voucherUser-add')
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProductModal">
                                <i class="fa fa-plus"><b> Mua voucher</b></i>
                            </button>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="userDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tổng số vé</th>
                                    <th>voucher</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức TT</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData">
                                @php($sl = 1)
                                @foreach($voucher_user as $vou)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{$vou->id}}</td>
                                        <td>{{$vou->full_name}}</td>
                                        <td>{{$vou->total_voucher}}</td>
                                        <td>{{$vou->name_voucher}}</td>
                                        <td>{{$vou->phone}}</td>
                                        <td>{{$vou->status}}</td>
                                        <td>{{$vou->method_paid}}</td>
                                        <td>

                                           @can('voucherUser-view')
                                            <a  data-url="{{ url('admin/user_voucher/show',$vou->id) }}" type="button" href="#show" data-toggle="modal" class="btn btn-info btn-show"  >
                                                <i class="fa fa-eye"></i>
                                              </a>
                                              @endcan

                                            @can('voucherUser-edit')
                                            <a id="{{$vou->id}}" href="#editVoucherUserModal"   data-target="" class="edit btn btn-success" title="Edit">
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
    @include('Admin.voucherUser.add_voucher_user')

    {{--Edit Product modal here--}}
    @include('Admin.voucherUser.edit_voucher_user')

    {{--View Product modal here--}}
    @include('Admin.voucherUser.show_voucher_user')

@endsection
@push('page_scripts')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#userDatatable').DataTable();

            //load table via ajax
            function loadDataTable(){
                $.ajax({
                    url: "{{ route('admin.voucher_user.getTableData') }}",
                    success: function(data){
                        $('#tableData').html(data);
                    }
                })
            };
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editVoucherUserModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/user_voucher/edit')}}/" + id,
                    method: "GET",
                    success: function (data) {

                       $('#edit_id').val(data.id);
                        $('#edit_voucher_id').val(data.voucher_id);
                        $('#edit_user').val(data.user_id);
                        $('#edit_full_name').val(data.full_name);
                        $('#edit_total_voucher').val(data.total_voucher);
                        $('#edit_code').val(data.code);
                        $('#edit_phone').val(data.phone);
                        $('#edit_email').val(data.email);
                        $('#edit_status').val(data.status);
                        $('#edit_method_paid').val(data.method_paid);
                        $('#edit_check_out').val(data.check_out);
                        $('#edit_check_in').val(data.check_in);
                        $('#edit_number_adult').val(data.number_adult);
                        $('#edit_number_babie').val(data.number_children);
                        $('#edit_number_children').val(data.number_babie);
                        $('#edit_note').val(data.note);
                        $('#edit_booking_service').val(data.booking_service);
                    }
                })
            });

            //update voucher
            $('#updateVoucherUserForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ route('admin.voucher_user.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        if (data == "done") {
                            $('#editVoucherUserModal').modal('hide');
                            loadDataTable();
                            Swal.fire({
                                title: 'user voucher updated',
                                icon: 'success',
                                timer: 2000
                            })
                        }

                    },
                });
            });
             //show detail
            $('.btn-show').click(function () {
                var url = $(this).attr('data-url');
                console.log($(this).attr('data-url'));
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (response) {
                        //console.log(response)
                        $('.content-user').html(response);

                    },
                });
            });
            //select2 option add voucher
            $('#voucher_id').select2({
                dropdownParent: $("#addProductModal")
            });

        });



    </script>

@endpush
