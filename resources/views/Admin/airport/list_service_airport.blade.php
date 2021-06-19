@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dịch vụ sân bay</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">service airport</li>
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
                                    <i class="fa fa-plus"><b> Tạo đơn</b></i>
                                </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="AirportDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>code</th>
                                    <th>Người đại diện mua</th>
                                    <th>Số lượng mua</th>
                                    <th>Ngày bay</th>
                                    <th>Giờ bay/ Số hiệu</th>
                                    <th>Dịch vụ mua kèm</th>
                                    <th>Tình trạng</th>
                                    <th>Số tiền</th>
                                    <th>Người làm lệnh</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData">
                                @php($sl = 1)
                                @foreach($airports as $value)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{$value->code}}</td>
                                        <td>{{$value->purchase_representative}}</td>
                                        <td>{{$value->total_ticket}}</td>
                                        <td>{{$value->flight_date}}</td>
                                        <td>{{$value->flight_hour}}/{{$value->flight_number}}</td>
                                        <td>{{$value->bundled_service}}</td>
                                        <td>{{$value->status}}</td>

                                        <td>{{$value->money}}</td>
                                        <td>{{$value->user_id}}</td>
                                        <td>

                                                <a  id="{{$value->id}}" href="#editAirportModal"  class="edit btn btn-success" title="Edit">
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
    @include('Admin.airport.add_service_airport')

    {{--Edit Product modal here--}}
    @include('Admin.airport.edit_service_airport')



@endsection
@push('page_scripts')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#AirportDatatable').DataTable();

            //load table via ajax
            function loadDataTable(){
                $.ajax({
                    url: "{{ route('admin.airport.getTableData') }}",
                    success: function(data){
                        $('#tableData').html(data);
                    }
                })
            };
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editAirportModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/airport/edit')}}/" + id,
                    method: "GET",
                    success: function (data) {
                        $('#edit_id').val(data.id);
                        $('#edit_code').val(data.code);
                        $('#edit_user').val(data.purchase_representative);
                        $('#edit_total_ticket').val(data.total_ticket);
                        $('#edit_flight_date').val(data.flight_date);
                        $('#edit_flight_hour').val(data.flight_hour);
                        $('#edit_status').val(data.status);
                        $('#edit_money').val(data.money);
                        $('#edit_flight_number').val(data.flight_number);
                        $('#edit_service').val(data.bundled_service);

                    }
                })
            });
            //update voucher
            $('#updateAirportForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ route('admin.airport.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data == "done") {
                            $('#editAirportModal').modal('hide');
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

            //format money
            $('.price_format').simpleMoneyFormat();


        });
    </script>

@endpush
