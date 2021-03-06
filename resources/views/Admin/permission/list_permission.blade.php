@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create New permisison</a>
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
                    <form id="bookForm" name="bookForm" class="form-horizontal">
                        <input type="hidden" name="permission_id" id="permission_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Title" value="" maxlength="50" required="">
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
                ajax: "{{ route('permissions.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#createNewBook').click(function () {
                $('#saveBtn').val("create-permission");
                $('#permission_id').val('');
                $('#bookForm').trigger("reset");
                $('#modelHeading').html("Create New permission");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editPermission', function () {
                var permission_id = $(this).data('id');
                $.get("{{ route('permissions.index') }}" +'/' + permission_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Permisison");
                    $('#saveBtn').val("edit-permission");
                    $('#ajaxModel').modal('show');
                    $('#permission_id').val(data.id);
                    $('#name').val(data.name);
                })
            });
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#bookForm').serialize(),
                    url: "{{ route('permissions.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#bookForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteBook', function () {

                var permission_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('permissions.store') }}"+'/'+permission_id,
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
