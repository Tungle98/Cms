@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phòng khách sạn</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">hotel</li>
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

                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProductModal">
                                    <i class="fa fa-plus"><b> Book Hotel</b></i>
                                </button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="hotelDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên khách sạn</th>
                                    <th>Loại phòng</th>
                                    <th>BookingNumber</th>
                                    <th>Booking_id</th>
                                    <th>Ngày vào</th>
                                    <th>Ngày đi</th>
                                    <th>Booking code</th>
                                    <th>Số phòng</th>
                                    <th>Số tiền</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData">
                                @php($sl = 1)
                                @foreach($coll as $item)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{$item->bookingDetail->hotelName}}</td>
                                        <td>{{$item->bookingType}}</td>
                                        <td>{{$item->bookingNumber}}</td>
                                        <td>{{$item->booking_id}}</td>
                                        <td>{!!date('d/m/y', strtotime($item->checkin))!!}</td>
                                        <td>{!!date('d/m/y', strtotime($item->bookingDetail->checkout))!!}</td>
                                        <td>{{$item->bookingCode}}</td>
                                        <td>{{$item->bookingDetail->roomNumber}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>
                                                <a id="{{$item->id}}" href="#editHotelModal"   data-target="" class="edit btn btn-success" title="Edit">
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

    {{--Add room modal here--}}
    @include('Admin.hotel.add_room')

    {{--Edit room modal here--}}
    @include('Admin.hotel.edit')


@endsection
@push('page_scripts')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#hotelDatatable').DataTable();

            //load table via ajax
            function loadDataTable(){
                $.ajax({
                    url: "{{ route('admin.hotel.getTableData') }}",
                    success: function(data){
                        $('#tableData').html(data);
                    }
                })
            };
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editHotelModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/hotel/edit')}}/" + id,
                    method: "GET",
                    success: function (data) {

                        $('#edit_id').val(data.id);
                        $('#edit_name_hotel').val(data.name_hotel);
                        $('#edit_type_room').val(data.type_room);
                        $('#edit_voucher_user_id').val(data.voucher_user_id);
                        $('#edit_check_in').val(data.check_in);
                        $('#edit_check_out').val(data.check_out);
                        $('#edit_number_customer').val(data.number_customer);
                        $('#edit_number_room').val(data.number_room);
                        $('#edit_money').val(data.money);
                        $('#edit_description').val(data.description);

                    }
                })
            });

            //update voucher
            $('#updateHotelForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ route('admin.hotel.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        if (data == "done") {
                            $('#editHotelModal').modal('hide');
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
            //select2 option add voucher
            $(".address_id").select2({
                dropdownParent: $("#addProductModal")
            });

        });



    </script>

@endpush
