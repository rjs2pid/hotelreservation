@extends('layouts.layout')



@section('content')

<div class="container">
<div class="col-sm-12 col-xs-12">
    <h2>Reservation List</h2>
    <button class="btn btn-success"> Add New </button>
    <table class="table table-bordered table-responsive" style ="margin-top:20px">
        <thead>
            <tr>
                <td>ID</td>
                <td>Customer Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
            <tbody id = "reservationlist">
                @foreach($bookings as $bookings)
                <tr> 
                <td>{{$bookings->ReservationID}}</td>
                    <td>{{$bookings->Name}}</td>
                    <td>{{$bookings->Email}}</td>
                    <td>{{$bookings->Phone}}</td>
                    <td>
                    <a href = "/bookingdetails/{{$bookings->ReservationID}}" class = "btn form-control btn-info">VIEW</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
  
    </div>
</div>
  @endsection
  <script>
   /*   $(function(){
  
        showReservationList();
        function showReservationList(){
            $.ajax({
              type: 'GET',
              async: 'false',
              dataType: 'json',
              success: function(data){
                  var html= '';
                  var i;
  
                  for (i=0; i<data.length; i++){
                    html += '<tr>' +
                              '<td>'+data[i].ReservationID+'</td>'+
                              '<td>'+data[i].CustomerName+'</td>'+
                              '<td>'+data[i].Email+'</td>'+
                              '<td>'+data[i].PhoneNumber+'</td>'+
                              '<td>'+
                                '<a href = "javascript:;" class = " btn btn-info">Edit</a>'+
                                '       <a href = "javascript:;" class = "btn btn-danger">Cancel</a>'+
                              '</td>'+
                            '</tr>';
                  }
                    $('#reservationlist').html(html);
              },
              error: function(){
  
                alert('Could not fetch records!');
              }
  
  
  
            });
  
        }
  
  
  
  
      }); */
  </script>