@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12" style="text-align: center">
            <div >
                <h2>List voucher</h2>
            </div>
            <br/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                @role('writer')
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-voucher" data-toggle="modal">New Voucher</a>
                @endrole
            </div>
        </div>
    </div>
    <br/>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p id="msg">{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name voucher</th>
            <th>Ngay tao</th>
            <th>Ngay het han</th>
            <th>San golf</th>
            <th>Image</th>
            <th>Status</th>
            <th>Loai voucher</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($vouchers as $voucher)
            <tr id="customer_id_{{ $voucher->id }}">
                <td>{{ $voucher->id }}</td>
                <td>{{ $voucher->name }}</td>
                <td>{{ $voucher->email }}</td>
                <td>{{ $voucher->address }}</td>
                <td>
                    <form action="{{ route('$vouchers.destroy',$voucher->id) }}" method="POST">
                        <a class="btn btn-info" id="show-voucher" data-toggle="modal" data-id="{{ $voucher->id }}" >Show</a>
                        <a href="javascript:void(0)" class="btn btn-success" id="edit-voucher" data-toggle="modal" data-id="{{ $voucher->id }}">Edit </a>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <a id="delete-voucher" data-id="{{ $voucher->id }}" class="btn btn-danger delete-user">Delete</a></td>
                </form>
                </td>
            </tr>
        @endforeach

    </table>

    {!! $vouchers->links() !!}
    <!-- Add and Edit customer modal -->
    <div class="modal fade" id="crud-modal" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="customerCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form name="custForm" action="{{url('customers.store')}}" method="POST">
                        <input type="hidden" name="cust_id" id="cust_id" >
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Address:</strong>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" onchange="validate()" onkeypress="validate()">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
                                <a href="{{url('vouchers.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Show customer modal -->
    <div class="modal fade" id="crud-modal-show" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="customerCrudModal-show"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                            @if(isset($voucher->name))

                                <table>
                                    <tr><td><strong>Name:</strong></td><td>{{$voucher->name}}</td></tr>
                                    <tr><td><strong>Email:</strong></td><td>{{$voucher->email}}</td></tr>
                                    <tr><td><strong>Address:</strong></td><td>{{$voucher->address}}</td></tr>
                                    <tr><td colspan="2" style="text-align: right "><a href="{{ route('$voucher.index') }}" class="btn btn-danger">OK</a> </td></tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        error=false

        function validate()
        {
            if(document.custForm.name.value !='' && document.custForm.email.value !='' && document.custForm.address.value !='')
                document.custForm.btnsave.disabled=false
            else
                document.custForm.btnsave.disabled=true
        }
    </script>
    <script>
        $(document).ready(function () {

            /* When click New customer button */
            $('#new-voucher').click(function () {
                $('#btn-save').val("create-customer");
                $('#voucher').trigger("reset");
                $('#customerCrudModal').html("Add New Customer");
                $('#crud-modal').modal('show');
            });

            /* Edit customer */
            $('body').on('click', '#edit-customer', function () {
                var customer_id = $(this).data('id');
                $.get('customers/'+customer_id+'/edit', function (data) {
                    $('#customerCrudModal').html("Edit customer");
                    $('#btn-update').val("Update");
                    $('#btn-save').prop('disabled',false);
                    $('#crud-modal').modal('show');
                    $('#cust_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                })
            });
            /* Show customer */
            $('body').on('click', '#show-voucher', function () {
                $('#customerCrudModal-show').html("Customer Details");
                $('#crud-modal-show').modal('show');
            });

            /* Delete customer */
            $('body').on('click', '#delete-voucher', function () {
                var customer_id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "http://localhost/laravel7crud/public/customers/"+customer_id,
                    data: {
                        "id": customer_id,
                        "_token": token,
                    },
                    success: function (data) {
                        $('#msg').html('Customer entry deleted successfully');
                        $("#customer_id_" + customer_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });

    </script>
@endpush
