@php($sl = 1)
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td id="t_user_name" data-id1="{{ $user->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $user->name }}</td>
                                            <td id="t_user_email" data-id2="{{ $user->id }}" contenteditable>{{ $user->email }}</td>

                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a id="{{$user->id}}" href="#editUserModal" class="btn btn-success edit" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a id="{{$user->id}}" href="" class="btn btn-danger delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{--Edit  modal here--}}
        @include('admin.users.edit-user')
                                        @endforeach
