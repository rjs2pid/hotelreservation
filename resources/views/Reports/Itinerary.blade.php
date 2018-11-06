<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <title>Itinerary</title>
      
    </head>
    <body>
       


    <div class="container">
        <h3 class="text-center"> Your Reservation Itinerary</h3>
        <div class="panel panel-default search-result"> 
            <div class="panel-heading">
                             @foreach($bookingdetails as $key => $bookingDetails)
                                @if (isset($bookingDetails->isEmpty) )  
                                    <h4 class='text-danger'>NO RECORDS FOUND</h4>
                                @endif
                <a class="form-control text-right">
                    REFERENCE NUMBER: {{$bookingDetails->BookingReferenceNumber}}
                </a>
                    <table class="table table-bordered table-responsive text-center" style="margin-top:20px">
                        <thead class="text-center">
                            <tr>
                                <th>Name</th>
                                <th>Check-in Date</th>
                                <th>Check-Out Date</th>
                                <th>Num. of Guests</th>
                                <th>Num. of Nights</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <tr>
                                <td>{{$bookingDetails->Name}}</td>
                                <td>{{$bookingDetails->CheckinDate}}</td>
                                <td>{{$bookingDetails->checkoutDate}}</td>
                                <td>{{$bookingDetails->NumberOfGuests}}</td>
                                <td><a id="numdays"></a></td>      
                            </tr>
                        @endforeach 


                        </tbody>

                    </table>


            </div>
        </div>
    </div>

    



    
  
   
    
  </body>
</html>

      

        




