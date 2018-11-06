
@extends('layouts.layout')



@section('content')
<br/>

    <style>
        input{
            border: transparent;
        }
    </style>
    <div class="container">
      <div class="row">
        <form method="POST" role="form" action="/createbooking" class="wowload fadeInRight">
            {{ csrf_field() }}
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Bill Information</span>
          </h4>
          <input name="roomid" type="hidden" value="{{$roomdetails[0]->RoomID}}"/>
          <ul class="list-group mb-3 text-success">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Room Type:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="roomtype" class="text-center" value="{{$roomdetails[0]->RoomType}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Room Class:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="roomclass" class="text-center" value="{{$roomdetails[0]->RoomClass}}"/>
                    </div>
                </li>
         </ul>
         <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <strong class="text-success">Room Rate:</strong>
              </div>
              <div class = "text-center">
                    <input name="roomrate" id="rmrate" class="text-center text-danger" value="{{$roomdetails[0]->RoomRate}}" readonly/>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="row">
                <div class="col-sm-5">
                    <strong class="tetxt-right text-success">Checkin Date:</strong> 
                    <input name="checkindate" id="chkindate" class="text-center text-danger" value ="{{$reservationdetails['checkindate']}}" readonly/>
                </div>
                <div class="col-sm-6 text-right">
                     <strong class="text-right text-success">Checkout Date:</strong> 
                     <div class="text-right">
                         <input name="checkoutdate" id="chkoutdate" class="text-right text-danger" value="{{$reservationdetails['checkoutdate']}}" readonly/>
                     </div>
                </div>
                
                
             </div>
             <br/>
             <strong class="text-success">Number of Night/s:</strong>
             <medium id="numdays" class="text-danger"></medium>
            </li>
       
            <li class="list-group-item d-flex justify-content-between">
              
                    <div class="col-sm-8 ">
                        <strong >Total (php):</span>
                    </div>
                    <div class="text-right">
                        <strong id="total" class="text-danger"></strong>
                    </div>
              
            </li>
        </ul>
        </div>


        <div class="col-md-8 order-md-1">
                <div class="row">
                    <div class="col-sm-5">
                        <h4>Customer Information</h4>
                    </div>
                </div>
         
            <ul clas="list-group">
                <li class="list-group-item d-flex justify-content-between">
                <div class="row">
                    <small class="text-muted">NAME:</small>
                </div>
                <div class="row text-center">
                    <input name="customerName" id="customerName" value="{{$reservationdetails['name']}}" readonly/>
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="row">
                        <small>EMAIL ADD:</small>
                    </div>
                    <div class="row text-center">
                            <input name="email" value="{{$reservationdetails['email']}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="row">
                        <small class="text-muted">Phone #:</small>
                    </div>
                    <div class="row text-center">
                        <input name="phone" value="{{$reservationdetails['phone']}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="row">
                        <small class="text-muted">Your Message:</small>
                    </div>
                    <div class="row text-center">
                            <inpunt name="comment" value="{{$reservationdetails['message']}}" readonly />
                    </div>
                </li>
             </ul>
             <hr class="mb-4">
             <div class="col-sm-3">
                  
                <button id="btnsave" class="btn form-control btn-primary">Confirm Booking</button>
             </div>
          </form>
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript" src = "jquery-ui/external/jquery/jquery.js"></script>
    <script type="text/javascript">
      // Example starter JavaScript for disabling form submissions if there are invalid fields
     
    $(document).ready(function(){
        
        
         var rate = parseInt('{{$roomdetails[0]->RoomRate}}');
         var ratex = parseInt(rate);
         
         var chkindatex = new Date('{{$reservationdetails['checkindate']}}');
         var chkoutdatex = new Date('{{$reservationdetails['checkoutdate']}}');
         var diffDays = Math.abs((chkindatex.getDate() - chkoutdatex.getDate()));

          
         var total = ratex * parseInt(numdays);
         var totalindouble = parseFloat(total).toFixed(2);
         $('#total').text(totalindouble)

        
    });




    </script>
    <script>



        var datax =[];

        datax.push({
            'customerName'  : '{{$reservationdetails['name']}}',
            'email'         : '{{$reservationdetails['email']}}',
            'phone'         : '{{$reservationdetails['phone']}}',
            'roomid'        : '{{$roomdetails[0]->RoomID}}',
            'checkindate'   : '{{$reservationdetails['checkindate']}}',
            'checkoutdate'  : '{{$reservationdetails['checkoutdate']}}'


        });
       
        
    </script>

@endsection
