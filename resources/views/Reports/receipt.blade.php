<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
        <link href="{{url('assets/dash/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
         <script src="{{url('assets/dash/vendor/jquery/jquery.min.js')}}"></script>
         <script src="{{url('assets/dash/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        
        <title>SCC Hotel || Itinerary</title>
        
      
    </head>
    <body>
       
   

    <div class="container">
        <h3 class="text-center">HOTEL CECILIA</h3>
        <h5 class="text-center">OFFICIAL RECEIPT</h5>
        <h6 class="text-center"><?php 
        $d=strtotime(date("Y/m/d h:i:sa"));
            echo date("Y-m-d h:i:sa", $d);
        ?></h6>
        
            <div class="panel-heading">
                             @foreach($bookingdetails as $key => $bookingDetails)
                                @if (isset($bookingDetails->isEmpty) )  
                                    <h4 class='text-danger'>NO RECORDS FOUND</h4>
                                @endif

                 <?php 
                    $roomcharge = $bookingDetails->RoomRate;
                    $numnights = $bookingDetails->numnights;

                    $total = $roomcharge * $numnights;
                    $numextrabed = $bookingDetails->Extrabed * 1;

                    $addon_total = $bookingDetails->Extrabed * $bookingDetails->Extrabed_Price;
                    $grandtotal =  $total +  $addon_total;

                    $vat = 0.00;
                ?>
                <a class="form-control text-right">
                    REFERENCE NUMBER: {{$bookingDetails->BookingReferenceNumber}}
                </a>
               
        
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px ">
                        <thead class="text-center" style="font-size:10px">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact #</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr style="font-size:10px" >
                                <td>{{$bookingDetails->Name}}</td>
                                <td>{{$bookingDetails->Address}}</td>
                                <td>{{$bookingDetails->Phone}}</td>
                                                                  
                            </tr>
                        @endforeach 


                        </tbody>

                    </table>
                    <medium class="text-danger">Room Details</medium>
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center"  style="font-size:10px">
                            <tr>
                                <th>Room Number</th>
                                <th>Room Class</th>
                                <th>Room Type</th>
                                <th>Room Rate</th>
                                <th>Checkin Date</th>
                                <th>Checkout Date</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <tr style="font-size:10px">
                                <td>{{$bookingDetails->RoomID}}</td>
                                <td>{{$bookingDetails->RoomClass}}</td>
                                <td>{{$bookingDetails->RoomType}}</td>
                                <td>{{$bookingDetails->RoomRate}}</td>
                                <td>{{$bookingDetails->CheckinDate}}</td>
                                <td>{{$bookingDetails->checkoutDate}}</td>  
                            </tr>
                        </tbody>

                    </table>
                <medium class="text-danger">Bill Information</medium>
                <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center" style="font-size:10px">
                            <tr>
                                <th>Number of Nights</th>
                                <th>Rate</th>
                                <th>Extra Bed</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <tr style="font-size:10px">
                                <td>{{$bookingDetails->numnights}}</td>
                                <td>{{$bookingDetails->RoomRate}}</td>
                                <td><?php echo($numextrabed) ?> = <?php echo($addon_total) ?></td>
                                <td><?php echo($grandtotal) ?></td> 
                            </tr>
                        </tbody>

                    </table>

                            <div class="col-sm-4 text-right">
                                    <small>Room Charge      :</small>
                                    <small>     <?php echo($total) ?></small>
                            </div>
                            <div class="col-sm-4 text-right">
                                    <small>Extra Bed        :</small>
                                    <small>     <?php echo($addon_total) ?></small>
                            </div>
                            <div class="col-sm-4 text-right">
                                    <small>VAT      :</small>
                                    <small> <?php echo($vat) ?></small>
                            </div>
                            <div class="col-sm-4 text-right">
                                    <small><b>Total     :</b></small>
                                    <small><b><u>      <?php echo($grandtotal) ?></b><u></small>
                            </div>
                    
</div>
    </div>

   



    
  
   
    
  </body>
</html>

      

        




