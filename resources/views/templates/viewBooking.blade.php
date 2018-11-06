@extends('layouts.layout')



@section('content')


    @if (isset($bookingdetails->isEmpty) )  
        <h4 class='text-danger'>NO RECORDS FOUND</h4>
    @endif



<div class="container">
        <div class="row">
            <br/>
            <h2 class="text-center"> Your Reservation Itinerary</h2>
        </div>
        <div class="row">
            <h3 class="text-right text-danger">Booking Reference Number:{{$bookingdetails[0]->BookingReferenceNumber}}</h3>
            
        </div>
        <br/>
            <medium class="text-danger">Customer Information</medium>
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center">
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Check-in Date</th>
                                <th>Check-Out Date</th>
                                <th>Num. of Guests</th>
                                <th>Num. of Nights</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr>
                                <td>{{$bookingdetails[0]->Name}}</td>
                                <td>{{$bookingdetails[0]->CheckinDate}}</td>
                                <td>{{$bookingdetails[0]->checkoutDate}}</td>
                                <td>{{$bookingdetails[0]->NumberOfGuests}}</td>
                                <td><a id="numdays"></a></td>      
                            </tr>
                        


                        </tbody>

                    </table>
                   
               <medium class="text-danger">Room Information</medium>
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center">
                            <tr>
                                <th>Room Number</th>
                                <th>Room Class</th>
                                <th>Room Type</th>
                                <th>Room Rate per Night</th>
                                <th>Total Room Charge</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <tr>
                                <td>{{$bookingdetails[0]->RoomID}}</td>
                                <td>{{$bookingdetails[0]->RoomClass}}</td>
                                <td>{{$bookingdetails[0]->RoomID}}</td>
                                <td>{{$bookingdetails[0]->RoomRate}}</td>
                                <td><a id="total"></a></td> 
                            </tr>
                        </tbody>

                    </table>
                <medium class="text-danger">Additional Requests</medium>
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center">
                            <tr>
                                <th>Room Number</th>
                                <th>Room Class</th>
                                <th>Room Type</th>
                                <th>Room Rate per Night</th>
                                <th>Total Room Charge</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <tr>
                                <td>{{$bookingdetails[0]->RoomID}}</td>
                                <td>{{$bookingdetails[0]->RoomClass}}</td>
                                <td>{{$bookingdetails[0]->RoomID}}</td>
                                <td>{{$bookingdetails[0]->RoomRate}}</td>
                                <td><a id="total"></a></td> 
                            </tr>
                        </tbody>

                    </table>
    
       

        
            <div class="row">
                <div class="col-sm-5 col-md-2">
                <form method="GET"  action="yourItinerary" class="wowload fadeInRight">
                    <button class="form-control btn-success">Cancel Booking</button>
                      <br/>
                </form>
                <form method="GET"  action="bookingPDF" class="wowload fadeInRight">
                    <input type="hidden" id="refnumber" name="refnumber" value="{{$bookingdetails[0]->BookingReferenceNumber}}"/>
                     <button type="submit" class="form-control btn-danger"id="btn"> Print PDF</button>
                </form>
                    <br/>
                </div>
            </div>
    </div>
    <script src="{{url('/assets/script.js')}}"></script>
        <script type="text/javascript" src = "jquery-ui/external/jquery/jquery.js"></script>   
        <script type="text/javascript">
            $(document).ready(function(){
    
                var rate = parseInt('{{$bookingdetails[0]->RoomRate}}');
                var ratex = parseInt(rate);
        
                var chkindatex = new Date('{{$bookingdetails[0]->CheckinDate}}');
                var chkoutdatex = new Date('{{$bookingdetails[0]->checkoutDate}}');
                var diffDays = Math.abs((chkindatex.getDate() - chkoutdatex.getDate()));

                var numdays = parseInt(diffDays);
                $('#numdays').text(numdays);
                var total = ratex * parseInt(numdays);
                var totalindouble = parseFloat(total).toFixed(2);
                $('#total').text(totalindouble);

                
            
            });
    </script>


    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(function() {
            $('.btn').click(function() {
                var ids = [1,2,3];
                var myArray= encodeURIComponent(JSON.stringify(ids));
                console.log(myArray);
                $.ajax("/bookingPDF", {
                    type: 'POST',
                    data: {myArray:myArray}
                });
            });
        });
    </script>

        @endsection