@php($sl = 1)
@foreach($hotels as $h)
    <tr>
        <td>{{ $sl++ }}</td>
        <td id="" data-id1="{{ $h->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $h->name_hotel }}</td>
        <td id="" data-id2="{{ $h->id }}" contenteditable>{{ $h->type_room }}</td>

        <td>{{$h->description}}</td>
         <td>{{$h->full_name}}</td>
        <td>{{$h->check_in}}</td>
        <td>{{$h->check_out}}</td>
        <td>{{$h->number_customer}}</td>
        <td>{{$h->number_room}}</td>
        <td>{{$h->money}}</td>



        <td>
            <a id="{{$h->id}}" href="#editHotelModal" class="btn btn-success edit" data-toggle="modal">
                <i class="fa fa-edit"></i>
            </a>

        </td>
    </tr>
    {{--Edit  modal here--}}
    @include('Admin.hotel.edit')
@endforeach
