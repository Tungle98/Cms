@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="row" style="padding-top: 50px">
           <div class="col-lg-8">

               <div class="info-room" style="background: white; margin-bottom: 20px">
                   <div class="row"  style="padding: 20px">
                       <div class="col-md-3">
                           <img src="https://i.travelapi.com/hotels/39000000/38540000/38535200/38535115/d8afb662_d.jpg" class="">
                       </div>
                       <div class="col-md-9" style="padding-left: 30px">
                           <h3>Xuan Lai Right View - Hostel</h3>
                           <div>Văn Lâm, Ninh Hải , Hoa Lư</div>
                           <div>Phòng 2 người lớn, 0 trẻ em</div>
                           <div>
                               <span>Ngày nhận phòng</span>
                           </div>
                           <div>
                               <span>Ngày trả phòng</span>
                           </div>
                           <div>
                               <span>1 giường cỡ queen</span>
                           </div>
                       </div>

                   </div>
               </div>
               <div class="service-room" style="background: white;margin-bottom: 20px">
                   <h3 style="padding-left: 20px">Tiện ích chung</h3>
                    <div class="row" style="padding: 0px 20px 20px 20px ">

                        <div class="col-md-6">
                            <h6>1 giường cỡ queen</h6>
                            <h6>  Ăn sáng miễn phí</h6>
                            <h6>  Wifi miễn phí</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>Bãi đậu xe tự phục vụ miễn phí</h6>
                            <h6> Bữa sáng miễn phí</h6>
                        </div>
                    </div>
               </div>
               <div class="book-room" style="background: white ;margin-bottom: 20px">
                    <h3 style="padding-left: 20px ">Người đặt phòng</h3>
                   <form  style="padding: 0px 20px 20px 20px">
                       <div class="form-group">
                           <label for="inputAddress">Họ và tên</label>
                           <input type="text" class="form-control" id="inputAddress" >
                       </div>
                       <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="inputEmail4">Email</label>
                               <input type="email" class="form-control" id="inputEmail4">
                           </div>
                           <div class="form-group col-md-6">
                               <label for="inputPassword4">Số điện thoại</label>
                               <input type="number" class="form-control" id="inputPassword4">
                           </div>
                       </div>
{{--                       <button type="submit" class="btn btn-primary">Sign in</button>--}}
                   </form>
               </div>
           </div>
           <div class="col-lg-4">
               <div class="paid-money"  style="background: white; padding: 10px">
                    <div class="row">
                        <div class="col-md-7">
                            <div>Mỗi phòng/ Mỗi đêm</div>
                            <div>Giá cho 1 phòng, 3 đêm</div>
                            <div>Thuế, phí</div>
                        </div>
                        <div class="col-md-5">
                           <div> 580.996 VNĐ</div>
                            <div> 1.700.000 VNĐ</div>
                            <div> 240.000 VNĐ</div>
                        </div>
                    </div>
                   <hr>
                   <div class="row">
                       <div class="col-md-7">Tổng cộng</div>
                       <div class="col-md-5">2.000.000 VNĐ</div>
                   </div>
                   <hr>
                   <div style="text-align: center">
                       <button type="submit" class="btn btn-primary">Xác nhận</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
