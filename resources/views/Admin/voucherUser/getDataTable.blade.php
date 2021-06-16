@php($sl = 1)
@foreach(v_users as $v)
    <tr>
        <td>{{ $sl++ }}</td>
        <td id="t_full_name" data-id1="{{ $v->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $v->full_name }}</td>
        <td id="t_tptal_voucher" data-id2="{{ $v->id }}" contenteditable>{{ $v->total_voucher }}</td>

        <td>{{$v->code}}</td>



        <td>
            <a id="{{$voucher->id}}" href="#editUserModal" class="btn btn-success edit" data-toggle="modal">
                <i class="fa fa-edit"></i>
            </a>

        </td>
    </tr>
    {{--Edit  modal here--}}
    @include('Admin.voucherUser.edit_voucher_user')
@endforeach
