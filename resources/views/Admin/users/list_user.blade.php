@extends('layouts.app')

@section('content')

    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                            <span class="h4">User List</span>
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
                                <i class="fa fa-plus"><b> Add User</b></i>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="UserDatatable" class="table table-bordered table-striped data-table">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <td>Role</td>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData">
                                @php($sl = 1)
                                @foreach($data as $key => $user)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>
                                            <a  id="{{$user->id}}" href="#editUserModal"   data-toggle="modal"  class="edit btn btn-success" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {{-- <a id="{{$user->id}}" href="" class="btn btn-danger delete">
                                                <i class="fa fa-trash"></i>
                                            </a> --}}
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
    @include('admin.users.add_user')
    @include('admin.users.edit_user')


@endsection
@push('page_scripts')

    <script>
        //for datatable

        $(document).ready( function () {
            //for datatable
            $('#UserDatatable').DataTable();
            function loadDataTable(){
            $.ajax({
                url: "{{ route('admin.user.getTableData') }}",
                success: function(data){
                    $('#tableData').html(data);
                }
            })
                 };
             loadDataTable();
            //load table via ajax
            //show data for edit modal
            $(document).on('click', '.edit', function (e) {
                $('#editUserModal').modal('show');
                e.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{url('admin/user/edit')}}/" + id,
                    method: "GET",
                    success: function (data) {
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_email').val(data.email);
                        $('#edit_role').val(data.roles);

                    }
                })
            });
            //update user
            $('#updateUserForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    url: "{{ route('admin.user.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data){
                    if (data == "done") {
                        $('#editCatModal').modal('hide');
                        loadDataTable();
                        Swal.fire({
                              title: 'user updated success',
                              icon: 'success',
                              timer: 2000
                            })
                    }
                },
                });
            });

             //delete user
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    $.ajax({
                        url: "{{url('admin/user/delete')}}/"+id,
                        method: "GET",
                        success: function(data){
                            if (data == "done") {
                                loadDataTable();
                            }
                        }
                    })
                    Swal.fire(
                      'Deleted!',
                      'User has been deleted.',
                      'success'
                    )
                  }
                })

    });
    //inline edit user name
    $(document).on('blur', '#t_user_name', function(){
        var id = $(this).data("id1");
        var text = $(this).text();
        inlineEdit(id, text, "name");
    });
    //inline edit user description
    $(document).on('blur', '#t_user_email', function(){
        var id = $(this).data("id2");
        var text = $(this).text();
        inlineEdit(id, text, "email");
    });
        });
    </script>

@endpush
