@extends('layouts.admin-layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
    
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Reservations</div>
        <div class="card-body">
         <div class="col-md-2"> 
            <button id="new" class="btn btn-success" type="submit" onclick="location.href='{{ url('/addReservationAdminView') }}'">Add Reservation </button>
         </div>
          <br/>
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <td>Reference #</td>
                <td>Room #</td>
                <td>Customer Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Checkin Date </td>
                <td>Checkout Date</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody id = "reservationlist">
                @foreach($bookings as $bookings)
                <tr id="bookings"> 
                    <td>{{$bookings->BookingReferenceNumber}}</td>
                    <td>{{$bookings->RoomID}}</td>
                    <td>{{$bookings->Name}}</td>
                    <td>{{$bookings->Email}}</td>
                    <td>{{$bookings->Phone}}</td>
                    <td>{{$bookings->CheckinDate}}</td>
                    <td>{{$bookings->checkoutDate}}</td>
                    <td>
                      <a href = "/bookingdetails/{{$bookings->ReservationID}}" class = "btn" style="font-size:10px"><img src="images/view.png"/>VIEW</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        
            </table>
          </div>
          
        </div>
        
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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

@endsection

<script src="{{url('/assets/script.js')}}"></script>
<script type="text/javascript" src = "jquery-ui/external/jquery/jquery.js"></script>   
<script type="text/javascript">
  



</script>