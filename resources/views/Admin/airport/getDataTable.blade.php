@php($sl = 1)
@foreach($airports as $airport)
    <tr>
        <td>{{ $sl++ }}</td>
        <td id="t_name_voucher" data-id1="{{ $airport->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $airport->name_voucher }}</td>
        <td id="t_date_create" data-id2="{{ $airport->id }}" contenteditable>{{ $airport->voucher_type_id }}</td>

        <td>{{$airport->golf_course}}</td>
        <td>{{$airport->money}} VND</td>


        <td>
            <a id="{{$airport->id}}" href="#editUserModal" class="btn btn-success edit" data-toggle="modal">
                <i class="fa fa-edit"></i>
            </a>

        </td>
    </tr>
    {{--Edit  modal here--}}
    @include('Admin.voucher.edit_voucher')
@endforeach
