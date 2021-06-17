@php($sl = 1)
                                        @foreach($hotels as $hotel)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td id="t_name_voucher" data-id1="{{ $voucher->id }}" ondblclick="this.contentEditable=true" onblur="this.contentEditable=false">{{ $voucher->name }}</td>
                                            <td id="t_date_create" data-id2="{{ $voucher->id }}" contenteditable>{{ $voucher->email }}</td>

                                           <td>{{$vouchers->name}}</td>
                                           <td>{!!date('d/m/y', strtotime($vouchers->date_create))!!}</td>
                                           <td>{!!date('d/m/y', strtotime($vouchers->date_ex))!!}</td>
                                           <td>{{$vouchers->golf_course}}</td>
                                           <td>
                                               <img src="{{asset($vouchers->image)}}" height="100px" alt="image">
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
