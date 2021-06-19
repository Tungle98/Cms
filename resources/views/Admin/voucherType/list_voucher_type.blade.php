@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewType"> Tạo loại voucher</a>
        <br>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th width="300px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="typeForm" name="typeForm" class="form-horizontal">
                        <input type="hidden" name="type_id" id="type_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('voucher_types.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#createNewType').click(function () {
                $('#saveBtn').val("create-type");
                $('#type_id').val('');
                $('#typeForm').trigger("reset");
                $('#modelHeading').html("Tạo loại voucher");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editType', function () {
                var type_id = $(this).data('id');
                $.get("{{ route('voucher_types.index') }}" +'/' + type_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit ");
                    $('#saveBtn').val("edit-type");
                    $('#ajaxModel').modal('show');
                    $('#type_id').val(data.id);
                    $('#name').val(data.name);
                })
            });
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#typeForm').serialize(),
                    url: "{{ route('voucher_types.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#typeForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteType', function () {

                var type_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('voucher_types.store') }}"+'/'+type_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>

@endpush
