@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permission Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permission</li>
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
                            <span class="h4">Permission List</span>
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
                                <i class="fa fa-plus"><b> Add New</b></i>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="brandDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php($sl = 1)
                                @foreach($permissions as $p)
                                    <tr>
                                        <td>{{$sl++}}</td>

                                        <td>{{$p->name}}</td>
                                        <td>
                                            <a  id="{{$p->id}}" href="#editPermissionModal"  class="edit btn btn-success" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a id="{{$p->id}}" href="#" class="btn btn-danger delete">
                                                <i class="fa fa-trash"></i>
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
    @include('Admin.permission.add_permission')
    {{--Edit Product modal here--}}
    @include('Admin.permission.edit_permission')
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
                $('#editPermissionModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('vouchers/edit')}}/" + id,
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
                    url: "{{ url('vouchers.update') }}",
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
