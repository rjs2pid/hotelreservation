<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\BookingModel;
use App\CheckedoutModel;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends Controller

{
   
    public function itineraryReport(Request $request)
    {
        
        $refnum =  $request->input('refnumber');
        //$ids = $request->json()->('ids');
        //$ids = $request->get('myArray');

        //$bookingdetails = DB::select("SELECT checkedout.*,rooms.* FROM checkedout INNER JOIN rooms on rooms.RoomID = checkedout.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        $bookingdetails = DB::select("SELECT checkedout.*,rooms.*,DATEDIFF(checkedout.CheckoutDate,checkedout.CheckinDate) as numnights FROM checkedout INNER JOIN rooms on rooms.RoomID = checkedout.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        // DB::table('reservations')->where('BookingReferenceNumber',[$refnum])->toSql();//DB::select("SELECT * FROM reservations WHERE BookingReferenceNumber = '".$refnum."';");
        
       
        //DB::table('reservations')->whereIn('BookingReferenceNumber',$refnum)->get();
        //dd($ids);
        //dd($bookingdetails);
        if($bookingdetails == [] ){
            //return view('templates.itinerary')->with('error','No Records Found!')->with('bookingDetails',$yourBookings); 
            $pdf=PDF::loadView('reports.receipt',['bookingdetails'=>$bookingdetails]);//->with('bookingdetails',$bookingdetails);
           
            $options = new Options();
            $options->set('isJavascriptEnabled', TRUE);
            $dompdf = new Dompdf($options);
            //$pdf->set_base_path("/resources");
            return $pdf->stream('receipt.pdf');
           
        }
        else
        {
            
            //return view('templates.itinerary')->with('success','Records Found!')->with('bookingDetails',$yourBookings);
            $pdf=PDF::loadView('reports.receipt',['bookingdetails'=>$bookingdetails]);
            $options = new Options();
            $options->set('isJavascriptEnabled', TRUE);
            $dompdf = new Dompdf($options);
        
                        //$pdf->set_base_path("/resources");    
            return $pdf->stream('receipt.pdf');
        }
    }

    public function checkout(Request $request)
    {

        $refnum = $request->input('refnumber');
      
        //$refnum = $request->get('refnum');


        $bookingdetails = DB::select("SELECT reservations.*,rooms.*,DATEDIFF(reservations.CheckoutDate,reservations.CheckinDate) as numnights FROM reservations INNER JOIN rooms on rooms.RoomID = reservations.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        
        //json_encode($bookingdetails);
        
        $this->toCheckedout($bookingdetails);
        
        

        DB::statement("DELETE FROM reservations where reservations.BookingReferenceNumber = '".$refnum."' ");

        $pdf=PDF::loadView('reports.receipt',['bookingdetails'=>$bookingdetails]);
        $options = new Options();
        $options->set('isJavascriptEnabled', TRUE);
        $dompdf = new Dompdf($options);
        //$pdf->set_base_path("/resources");
        return $pdf->stream('receipt.pdf');

       

       
        

    }

    public function toCheckedout($details)
    {


        $status = "Checked-Out";
        $store = new CheckedoutModel();
        $store->checkedoutID = $details[0]->ReservationID ;
        $store->BookingReferenceNumber= $details[0]->BookingReferenceNumber ;
        $store->Name         =       $details[0]->Name;
        $store->Address      =       $details[0]->Address;
        $store->Email        =       $details[0]->Email;
        $store->Phone        =       $details[0]->Phone;
        $store->NumberOfAdultGuests  = $details[0]->NumberOfAdultGuests;
        $store->NumberOfChildGuests  = $details[0]->NumberOfChildGuests;
        $store->RoomID       =       $details[0]->RoomID;
        $store->checkindate  =       $details[0]->CheckinDate;
        $store->checkoutdate =       $details[0]->checkoutDate;
        $store->RoomCharge   =       $details[0]->RoomCharge;
        $store->Extrabed     =       $details[0]->Extrabed;
        $store->Extrabed_Price    =  $details[0]->Extrabed_Price;
        $store->Total_Charges     =  $details[0]->Total_Charges;
        $store->Promo_Code   =       $details[0]->Promo_Code;
        $store->Partial_Payment   =  $details[0]->Partial_Payment;
        $store->ArrivalTime     =       $details[0]->ArrivalTime;
        $store->Status       =       $status;
        $store->PaymentStatus   =       $details[0]->PaymentStatus;
        $store->reservation_type=      $details[0]->reservation_type;
        $store->PaymentMode =       $details[0]->PaymentMode;
        $store->save();
        

    }

    public function loader()
    {

    return view('templates.loader');

    }



    public function itineraryReportxx(Request $request)
    {
        

        $refnum = $_GET['refnum'];
        //$refnum =  $request->input('refnumber');
        //$ids = $request->json()->('ids');
        //$ids = $request->get('myArray');

        //$bookingdetails = DB::select("SELECT checkedout.*,rooms.* FROM checkedout INNER JOIN rooms on rooms.RoomID = checkedout.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        $bookingdetails = DB::select("SELECT checkedout.*,rooms.*,DATEDIFF(checkedout.CheckoutDate,checkedout.CheckinDate) as numnights FROM checkedout INNER JOIN rooms on rooms.RoomID = checkedout.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        // DB::table('reservations')->where('BookingReferenceNumber',[$refnum])->toSql();//DB::select("SELECT * FROM reservations WHERE BookingReferenceNumber = '".$refnum."';");
        
       //return json_encode($bookingdetails);
        //DB::table('reservations')->whereIn('BookingReferenceNumber',$refnum)->get();
        //dd($ids);
        //dd($bookingdetails);
        if($bookingdetails == [] ){
            //return view('templates.itinerary')->with('error','No Records Found!')->with('bookingDetails',$yourBookings); 
            $pdf=PDF::loadView('reports.receipt',['bookingdetails'=>$bookingdetails]);//->with('bookingdetails',$bookingdetails);
           
            $options = new Options();
            $options->set('isJavascriptEnabled', TRUE);
            $dompdf = new Dompdf($options);
            //$pdf->set_base_path("/resources");
            return $pdf->stream('receipt.pdf');
           
        }
        else
        {
            
            //return view('templates.itinerary')->with('success','Records Found!')->with('bookingDetails',$yourBookings);
            $pdf=PDF::loadView('reports.receipt',['bookingdetails'=>$bookingdetails]);
            $options = new Options();
            $options->set('isJavascriptEnabled', TRUE);
            $dompdf = new Dompdf($options);
        
                        //$pdf->set_base_path("/resources");    
            return $pdf->stream('receipt.pdf');
        }


    }

}