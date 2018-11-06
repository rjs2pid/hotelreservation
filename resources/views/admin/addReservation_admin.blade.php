
@extends('layouts.admin_withcalendar')
@section('content')


<style>
        small{
           block:inline-block;
        }
        #rows{
            margin-bottom:20px;

        }
    </style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> New Reservation
            </div>
            <div class="card-body">
                <div class="row">
                    <div class ="col-sm-2">
               <!-- <form action="" class="wowload fadeInRight"> -->
                                <div class="col-sm-10">
                                    <!--<strong>Checkin Date</strong>-->
                                    <div class="input-group">
                                        <input required id="start_time" type="text" class="datepicker form-control" name="start_time" placeholder="Checkin Date"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-sm-10">
                                    <!--<strong>Checkout Date</strong>-->
                                    <div class="input-group">
                                    
                                        <input  required id="end_time" type="text" class="date-picker form-control" name="end_time" placeholder="Checkout Date"/>
                                    
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <br/>
                                    <button id="showRooms" type="submit" class="btn form-control btn-success" style="margin-bottom:4px;white-space: normal;" onClick = getResults()>Show Available Rooms</button>
                                </div>
                <!-- </form>-->
                     </div>
                        <div class ="col-sm-4">
                            <div class="row">
                                <div class="col-sm-3">
                                   <small>PROMO CODE:</small>     
                                </div>
                                <div class="col-sm-6">
                                    <select id="promocode" name="promocode" class="form-control">
                                        <option>NONE</option>
                                        @foreach($promo as $row)
                                            <option>{{$row->promo_code}}</option>
                                        @endforeach
                                    </select>  
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-3">
                                   <small>Reservation Status:</small>     
                                </div>
                                <div class="col-sm-6">
                                    <select id="status" name="status" class="form-control">
                                            <option>Reservation</option>
                                            <option>Walk-in</option>
                                    </select>  
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
                                    @foreach($reservationtype as $type)
                                            <option name="rstype" id="{{$type->reservationtype_ID}}">{{$type->reservationtype_desc}}</option>
                                    @endforeach`
                                    </select>  
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                                       
            <div class="card-body"> 
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Room Number</td>
                                <td>Room Type</td>
                                <td>Room Class</td>
                                <td>Room Rate</td>
                                <td>Room Location</td>
                                <td>Book</td>
                               </tr>
                        </thead>
                        <tbody id = "roomResult">
                                        <!--@foreach($rooms as $row)
                                            <tr id="bookings"> 
                                                <td>{{$row->RoomID}}</td>
                                                <td>{{$row->RoomType}}</td>
                                                <td>{{$row->RoomClass}}</td>
                                                <td>{{$row->RoomRate}}</td>
                                                <td>
                                                <a href = "" class = "btn form-control"><img src="images/view.png"/></a>
                                                </td>
                                                </tr>
                                        @endforeach-->
                        </tbody>
                    </table>
                </div>
                                
            </div>

            <!--Modal -->
            <div class="modal fade" id="paymentmodemodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodemodalx" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentmodemodaltitle">PAYMENT TYPE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                   
                        
                        {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="lblpayon" class="col-form-label">PAYING ON</label>
                                    <input type="text" class="form-control" id="payon" readonly value=""/>
                                </div>
                                <div class="form-group">
                                    <label id="lblamount" for="cardnumber" class="col-form-label">AMOUNT:</label>
                                    <input type="text" class="form-control" id="amount" value="" required>
                                </div>
                                <div class="form-group">
                                    <label id="lblcash" for="cardnumber" class="col-form-label">CARD NUMBER:</label>
                                    <input type="text" class="form-control" id="cardnumber" value="">
                                </div>
                                <div class="form-group">
                                    <label id="lblchange" for="cardcode" class="col-form-label">CARD CODE:</label>
                                    <input type="text" class="form-control" id="cardcode" value="">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id="savetransaction" name="savepaymentmode" type="submit" class="btn btn-primary">SAVE</button>
                                </div>
                        </div>
                </div>
                </div>
                </div>


            <div class="card-body">
               <form id="frmsave"  action="">
                {{ csrf_field() }}
                    <div class="row">
                            <div class="col-sm-4">
                            <i class="fa fa-address-card" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Guest Details</medium>
                                <div class="col-sm-12 form-control">
                                
                                    <br/>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">NAME:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" type="text" class="form-control" placeholder="NAME" required/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">ADDRESS:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="address" type="text" class="form-control" placeholder="ADDRESS" required/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">CONTACT #:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="contactnum" type="text" class="form-control" placeholder="CONTACT #" required/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Email:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="email" type="text" class="form-control" placeholder="EMAIL"/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Arrival Time:</small>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="time"class="form-control text-center">
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="ampm" class="form-control text-center">
                                                <option>AM</option>
                                                <option>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Number of Adult Guests:</small>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="numguests_adults" class="form-control text-center">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Number of Child Guests:</small>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="numguests_childs" class="form-control text-center">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <div>
                                <i class="fa fa-info-circle" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Room Details</medium>
                                <div class="col-sm-12 form-control">
                                    <br/>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Room #:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="roomnum" name="roomnum" type="text" class="form-control text-center" placeholder=""/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Type:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="roomtype" type="text" class="form-control text-center" placeholder=""/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Class:</small>
                                          
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="roomclass" type="text" class="form-control text-center" placeholder=""/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Extra Bed:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select id="extrabed" name="extrabed" class="form-control text-center">
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input id="extrabedprice" name="extrabedprice" type="text" class="form-control text-center"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Requests:</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-control">
                                                
                                                @foreach($requests as $req)
                                                <div class="row" style="margin-left:10px">
                                                    <div class="col-sm-8 form-check form-check-inline">
                                                        <input type="hidden" id="requestsid" value="{{$req->requests_ID}}"/>
                                                        <input class="form-check-input" type="checkbox" id="requests" value="{{$req->requests_ID}}"/>
                                                        <label class="form-check-label" for="requests">{{$req->RequestDescription}}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-4">
                            <i class="fa fa fa-money" style="font-size:30px"></i> <medium class="text-center text-info" style="font-size:20px">Bill Information</medium>
                                <div class="col-sm-12 form-control">
                                    
                                    <br/>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Room Rate:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="roomrate" type="text" class="form-control" placeholder="" readonly/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Number of stay:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="numstay" type="text" class="form-control" placeholder="" readonly/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Total Room Charge:</small>
                                        </div>
                                        <div class="col-sm-5">
                                           <!-- <div class="row">
                                                <div class="col-sm-8">-->
                                                    <input id="rmcharge" type="text" class="form-control" placeholder="" readonly/> 
                                                <!--</div>
                                                <div class="col-sm-4">
                                                    <small id="numberofrooms" type="text">rooms </small>
                                               </div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Extra Bed:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="extrabedcharge" type="text" class="form-control" placeholder="" readonly/> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Total Charges:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="totalpayment" type="text" class="form-control" placeholder="" readonly /> 
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Payment Mode:</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <select id="paymentmode" class="form-control text-center">
                                                @foreach($paymode as $paymodes)
                                                    <option id="{{$paymodes->Paymode_ID}}">{{$paymodes->Paymode_Desc}}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
                                        <div class="col-md-4">
                                            <small class="">Payment Status:</small>
                                        </div>
                                        <div class="col-sm-5">
                                           
                                               
                                                    <select id="paymentstat" class="form-control text-center">
                                                            @foreach($paymentstatus as $stats)
                                                                <option name="pstatus" id="{{$stats->PaymentStatus_ID}}">{{$stats->PaymentStatus_desc}}</option>
                                                            @endforeach
                                                    </select>
                                                    <input id="partialpayment" type="hidden" class="form-control" placeholder="" /> 
                                
                                        </div>
                                    </div>
                                    <div id="rows" class="row">
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
                
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-1" style="margin-right:auto;margin-left:auto;">
                        <button type="submit" id="btnsave" class="form-control btn btn-danger text-center" onClick= save()>SAVE</button> 
                       
                    </div>      
                    
                </div>
                </form> 
            </div>              
        </div>
    </div>
    
                           
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © rjstupid 2018</small>
             </div>
        </div>
    </footer>
                                <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fa fa-angle-up"></i>
            </a>
            <!-- Logout Modal-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="login.html">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   @endsection
   <!---<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="{{url('assets/dash/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
   
   $(document).ready(function(){

             var transaction= [];
             //var dp;
            $('#partialpayment').hide();

           

                $('#paymentstat option[id=1]').text('Pay Now');



            $("#extrabedprice").keyup(function(){
                        var extrabedprice = $(this).val();
                        var numberofbeds = $('#extrabed').val();

                        var totalforextrabed = extrabedprice * numberofbeds;

                        $('#extrabedcharge').val(totalforextrabed);

                        var totalrmcharge = $('#rmcharge').val();
                        
                        var grandtotal = parseInt(totalrmcharge) + parseInt(totalforextrabed);

                        $('#totalpayment').val(grandtotal);

            });
       $("#numberofrooms").keyup(function(){
           
           var numberofrooms = $(this).val();
           var roomrate = $('#roomrate').val();
           var numdays = $('#numstay').val();
           var totalroomcharge = (numberofrooms * roomrate) * numdays;
           var extrabedcharge = $('#extrabedcharge').val();
           var grandtotalx = parseInt(totalroomcharge) + parseInt(extrabedcharge);
           $('#rmcharge').val(totalroomcharge);

           

           $('#totalpayment').val(grandtotalx);

       });
       $("#partialpayment").keyup(function(){
           
           var partial = $(this).val();
           var totaldue = $('#totalpayment').val();
           
           var balancedue = parseInt(totaldue) - parseInt(partial);

           $('#balance').val(balancedue);

       });
    //    $('#paymentmode').change(function(){

    //        var type = $(this).val();
    //        $("#paymentmodemodal").modal("toggle");
    //        $('#payon').val(type);
           
    //    });
       $('#paymentstat').change(function(){
           if($(this).val() == "DP"){
                 var dp = prompt("Enter Ampunt for Down Payment:");
                var totaldue = $('#totalpayment').val();
           
                 var balancedue = parseInt(totaldue) - parseInt(dp);

                $('#balance').val(balancedue);
                // $('#partialpayment').show();
                // $('#partialpayment').prop('required',true);
                $('#partialpayment').val(dp);

           }
           else if($(this).val() == "Pay Now"){
                var type = $('#paymentmode').val();
               // $('#partialpayment').hide();
                $("#paymentmodemodal").modal("toggle");
                $('#payon').val(type);
                $('#balance').val();
           }

       });

//
        $('#savetransaction').click(function(){

                if($('#amount').val() == ""){


                    alert("Transaction Not Completed!");
                }
                else{
                    var totaldues = $('#totalpayment').val();
                    var cash = $('#amount').val();
                    var paymode = $('#paymentmode option:selected').attr("id");

                    var cardnumber = $('#cardnumber').val();
                    var cardcode = $('#cardcode').val();

                    var change =  cash-totaldues;
                    var REFKEY = 'RHR-';
                    var chkindate = $('#start_time').val();
                    var datekey = chkindate.replace(/-/g,"");
                    var lastid = "{{$nextid}}";
                    
                    var refnum = datekey.concat(REFKEY,lastid)
                    console.log(refnum);
                 
                    transaction = {
                                        'bookingrefnum': refnum,
                                        'totaldues' :   totaldues,
                                        'cash'      :   cash,
                                        'paymode'   :   paymode,
                                        'cardnumber':   cardnumber,
                                        'cardcode'  :   cardcode

                    };

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
                            $("#transactionmodal").modal("hide");
                        },
                        error: function(){

                                alert('Could Not Save Transaction!!');
                        }

                        } );
                    //console.log(transaction);

                }
                    // POST to php script
                   

                // }
                });   

//


       
       var timex;

       for(timex =1;timex<=12;timex++){
         var timechoice =new Option(timex, timex)
           $('#time').append(timechoice);
       }
        
   } );
</script>   
    <script>

        function getResults(){
            var checkindate = $('#start_time').val();
            var checkoutdate =  $('#end_time').val();
           

            var datex = {
                    'checkindate'   :   checkindate,
                    'checkoutdate'  :   checkoutdate


            };
           
           if(checkindate !== "" || checkoutdate!==""){
      
                    $.ajax({
                        
                            type        : 'GET',
                            url         : "/resultsAdmin/{checkindate}",
                            data        : {checkindate:checkindate,checkoutdate:checkoutdate},
                            dataType    : 'json',
                            async       : 'false',
                            success     : function(data){
                                //console.log(data);
                                var html='';
                                var counter;

                                for (counter=0; counter<data.length; counter++){
                                
                            html += '<tr>' +
                                        '<td id="rmID" class="rmID">'+data[counter].RoomID+'</td>'+
                                        '<td>'+data[counter].RoomType+'</td>'+
                                        '<td>'+data[counter].RoomClass+'</td>'+
                                        '<td>'+data[counter].RoomRate+'</td>'+
                                        '<td>'+data[counter].roomlocation_desc+'</td>'+
                                        '<td>'+
                                            '<input id="select" type="checkbox" value="" onClick="selectRoom()"/>'+
                                        '</td>'+
                                    '</tr>';
                                }
                                $('#roomResult').html(html);


                            }
                            
                        });
           }
           else{

               alert("Must have Valid Dates!")
           }
            
        }


    </script>

    <script>
         function selectRoom(){

                var checkBox = document.getElementById("dataTable");
                document.getElementById('dataTable').onclick = function(event){
                    event = event || window.event; //for IE8 backward compatibility
                    var target = event.target || event.srcElement; //for IE8 backward compatibility
                    while (target && target.nodeName != 'TR') {
                        target = target.parentElement;
                    }
                    //var cells = target.cells; //cells collection
                    var cells = target.getElementsByTagName('td'); //alternative
                    if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                        return;
                    }

                    var rmID = cells[0].innerHTML;
                    $.ajax({
                            type        : 'GET',
                            url         : "/roomDetailsAdmin",
                            data        : {id:rmID},
                            dataType    : 'json',
                            async       : 'false',
                            success     : function(data){
                                //console.log(data);
                                var html='';
                                var counter;
                               
                                for (counter=0; counter<data.length; counter++){
                                    var rmID = data[counter].RoomID;
                                    var rmType = data[counter].RoomType;
                                    var rmClass = data[counter].RoomClass;
                                    var rmRate = data[counter].RoomRate;
                                    $('#roomnum').val(rmID);
                                    $('#roomtype').val(rmType);
                                    $('#roomclass').val(rmClass);
                                    $('#roomrate').val(rmRate);  
                                   



                                    //get total number of days
                                    var ONE_DAY = 1000 * 60 * 60 * 24;
                                    var chkindate = $('#start_time').val();
                                    var chkoutdate = $('#end_time').val();  
                                    
                                    var chkindatex = new Date(chkindate).getTime();
                                    var chkoutdatex = new Date(chkoutdate).getTime();

                                    
                                    var numdays = Math.abs(chkoutdatex-chkindatex);   
                                    var numdays_x = Math.abs(numdays/ONE_DAY);
                                    //console.log(result);
                                    $('#numstay').val(numdays_x);
                                    //get roomcharge
                                    
                                    var extrabed = $('#extrabedcharge').val();
                                    if(extrabed =="")
                                    {

                                            extrabed  = 0

                                    }
                                    var roomcharge = rmRate * numdays_x;

                                    $('#rmcharge').val(roomcharge);

                                    var grandtotal = parseInt(roomcharge) + parseInt(extrabed);

                                    $('#totalpayment').val(grandtotal);

                                }

                            }

                            
                }); 
               
            }
         }       

        
        
    </script>
    <script>
       function getRequests(){
                var requests=[];

                    $('#requests:checked').each(function(i){
                        requests[i] = $(this).val();
                    });

                    alert(requests);

                   // console.log(requests);

        }
    </script>
    <script>

        function save(){
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                // if($('#paymentstat').val() =="DP")
                // {
                //     $('#partialpayment').prop('required',true);
                
                // }
                
               

          
                    var select = $( this ).serialize();
                    var name = $('#name').val();
                    var address =$('#address').val();
                    var contact = $('#contactnum').val();
                    var email = $('#email').val();
                    var arrivaltime = $('#time option:selected').text() + $('#ampm option:selected').text();
                    var roomid = $('#roomnum').val();
                    var numberguestsadult = $('#numguests_adults option:selected').text();
                    var numberguestschild =$('#numguests_childs option:selected').text();
                    var numextrabed = $('#extrabed option:selected').text();
                    var extrabed_price = $('#extrabedprice').val();
                    var numofstay = $('#numstay').val();
                    var roomcharge = $('#rmcharge').val();
                    var partialpayment =$('#partialpayment').val();
                    var totalcharge = $('#totalpayment').val();

                    var checkindate = $('#start_time').val();
                    var checkoutdate = $('#end_time').val();

                    var promocode = $('#promocode option:selected').text();
                    var status = $('#status option:selected').text();
                    //var paymode = $('#paymentmode option:selected').text();
                   // var cardnum = $('#cardnumber').text();
                    //var cardcode   =$('#cardcode').text();
                    var reservationtype = $("#reservationtype option:selected").attr("id");
                    var paymode = $("#paymentmode option:selected").attr("id");
                    var paymentstatus = $("#paymentstat option:selected").attr("id");

                    //alert (reservationtype);

                   var requests = [];
                   $('#requests:checked').each(function(i){
                        requests[i] = $(this).val();
                    });

                   // alert(requests);

                    var guestinfo = {
                            'name'      :   name,
                            'address'   :   address,
                            'contact'   :   contact,
                            'email'     :   email,
                            'arrivaltime'   :   arrivaltime ,
                            'roomid'    :   roomid,
                            'numberguestsadult': numberguestsadult,
                            'numberguestschild':numberguestschild,
                            'numextrabed'   : numextrabed,
                            'extrabed_price': extrabed_price,
                            'numofstay' :   numofstay,
                            'roomcharge':   roomcharge,
                            'partialpayment': partialpayment,
                            'totalcharge'   : totalcharge,
                            'checkindate'   : checkindate,
                            'checkoutdate'  : checkoutdate,
                            'promocode'     : promocode,
                            'status'        : status,
                            'reservationtype':reservationtype,
                            'paymode'       : paymode,
                            'paymentstatus' : paymentstatus

                    };
                         // 'paymode'       : paymode,
                            //'cardnum'       : cardnum,
                            //'cardcode'      : cardcode,
                    //console.log(guestinfo);

                    // POST to php script
                    $.ajax( {
                    
                            type        : 'POST',
                            url         : "/saveNewReservation",
                            data        : {guestinfo:guestinfo,requests:requests,_token: '{{csrf_token()}}' },
                            dataType    : 'json',
                            async       : false,
                            success     : function(data){
                                var html='';
                                var counter;
                                //console.log(data);
                                alert("New Reservation Added!!");
                            },
                                error: function(){

                                            alert('Could Not Save Records!!');
                                    }

                        } );
                
        }
    
    </script>
     <script>
      $(function() {
            $("#start_time" ).datepicker({
                dateFormat:"yy-mm-dd",
            });
            $("#end_time" ).datepicker({
                dateFormat:"yy-mm-dd",
            });

        } );
        </script>