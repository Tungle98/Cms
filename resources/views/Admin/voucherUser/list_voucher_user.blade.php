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
                            @can('add voucherUser')
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
                                            @can('view voucherUser')
                                            <a href="user-voucher/show/{{$vou->id}}" class="btn btn-info" data-toggle="modal" data-target="#viewVoucherModal{{$vou->id}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endcan
                                            @can('edit voucherUser')
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
                        <div class="modal fade" id="viewVoucherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@push('script')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#VoucherDatatable').DataTable();

            //load table via ajax
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editVoucherModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('')}}/" + id,
                    method: "GET",
                    success: function (data) {
                        $('#edit_id').val(data.id);
                        $('#edit_voucher_type').val(data.voucher_type_id);
                        $('#edit_voucher_name').val(data.name_voucher);
                        $('#edit_golf_coure').val(data.golf_course);
                        $('#edit_date_create').val(data.date_create);
                        $('#edit_date_ex').val(data.date_ex);
                        $('#previewHolder2').attr('src', "{{asset('')}}" + data.image);
                        $('#property_id').val(data.property_id);
                    }
                })
            });
            //update voucher
            $('#updateVoucherForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ url('') }}",
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
        });
    </script>

@endpush
