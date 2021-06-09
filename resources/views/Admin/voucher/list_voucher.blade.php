@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
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
                            <span class="h4">Voucher List</span>

                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProductModal">
                                <i class="fa fa-plus"><b> Add New</b></i>
                                </button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="VoucherDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên voucher</th>
                                    <th>Loai voucher</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Sân golf</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($voucher_db as $vouchers)
                                    <tr>
                                        <td>{{$vouchers->id}}</td>
                                        <td>{{$vouchers->name_voucher}}</td>
                                        <td>{{$vouchers->name}}</td>
                                        <td>{{$vouchers->date_create}}</td>
                                        <td>{{$vouchers->date_ex}}</td>
                                        <td>{{$vouchers->golf_course}}</td>
                                        <td>
                                            <img src="{{asset($vouchers->image)}}" height="100px" alt="image">
                                        </td>

                                        <td>{{$vouchers->status=='1'?'Active':'Inactive'}}</td>
                                        <td>

                                            <a  href="#editVoucherModal{{$vouchers->id}}" id="{{$vouchers->id}}"  class="edit btn btn-success" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
                    url: "{{url('voucher/edit')}}/" + id,
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
                    url: "{{ url('voucher/update') }}",
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
