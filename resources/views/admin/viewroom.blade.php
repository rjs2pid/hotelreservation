@extends('layouts.admin-layout')
@section('content')

<style>
    div.row{
            margin-bottom: 20px;
        }
    #body{

        margin: auto;
        width: 50%;
        display:inline-block;
    }

    #bodyx{
        margin: 0 auto;
        width: 50%;
        text-align:center;
    }
    input{

            text-align: center;
    }
    #btnsave{
        margin: auto;
        width: 50%;
        display:inline-block;

    }
    small.label{
        text-align: right;

    }
    img{

        width:100%;

    }

      
    </style>
<div class="content-wrapper">
<div class="container-fluid">
    <div class="card mb-3 ">
        <div class="card-header">
          <i class="fa fa-info-circle" style="font-size:25px"></i> Room Management
        </div>
        <div class="card-body">
            <div class="row">
               
                    <div class="col-sm-3">
                        <img src="{{url('images/photos/8.jpg')}}" class="img-responsive" alt="img">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{url('images/photos/7.jpg')}}" class="img-responsive" alt="img">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{url('images/photos/9.jpg')}}" class="img-responsive" alt="img">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{url('images/photos/5.jpg')}}" class="img-responsive" alt="img">
                    </div>
      
            </div>
        </div>
        <div class="card-body" name="body" id="body">
            <div class="row">
            <div class="col-xl-4 col-sm-4 mb-4">
            </div>
               <div class="col-xl-4 col-sm-4 mb-4">
               <form method="POST" role="form" class="wowload fadeInRight"  action="/updateroom">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Number:</small>
                            <input id="roomnumber" name="roomnumber" type="text" class="form-control" placeholder="RoomNumber" value="{{$roomdetails[0]->RoomID}}"/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Type:</small>
                            <input id="roomtype" name="roomtype" type="text" class="form-control" placeholder="TYPE" value="{{$roomdetails[0]->RoomType}}"/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Class:</small>
                            <input id="roomclass" name="roomclass" type="text" class="form-control" placeholder="CLASS" value="{{$roomdetails[0]->RoomClass}}"/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Rate:</small>
                            <input id="roomrate" name="roomrate" type="text" class="form-control" placeholder="RATE" value="{{$roomdetails[0]->RoomRate}}"/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Location:</small>
                            <input id="roomlocation" name="roomlocation" type="text" class="form-control" placeholder="LOCATION" value="{{$roomdetails[0]->roomlocation_desc}}"/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <small class="">Room Status:</small>
                         
                            <select id="roomstatus" name="roomstatus" class="form-control">
                                <option name="roomstatus" id="roomstatus">{{$roomdetails[0]->RoomStatus}}</option>
                                @foreach($roomstatus as $status)
                                        <option name="roomstatus" id="roomstatus">{{$status->RoomStatus_Code}}</option>
                                @endforeach
                            </select>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12">
                            <button class="btn btn-danger form-control" type="submit">SUBMIT</button>
                        </div>
                    </div>
               </div>            
            </div>
            </form>
        </div>
        <div class="col-xl-4 col-sm-4 mb-4">
        </div>  
    </div>
</div>
</div>
<script src="{{url('assets/dash/vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">

        $(document).ready(function(){

          

        });

</script>
@endsection