
@extends('layouts.admin-layout')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<br/>



<style>
        input{
            border: transparent;
        }
      
    </style>
<div class="content-wrapper">
<div class="container-fluid">
    <div class="card mb-3 ">
        <div class="card-header">
          <i class="fa fa-info-circle" style="font-size:25px"></i> Reference Number: {{$reservationDetails[0]->BookingReferenceNumber}} 
        </div>
   
        <div class="card-body">
            <div class="row" style="margin-bottom:40px">
                <div class ="col-xl-4 col-sm-6 mb-3">
                <!--<form method="GET"  action="" class="wowload fadeInRight"> -->
                                <div class="row">
                                    <!--<strong>Checkin Date</strong>-->
                                    <div class="col-sm-3 col-xl-3 col-sm-3 mb-3">
                                        <small>Checkin Date:</small>     
                                    </div>
                                    <div class="col-sm-6">
                                        <input  required id="start_time" type="text" class="date-picker form-control" name="start_time" value="{{$reservationDetails[0]->CheckinDate}}" />
                                    </div>
                                    
                                </div>
                                <br/>
                                <div class="row">
                                <div class="col-sm-3">
                                    <small>Checkout Date:</small>     
                                </div>
                                <div class="col-sm-6">
                                    <input  required id="end_time" type="text" class="date-picker form-control" name="end_time" value="{{$reservationDetails[0]->checkoutDate}}" />
                                </div>
                                </div>
                                <!--<div class="col-sm-10">
                                    <!--<strong>Checkout Date</strong>
                                    <div class="input-group">
                                         <input  required id="end_time" type="text" class="date-picker form-control" name="end_time" value="{{$reservationDetails[0]->CheckinDate}}" />
                                    </div>
                                </div> -->
                 <!--</form>-->

                </div>
                <div class ="col-xl-4 col-sm-6 mb-3">
                    <div class="row">
                        <div class="col-sm-3">
                            <small>PROMO CODE:</small>     
                        </div>
                        <div class="col-sm-6">
                            <input  id="promocode" type="text" class="form-control" name="promocode" value="{{$reservationDetails[0]->Promo_Code}}" />
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-3">
                            <small>Status:</small>     
                        </div>
                        <div class="col-sm-6">
                            <input  id="status" type="text" class="form-control" name="status" value="{{$reservationDetails[0]->Status}}" /> 
                        </div>
                    </div>
                </div>
                <div class ="col-sm-4">
                            <div class="row">
                                <div class="col-sm-3">
                                   <small>Reservation Type:</small>     
                                </div>
                                <div class="col-sm-6">
                                    <select id="reservationtype" name="status" class="form-control">
                                        <option name="rstype" id="">{{$reservationDetails[0]->reservationtype_desc}}</option>
                                    </select>  
                                </div>
                </div>
            </div>

               
            </div>
           

            <!--MODALS

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transactionmodal">
                     Launch demo modal
                </button>

            Modal -->
                <div class="modal fade" id="transactionmodal" tabindex="-1" role="dialog" aria-labelledby="transactionmodal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transactionmodal">PAYMENTS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                   
                        
                        {{ csrf_field() }}
                                <div class="form-group">
                                    <label id="lbltotaldues" for="totaldues" class="col-form-label">TOTAL DUES:</label>
                                    <input type="text" class="form-control" id="totaldues" readonly value="{{$reservationDetails[0]->Total_Charges}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="cash" class="col-form-label">CASH:</label>
                                    <input type="text" class="form-control" id="cash" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="change" class="col-form-label">CHANGE:</label>
                                    <input type="text" class="form-control" id="change" required>
                                </div>
                                <div class="form-group">
                                    <label id="lblcardnumber" for="cardnumber" class="col-form-label">CARD NUMBER:</label>
                                    <input type="text" class="form-control" id="cardnumber" required>
                                </div>
                                <div class="form-group">
                                    <label id="lblcardcode" for="cardcode" class="col-form-label">CARD CODE:</label>
                                    <input type="text" class="form-control" id="cardcode" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id="savetransaction" name="savetransaction" type="submit" class="btn btn-primary">SAVE</button>
                                </div>
                        </div>
                </div>
                </div>
                </div>
               <form id="frmsave"  action="">
                {{ csrf_field() }}
                    <div class="row">
                       
                            <div class="col-xl-4 col-sm-6 mb-3">
                            
                            <i class="fa fa-address-card" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Guest Details</medium>
                                <div class="col-sm-12 form-control">
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">NAME:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="name" name="name" type="text" class="form-control" placeholder="NAME" value="{{$reservationDetails[0]->Name}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">ADDRESS:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="address" type="text" class="form-control" placeholder="ADDRESS" value="{{$reservationDetails[0]->Address}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">CONTACT #:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="contactnum" type="text" class="form-control" placeholder="CONTACT #" value="{{$reservationDetails[0]->Phone}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Email:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="email" type="text" class="form-control" placeholder="EMAIL" value="{{$reservationDetails[0]->Email}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row" style="margin-bottom:auto">
                                        <div class="col-md-4">
                                            <small class="">Time of Arrival:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="arrivaltime" type="text" class="form-control" placeholder="Arrival Time" value="{{$reservationDetails[0]->ArrivalTime}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row" style="margin-bottom:auto">
                                        <div class="col-md-4">
                                            <small class="">Number of Adult Guests:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="arrivaltime" type="text" class="form-control" placeholder="Arrival Time" value="{{$reservationDetails[0]->NumberOfAdultGuests}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row" style="margin-bottom:auto">
                                        <div class="col-md-4">
                                            <small class="">Number of Child Guests:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="arrivaltime" type="text" class="form-control" placeholder="Arrival Time" value="{{$reservationDetails[0]->NumberOfChildGuests}}"/> 
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 mb-3">
                            <div style="margin-bottom:20px">
                                <i class="fa fa-bed" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Room Details</medium>
                                <div class="col-sm-12 form-control">
                                    <br/>
                                    <div class="container" style="margin-bottom:auto">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Room #:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomnum" name="roomnum" type="text" class="form-control text-center" placeholder="" value="{{$reservationDetails[0]->RoomID}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Type:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomtype" type="text" class="form-control text-center" placeholder="" value="{{$reservationDetails[0]->RoomType}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Class:</small>
                                          
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomclass" type="text" class="form-control text-center" placeholder="" value="{{$reservationDetails[0]->RoomClass}}"/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Extra Bed:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <input id="extrabed" name="extrabedprice" type="text" class="form-control text-center" value="{{$reservationDetails[0]->Extrabed}}"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <input id="extrabedprice" name="extrabedprice" type="text" class="form-control text-center" value="{{$reservationDetails[0]->Extrabed_Price}}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Number of Guests:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="numguests" name="extrabedprice" type="text" class="form-control text-center" value="{{$reservationDetails[0]->NumberOfAdultGuests}}"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Requests:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-control">
                                                
                                                @foreach($requests as $req)
                                                <div class="row" style="margin-left:10px">
                                                    <div class="col-sm-6 form-check form-check-inline">
                                                        <input type="hidden" id="requestsid" value="{{$req->requests_ID}}"/>
                                                        <input class="form-check-input" type="checkbox" id="req{{$req->requests_ID}}" value="{{$req->requests_ID}}"/>
                                                        <label class="form-check-label" for="requests">{{$req->RequestDescription}}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Status:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomstatus" name="roomstatus" type="text" class="form-control text-center" value="{{$reservationDetails[0]->RoomStatusCode}}"/>
                                        </div>
                                    </div>
                                    <br/>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 mb-3">
                            <i class="fa fa fa-money" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Bill Information</medium>
                                <div class="col-sm-12 form-control">
                                    <br/>
                                    <div class="container" style="margin-bottom:auto">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Rate:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomrate" type="text" class="form-control" placeholder="" value="{{$reservationDetails[0]->RoomRate}}" readonly/> 
                                        </div>
                                    </div>
                                    
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Number of stay:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="numstay" type="text" class="form-control" placeholder="" value="" readonly/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Total Room Charge:</small>
                                        </div>
                                        <div class="col-sm-5">
                                           <!-- <div class="row">
                                                <div class="col-sm-8">-->
                                                    <input id="rmcharge" type="text" class="form-control" placeholder="" value="{{$reservationDetails[0]->RoomCharge}}" readonly/> 
                                                <!--</div>
                                                <div class="col-sm-4">
                                                    <small id="numberofrooms" type="text">rooms </small>
                                               </div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Extra Bed:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="extrabedcharge" type="text" class="form-control" placeholder="" value="" readonly/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="">Total Charges:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="totalpayment" type="text" class="form-control" placeholder="" value="{{$reservationDetails[0]->Total_Charges}}" readonly/> 
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Payment Mode:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <select id="paymentmode" class="form-control text-center">
                                                    <option id="{{$reservationDetails[0]->Paymode_ID}}">{{$reservationDetails[0]->Paymode_Desc}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row" style="margin-bottom:20px">
                                        <div class="col-md-4">
                                            <small class="">Payment Status:</small>
                                        </div>
                                      
                                                <div class="col-sm-5">
                                                    <input id="paymentstatus" type="text" class="form-control" placeholder="" value="{{$reservationDetails[0]->PaymentStatus_desc}}  -  {{$reservationDetails[0]->Partial_Payment}}" /> 
                                                    <input id="partialpayment" type="hidden" class="form-control" placeholder="" value="{{$reservationDetails[0]->Partial_Payment}}" />
                                                    </div>
                                    </div>
                                    <div class="row" style="margin-bottom:20px">
                                        <div class="col-md-4">
                                            <small class="">Balance:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="balance" type="text" class="form-control" placeholder="" /> 
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>  
                </div>
                
               <!-- <div class="row" style="margin-bottom:20px">
                    <div class="col-md-1" style="margin-right:auto;margin-left:auto;">
                        <button type="submit" id="btnsave" class="form-control btn btn-danger text-center" onClick= save()>SAVE</button> 
                       
                    </div>     
                    
                </div>-->
                </form> 
                 <form method="GET" action="" id="pass" name="pass">
                 <div class="row">
                        <div class = "col-xl-4 col-sm-6 mb-3">
                        </div>
                        <div class="col-xl-4 col-sm-6 mb-3">
                            <!--<div id ="savebtn" class="row">
                                    <div class="col-sm-4">
                                    <button name="extend" id="extend" type="submit" class="btn btn-danger form-control">EXTEND</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button name="save" id="save" type="submit" class="btn btn-danger form-control">SAVE</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button name="edit" id="edit" type="submit" class="btn btn-danger form-control">REQUEST</button>
                                    </div>
                                </div>

                            <br/>-->
                            <div class="row">
                                    <input name="refnumber" class="text-center" value="{{$reservationDetails[0]->BookingReferenceNumber}}" type="hidden" />
                                    <div class ="col-sm-6">
                                        <button name="noShow" id="noShow" type="submit" class="btn btn-info form-control btn-xs mx-auto">No Show </button>
                                    </div>
                                    <br/>
                                    <div class ="col-sm-6">
                                        <button name="checkin" id="checkin" type="submit" class="btn btn-info form-control">Checking in</button>
                                    </div>
                            </div>
                            <br/>
                            <div class="row">
                            <br/>
                                    <div class ="col-sm-6">
                                            <button name="checkout" id="checkout" type="submit" class="btn btn-success form-control">Checkout </button>
                                    </div>
                                    <br/>
                                    <div class ="col-sm-6" id="print" name="print">
                                            <button name="reprint" id="reprint" type="submit" class="btn btn-success form-control">Print Receipt </button>
                                    </div>
                                    <br/>
                            </div>
                        </div>
                        <div class = "col-xl-4 col-sm-6 mb-3">
                        </div>
                </div>
                 </form>


            </div>    
                      
        </div>
    
    </div>
    </div>
    </div>
<br/>
        <script src="{{url('assets/dash/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                
                getRequests();

                if($('#paymentstatus').val() == 'PAID'){
                        $('#balance').val("0.00");
                        $('#partialpayment').hide();
                }
                else{

                        var deposits = $('#partialpayment').val();
                        var totalcharges = $('#totalpayment').val();
                        var balance= totalcharges - deposits;
                        $('#balance').val(balance);
                }
                if($('#balance').val() !="")
                {
                        var bal = $('#balance').val();
                        $('#lbltotaldues').text("BALANCE");
                        $('#totaldues').val(bal);
                }
                    
                var ONE_DAY = 1000 * 60 * 60 * 24;
                var chkindate = $('#start_time').val();
                var chkoutdate = $('#end_time').val();  
                                    
                var chkindatex = new Date(chkindate).getTime();
                var chkoutdatex = new Date(chkoutdate).getTime();
                var numdays = Math.abs(chkoutdatex-chkindatex);   
                var numdays_x = Math.abs(numdays/ONE_DAY);
                $('#numstay').val(numdays_x);

                var numextrabed = $('#extrabed').val();
                var extrabedprice = $('#extrabedprice').val();
                var extrabedcharge= numextrabed * extrabedprice;
                $('#extrabedcharge').val(extrabedcharge);

                

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
                
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}';
                    //console.log(refnumber);
                    //   $.ajax( {
                                    
                    //                 type        : 'GET',
                    //                 url         : "/noShow",
                    //                 data        : {refnum:refnumber},
                    //                 dataType    : 'json',
                    //                 async       : false,
                    //                 success     : function(data){
                    //                     var html='';
                    //                     var counter;
                    //                     alert("This Reservation is Marked NO SHOW!");
                    //                 },
                    //                 error: function(){

                    //                         alert('ERROR_X!!');
                    //                 }

                    //                 } );

                    var txt;
                    var r = confirm("Mark this Reservation as No Show?\n \t \tPress OK to Confirm");
                    if (r == true) {
                                $('#pass').attr('action','/noShow');
                                $('#pass').submit();
                                //$("#transactionmodal").modal("hide");
                    } 


                           

                });

                 $("#checkin").click(function(){
                    
                   
                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                   $('#pass').attr('action', '/checkin');
                    var name = $('#name').val();
                    alert(name + "is now Checking In....");
                 });

                  $("#checkout").click(function(e){
                    e.preventDefault();
                    if($('#paymentstatus').val() !="PAID"){
                            $("#transactionmodal").modal("toggle");
                            if($('#paymentmode').val() == "CASH"){
                                $('#cardnumber').hide();
                                $('#lblcardnumber').hide();
                                $('#lblcardcode').hide();
                                $('#cardcode').hide();
                                $('#cash').removeAttr('readonly');
                                $('#change').removeAttr('readonly');
                            }
                            else{
                                $('#cardnumber').show();
                                $('#lblcardnumber').show();
                                $('#lblcardcode').show();
                                $('#cardcode').show();
                                //$('#cash').attr('readonly','readonly');
                                $('#change').attr('readonly','readonly');
                                $('#change').val(0);
                                
                            }
                    }
                    else{
                                alert("Preparing Receipt!");
                                $('#pass').attr('action','/checkout');
                                $('#pass').submit();
                                $("#transactionmodal").modal("hide");


                    }

                  
                 });

                   $('#savetransaction').click(function(){

                                if($('#cash').val() == ""){


                                    alert("Transaction Not Completed!");
                                }
                                else{
                                    var totaldues = $('#totaldues').val();
                                    var cash = $('#cash').val();
                                    var paymode = $('#paymentmode option:selected').attr("id");

                                    var cardnumber = $('#cardnumber').val();
                                    var cardcode = $('#cardcode').val();

                                    var change =  cash-totaldues;
                                    var refnumber = "{{$reservationDetails[0]->BookingReferenceNumber}}";
                                    var transaction = {
                                                        'bookingrefnum'  : refnumber,
                                                        'totaldues' :   totaldues,
                                                        'cash'      :   cash,
                                                        'paymode'   :   paymode,
                                                        'cardnumber':   cardnumber,
                                                        'cardcode'  :   cardcode

                                    };
                                    console.log(transaction);
                                    // POST to php script
                                    $.ajax( {
                                        
                                        type        : 'POST',
                                        url         : "/payments",
                                        data        : {transaction:transaction, _token: '{{csrf_token()}}' },
                                        dataType    : 'json',
                                        async       : false,
                                        success     : function(data){
                                            var html='';
                                            var counter;
                                            alert("Transaction Saved!");
                                            alert("Generating Report!");
                                            $('#pass').attr('action','/checkout');
                                            $('#pass').submit();
                                            $("#transactionmodal").modal("hide");
                                        },
                                        error: function(){

                                                alert('Could Not Save Transaction!!');
                                        }

                                        } );

                                }
                                });   

                 $("#request").click(function(){
                    
                   // $("#additionals").toggle('show')

                   
                    
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

                 $('#cash').keyup(function(){
                
                        var totaldues = $('#totaldues').val();
                        var cash = $(this).val();

                        var change =  cash-totaldues;

                        $('#change').val(change);
                    });
                     
                   
                function toCheckout(){

                    var refnumber = '{{$reservationDetails[0]->BookingReferenceNumber}}'
                    $('#pass').attr('action', '/checkout');

                }        
                function getRequests(){
                    var refnum =  '{{$reservationDetails[0]->BookingReferenceNumber}}'; 
                    $.ajax( {
                                        
                                        type        : 'GET',
                                        url         : "/getRequests",
                                        data        : {refnum:refnum},
                                        dataType    : 'json',
                                        async       : false,
                                        success     : function(data){
                                           var html='';
                                            var counter;

                                            for (counter=0; counter<data.length; counter++){
                                                    var idx = "req"+data[counter].Request_ID;
                                                    console.log(idx);
                                                    $('#'+idx).attr('checked', true);
                                            }

                                        }
                                        } );

                }   

                function checkRoomStatus()
                {
                    var roomid =  '{{$reservationDetails[0]->RoomID}}'; 
                    $.ajax( {
                                        
                                        type        : 'GET',
                                        url         : "/roomstatus/{roomid}",
                                        dataType    : 'json',
                                        async       : false,
                                        success     : function(data){
                                           
                                           console.log(data);
                                           

                                        }
                                        } );

                }     
            });
    </script>
@endsection