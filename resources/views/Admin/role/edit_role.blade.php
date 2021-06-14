<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container">
                <form id="updateRoleForm" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="voucher_name"> Name </label>
                            <input type="text" name="name" class="form-control" id="edit_role"  value="" required>
                        </div>


                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permissions as $value)
                                <label>
                                    <input type="checkbox" id="permission_edit" name="permission[]" value="{{$value->id}}" >   {{ $value->name }}</label>
                                </label>
                                <br/>
                            @endforeach
                        </div>


                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update user</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
</div>
