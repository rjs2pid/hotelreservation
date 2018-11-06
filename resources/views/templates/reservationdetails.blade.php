


@extends('layouts.admin-layout')


@section('content')
<br/>



<style>
        input{
            border: transparent;
        }
    </style>

<div class="content-wrapper">
<div class="container-fluid" id="xx">
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Reference Number: {{$reservationDetails[0]->BookingReferenceNumber}} 
        </div>
        <div class="card-body">
   
            
            <ul class="list-group mb-3 text-default">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-1">Customer Name:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="name" class="text-center" value="{{$reservationDetails[0]->Name}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Email Address:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="email" class="text-center" value="{{$reservationDetails[0]->Email}}" readonly/>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Contact Number:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="phonenumber" class="text-center" value="{{$reservationDetails[0]->Phone}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Checkin Date:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="checkindate" class="text-center" value="{{$reservationDetails[0]->CheckinDate}}" readonly/>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Checkout Date:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="checkoutdate" class="text-center" value="{{$reservationDetails[0]->checkoutDate}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Room Type:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="roomtype" class="text-center" value="{{$reservationDetails[0]->RoomType}}" readonly/>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Room Class:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="roomclass" class="text-center" value="{{$reservationDetails[0]->RoomClass}}" readonly />
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <strong class="my-0">Room Rate:</strong>
                    </div>
                    <div class = "text-center">
                        <input name="roomrate" class="text-center" value="{{$reservationDetails[0]->RoomRate}}" readonly/>
                    </div>
                </li>
            </ul>
       
        <div class="row col-sm">
            <div class="col-md-2">
                <form  method="GET" action="" id="pass" name="pass">
            
                    <input name="refnumber" class="text-center" value="{{$reservationDetails[0]->BookingReferenceNumber}}" type="hidden" />
                    
                    <div class ="row">
                        <button name="noShow" id="noShow" type="submit" class="btn btn-danger form-control btn-xs">Mark No Show </button>
                    </div>
                    <br/>
                    <div class ="row">
                        <button name="checkin" id="checkin" type="submit" class="btn btn-info form-control">Checking in</button>
                    </div>
                    <br/>
                    <div class ="row">
                            <button name="checkout" id="checkout" type="submit" class="btn btn-success form-control">Proceed to Checkout </button>
                    </div>
                    <br/>
                    <div class ="row" id="print" name="print">
                            <button name="reprint" id="reprint" type="submit" class="btn btn-success form-control" >Print Receipt </button>
                    </div>
                    <br/>
                </form> 
            </div>
        </div>
    
    </div>


    
</div>
</div>



<br/>


        
        <script type="text/javascript"src="{{url('/assets/jquery.js')}}"></script>
       
        <script type="text/javascript">

            $(document).ready(function(){
                
                document.getElementById("reprint").disabled = true; 
                var status = '{{$reservationDetails[0]->Status}}'
                if(status == "Checked-in")
                {
                    
                    document.getElementById("checkin").disabled = true; 
                    document.getElementById("noShow").disabled = true; 
                    document.getElementById("reprint").disabled = true; 
                    document.getElementById("checkout").disabled = false; 

                }
                else if(status == "No Show")
                {

                    document.getElementById("checkin").disabled = true; 
                    document.getElementById("checkout").disabled = true; 
                    document.getElementById("reprint").disabled = true; 
                }
               else if(status == "Checked-Out")
                {

                    document.getElementById("checkin").disabled = true; 
                    document.getElementById("checkout").disabled = true; 
                    document.getElementById("noShow").disabled = true; 
                    document.getElementById("reprint").disabled = false; 
                   
                }
                else{

                   // document.getElementById("checkin").disabled = false; 
                    document.getElementById("checkout").disabled = true; 
                   // document.getElementById("noShow").disabled = true; 
                    document.getElementById("reprint").disabled = true; 

                }
                

                $("#noShow").click(function(){
                
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    $('#pass').attr('action', '/noShow');
                    alert(renumber + " " + "Marked No Show")

                });

                 $("#checkin").click(function(){
                    
                   
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    $('#pass').attr('action', '/checkin');
                    
                  
                   

                 });

                  $("#checkout").click(function(){
                    
                   
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    $('#pass').attr('action', '/checkout');
                    
                  
                   

                 });

                 $("#request").click(function(){
                    
                    $("#additionals").toggle('show')

                   
                    
                     var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    //$('#pass').attr('action', '/request');
                 });

              
                  $("#reprint").click(function(){
                    
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    if(status == "Checked-Out")
                        {

                            $('#pass').attr('action', '/Print');
                        
                        }
                    else
                    {
                        $('#pass').attr('action', '/Print');

                    }
                   
                    
                  
                    
                  
                   

                 });

                
                
            });
    </script>
@endsection