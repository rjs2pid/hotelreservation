@extends('layouts.layout')



@section('content')




<!-- banner -->
<div class="banner">    	   
    <img src="images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">SCC Hotel & Resort</h1>
                <p class="animated fadeInUp">Stay in Luxury for a Very Affordable Price in Minglanilla Cebu.</p>                
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
        <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-7">
                <h3><strong>Check for Available Rooms</strong></h3>
                <div class="panel panel-default search-result">
                    <div class="panel-body">
                        <form method="GET"  action="results" class="wowload fadeInRight">
                            <div class="col-sm-4">
                                <strong>Checkin Date</strong>
                                <div class="input-group">
                                    <input required id="start_time" type="text" class="datepicker form-control" name="start_time"/>
                                    <span class="input-group-addon"><img src="images/calendar.png"/></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <strong>Checkout Date</strong>
                                <div class="input-group">
                                    <input required id="end_time" type="text" class="date-picker form-control" name="end_time"/>
                                    <span class="input-group-addon"><img src="images/calendar.png"/></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <br/>
                                <button type="submit" class="btn form-control btn-success">View Rooms</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-md-5">
                <h3><strong>View Your Reservation</strong></h3>
                <div class="panel panel-default search-result">
                    <div class="panel-body">
                        <form method="GET"  action="yourItinerary" class="wowload fadeInRight">
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <strong>Reference Number</strong>
                                    <input required id="refnumber" type="text" class="form-control" name="refnumber" placeholder="Reference Number"/>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <br/>
                                <button type="submit" class="btn form-control btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>



<!-- services -->
<div class="spacer services wowload fadeInUp">
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="images/photos/8.jpg" class="img-responsive" alt="slide"></div>                
                <div class="item  height-full"><img src="images/photos/9.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/10.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Rooms<a href="rooms-tariff.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>


        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="TourCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="images/photos/6.jpg" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/3.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/4.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#TourCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#TourCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Tour Packages<a href="gallery.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>


        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="images/photos/1.jpg" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/2.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/5.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Food and Drinks<a href="gallery.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>
    </div>
</div>
</div>
<!-- services 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
  Launch demo modal
</button>

 Modal 
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
@endsection

    <!--<script rel="stylesheet" type="text/css" href = "jquery-ui/jquery-ui.min.css"> </script>
    <script type="text/javascript" src = "jquery-ui/external/jquery/jquery.js"></script>
    <script type="text/javascript" src = "jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" src = "jquery-ui/jquery.datetimepicker.css">
    <script type="text/javascript">  
    

 
       $('.start_time').datepicker({
        dateFormat:"yy-mm-dd",
        });  
       $('.end_time').datepicker({
        dateFormat:"yy-mm-dd",
       });  
    
       
    </script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#start_time" ).datepicker({
                dateFormat:"yy-mm-dd",
            });
            $( "#end_time" ).datepicker({
                dateFormat:"yy-mm-dd",
            });
        } );
    </script>



