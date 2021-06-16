@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProperty"> Create New Property</a>
        <br>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
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
                    <form id="propertyForm" name="propertyForm" class="form-horizontal">
                        <input type="hidden" name="property_id" id="property_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="type" name="type" placeholder="Enter Title" value="" maxlength="50" required="">
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
                ajax: "{{ route('properties.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#createNewProperty').click(function () {
                $('#saveBtn').val("create-property");
                $('#property_id').val('');
                $('#propertyForm').trigger("reset");
                $('#modelHeading').html("Create New property");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editProperty', function () {
                var property_id = $(this).data('id');
                $.get("{{ route('properties.index') }}" +'/' + property_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit property");
                    $('#saveBtn').val("edit-property");
                    $('#ajaxModel').modal('show');
                    $('#property_id').val(data.id);
                    $('#name').val(data.name);
                    $('#type').val(data.type);
                })
            });
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#propertyForm').serialize(),
                    url: "{{ route('properties.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#propertyForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteProperty', function () {

                var property_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('properties.store') }}"+'/'+property_id,
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
