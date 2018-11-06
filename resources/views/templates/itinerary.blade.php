
@extends('layouts.layout')



@section('content')
<br/>
<div class="container">
<div class="row">
    <h3> Your Reservation Itinerary</h3>

 @foreach($bookingDetails as $key => $bookingDetails)
    @if (isset($bookingDetails->isEmpty) )  
        <h4 class='text-danger'>NO RECORDS FOUND</h4>
    @endif
    <h4>{{$bookingDetails->Name}}</h4>
@endforeach
   


    
</div>
</div>


@endsection
