@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">user voucher</li>
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
                            <span class="h4">Voucher user List</span>
                           @can('voucherUser-add')
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProductModal">
                                <i class="fa fa-plus"><b> Add New</b></i>
                            </button>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="userDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên khách</th>
                                    <th>Tổng số vé</th>
                                    <th>voucher</th>
                                    <th>code</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức TT</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($voucher_user as $vou)
                                    <tr>
                                        <td>{{$vou->user_id}}</td>
                                        <td>{{$vou->full_name}}</td>
                                        <td>{{$vou->total_voucher}}</td>
                                        <td>{{$vou->name_voucher}}</td>
                                        <td>{{$vou->code}}</td>
                                        <td>{{$vou->status}}</td>
                                        <td>{{$vou->method_paid}}</td>

                                        <td>
                                            @can('voucherUser-view')
                                            <a href="user-voucher/show/{{$vou->id}}" class="btn btn-info" data-toggle="modal" data-target="#viewVoucherModal{{$vou->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endcan
                                            @can('voucherUser-edit')
                                            <a href="#editVoucherUserModal"  id="{{$vou->id}}" data-target="" class="edit btn btn-success" title="Edit">
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
                        <div class="modal fade" id="viewVoucherModal{{$vou->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <div class="col-md-12">  <h4>Tên khách hàng:{{$vou->full_name}}</h4></div>
                                                    <div class="col-md-6">Id:{{$vou->user_id}}</div>
                                                    <div class="col-md-6">Tổng số voucher:{{$vou->total_voucher}}</div>
                                                    <div class="col-md-6">Voucher id:{{$vou->voucher_id}}</div>
                                                    <div class="col-md-6">Code:{{$vou->code}}</div>
                                                    <div class="col-md-6">Trạng thái:{{$vou->status}}</div>
                                                    <div class="col-md-6">Phương thức thanh toán:{{$vou->method_paid}}</div>
                                                    <div class="col-md-6">San golf:{{$vou->golf_course}}</div>
                                                </div>
                                                <table>
                                                    @foreach($voucherWithProperties as $s)
                                                    <tr>

                                                        <td>{{$s->name}}</td>
                                                        <td>
                                                            <input data-id="{{$s->id}}" name="properties[{{$s->id}}]" type="text"  placeholder="value" class="property-value">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <button type="submit" class="btn btn-primary" >Đồng ý</button>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                        $('#edit_user_id').val(data.user_id);
                        $('#edit_full_name').val(data.full_name);
                        $('#edit_total_voucher').val(data.total_voucher);
                        $('#edit_status').val(data.status);
                        $('#edit_method_paid').val(data.method_paid);
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
                                title: 'voucher Updated',
                                icon: 'success',
                                timer: 2000
                            })
                        }
                    },
                });
            });
        });
    </script>

@endpush
