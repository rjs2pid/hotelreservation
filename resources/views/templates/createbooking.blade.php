@extends('layouts.layout')



@section('content')

<br/>
<div id="information" class="spacer reserve-info ">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInUp"><iframe  class="embed-responsive-item" src="//player.vimeo.com/video/55057393?title=0" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
            </div>
            <div class="col-sm-5 col-md-4">
                <h3>Reservation Form</h3>
                
                <form method="GET" role="form" class="wowload fadeInRight"  action="/informationreview">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                
                                <input type="hidden" name="roomid" class="form-control" value="{{$roomdetails[0]->RoomID}}">
                        
                                <input type="hidden" name="checkindate" class="form-control" value="{{$data['checkindate']}}" readonly>
                            </div>
                            <div class="col-xs-6">
                                <input type="hidden" name="checkoutdate" class="form-control"  value="{{$data['checkoutdate']}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input name ="customerName" type="name" class="form-control"  placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input  name="email" type="email" class="form-control"  placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input name="phone" type="Phone" class="form-control"  placeholder="Phone" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <select name="NumberOfGuests" class="form-control">
                                        <option>No. of Guests</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>more</option>
                                </select>
                                
                                <!--<select name="RoomClass" class="form-control" >
                                <option>Room Class</option>
                                <option>Single</option>
                                <option>Couple</option>
                                <option>Family</option>
                                </select>-->
                            </div>
                            <div class="col-xs-6">
                               <!-- <select name="NumberOfGuests" class="form-control">
                                <option>No. of Guests</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>more</option>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <textarea class="form-control" rows="3" name="message" placeholder="Message"></textarea>
                          </div>
                    <button type="submit" class="btn btn-default" >Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

