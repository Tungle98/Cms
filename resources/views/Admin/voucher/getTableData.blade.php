@php($sl = 1)
                                        @foreach($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td id="t_name_voucher" data-id1="{{ $voucher->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $voucher->name_voucher }}</td>
                                            <td id="t_date_create" data-id2="{{ $voucher->id }}" contenteditable>{{ $voucher->voucher_type_id }}</td>


                                           <td>{!!date('d/m/y', strtotime($voucher->date_create))!!}</td>
                                           <td>{!!date('d/m/y', strtotime($voucher->date_ex))!!}</td>
                                           <td>{{$voucher->golf_course}}</td>
                                            <td>{{$voucher->money}} VND</td>
                                           <td>
                                               <img src="{{asset($voucher->image)}}" height="100px" alt="image">
                                           </td>
<td>
                                                @if($voucher->status == 1)
                                                <a id="{{$voucher->id}}" href="" class="btn btn-primary unpublish" data-toggle="tooltip" title="Published">
                                                    <i class="fa fa-arrow-up"></i>
                                                </a>
                                                @else
                                                <a id="{{$voucher->id}}" href="" class="btn btn-warning publish" data-toggle="tooltip" title="Unpublished">
                                                    <i class="fa fa-arrow-down"></i>
                                                </a>
                                                @endif
                                            </td>

                                            <td>
                                                <a id="{{$voucher->id}}" href="#editUserModal" class="btn btn-success edit" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        {{--Edit  modal here--}}
        @include('Admin.voucher.edit_voucher')
                                        @endforeach
