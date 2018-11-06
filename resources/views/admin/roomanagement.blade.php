@extends('layouts.admin-layout')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
    <div class="card mb-3 ">
        <div class="card-header">
          <i class="fa fa-info-circle" style="font-size:25px"></i> Room Management
        </div>
        <div class="card-body">
            <div class="row">
            <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Room Number</td>
                                <td>Room Type</td>
                                <td>Room Class</td>
                                <td>Room Rate</td>
                                <td>Room Location</td>
                                <td>Room Status</td>
                                <td>View</td>
                               </tr>
                        </thead>
                        <tbody id = "roomResult">
                                        @foreach($viewrooms as $row)
                                            <tr id="bookings"> 
                                                <td>{{$row->RoomID}}</td>
                                                <td>{{$row->RoomType}}</td>
                                                <td>{{$row->RoomClass}}</td>
                                                <td>{{$row->RoomRate}}</td>
                                                <td>{{$row->roomlocation_desc}}</td>
                                                <td>{{$row->RoomStatus}}</td>
                                                <td>
                                                    <a href = "/viewroom/{{$row->RoomID}}" class = "btn form-control"><img src="images/view.png"/></a>
                                                </td>
                                                </tr>
                                        @endforeach
                        </tbody>
                    </table>
                </div>
                                
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{url('assets/dash/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript">


        function setStatus(statx){
            //var statx = '{{$viewrooms[0]->RoomStatus}}';
            document.getElementById("roomstatus").selectedIndex = "{{$row->RoomStatus_Code}}";

        }
            $(document).ready(function(){

            
                
              

            });

        </script>

@endsection