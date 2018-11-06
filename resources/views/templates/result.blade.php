@extends('layouts.layout')



@section('content')

<br/>

<div id="resultss" class="container">

<div class="alert alert-info">


    <h4>Available Rooms from date:<strong>{{$checkindate}}</strong> to: <strong>{{$checkoutdate}}</strong></h4>
</div>
@foreach($rooms as $row)

<form method="GET" role="form" class="wowload fadeInRight"> 
<div class="panel panel-default search-result"> 
    <div class="panel-heading">
      <h3 class="panel-title">
      <input id="roomclass" type="hidden" value="{{$row->RoomID}}" name="roomclass">
      <a id ="roomclassx" class="search-result-title" name="roomclassx">{{$row->RoomClass}}</a>
        
      </h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-4 col-xs-12">
          <a href="" class="btn-block result-details-link"><img alt="{{$row->RoomRate}} Bed" class="img-responsive img-res" src="images/thumbnails/9.jpg"></a>
        </div>
        <div class="col-sm-8 col-xs-12">
          <div class="details">

            <p class="description">
                              </p>

                              <span class="listing-price">Price for <strong>{{$row->RoomRate}}</strong> per night</span>
              <br>
              <span class="listing-price">Price: <strong>{{$row->RoomRate}}</strong></span>
              <a id="roomid" class="rmdid" type="text" value="{{$row->RoomID}}" name="roomid"></a>
            
            <span class="is_r_featured"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
        </div>
        <div class="col-xs-6">
          <div class="text-right">
          <a id="btnbook" type="submit" class="btn btn-warning" href="/roombooking/{{$row->RoomID}}/{{$checkindate}}/{{$checkoutdate}}">   Book Now        </a>
          <a href="" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
    </div>

</div>
@endforeach
</div>
</form>
<script type="text/javascript" src = "assets/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    

});



</script>
@endsection