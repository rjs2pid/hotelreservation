<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\BookingModel;
use App\RequestModel;
use App\NoShowModel;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

class BookingController extends Controller
{

    public $rmdetails;
    public $refx;
    public $bookingDetails;
    
    public function __construct()
    {
    
        $this->rmdetails = new RoomController();
    }

    public function index()
    {
        $bookings = DB::select("SELECT * FROM `reservations` where  reservations.status <> 'No Show' and reservations.status <> 'Cancelled' and reservations.status <> 'Checked-In' or reservations.Status is Null");

        return view('admin.tables')->with('bookings',$bookings);

    }
    public function todaysguest()
    {
    
        $bookings = DB::select("SELECT * FROM reservations where reservations.status = 'checked-in';");

        return view('admin.tables')->with('bookings',$bookings);

    }
    public function show($id)
    { 
       
        $addons = DB::select("SELECT * from add_item;");
        
        $resto = DB::select("SELECT * FROM resto;");
        
        $req = DB::select("SELECT * FROM requests");
        
        $reservationDetails = DB::select("SELECT 
                                                reservations.*,
                                                rooms.* ,
                                                reservationtype.*,
                                                paymentstatus.*,
                                                roomstatus.RoomStatus_desc as RoomStatusCode,
                                                paymode.*
                                            FROM reservations 
                                            LEFT JOIN rooms ON reservations.RoomID = rooms.RoomID 
                                            LEFT JOIN reservationtype ON reservations.reservation_type = reservationtype.reservationtype_ID
                                            LEFT JOIN paymentstatus ON reservations.PaymentStatus = paymentstatus.PaymentStatus_ID 
                                            LEFT JOIN roomstatus ON rooms.RoomStatus = roomstatus.RoomStatus_Code
                                            LEFT JOIN paymode ON reservations.PaymentMode = paymode.Paymode_ID
                                            WHERE 
                                                ReservationID = ".$id." ");

        $refnumber = $reservationDetails[0]->BookingReferenceNumber;
        
        $requests = DB::select("SELECT * FROM guests_requests where BookingRefNum='".$refnumber."' ");

        return view('admin.reservationdeltails')->with('reservationDetails',$reservationDetails)->with('items',$addons)->with('resto',$resto)->with('requests',$req)->with('guestrequests',$requests);

    }
    public function getRequests(Request $request){

        $refnumber =$request->get('refnum');

        $requests = DB::select("SELECT * FROM guests_requests where BookingRefNum='".$refnumber."' ");  

        return json_encode($requests);

    }

    public function formreview(Request $request,RoomController $rooms)
    {
       
        $ReferenceNumber=   $request->input('referencenumber');
        $Name           =   $request->input('customerName');
        $Email          =   $request->input('email');
        $Phone          =   $request->input('phone');
        $RoomID         =   $request->input('roomid');
        $checkindate    =   $request->input('checkindate');
        $checkoutdate   =   $request->input('checkoutdate');
        $message        =   $request->input('message');

    $roomdetails = array();
       $roomdetails    =   $this->rmdetails->roomdetails($RoomID);
       
         $reservationdetails = array();
         $reservationdetails = [
            'referencenumber'   =>  $ReferenceNumber,
            'name'              =>  $Name,
            'email'             =>  $Email,
            'phone'             =>  $Phone,
            'roomid'            =>  $RoomID,
            'checkindate'       =>  $checkindate,
            'checkoutdate'      =>  $checkoutdate,
            'message'           =>  $message
         ];
        return view('templates.verifyreservation')->with('reservationdetails', $reservationdetails)->with('roomdetails',$roomdetails);
    }

    public function store(Request $request)
    {
        $REFKEY ='RHR-';
       
        $this->validate($request,[
            'checkindate' => 'required',
            'checkoutdate' => 'required',
            'customerName' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        $lastID = 0;
        $incre = 1;
        $lastID = DB::select("select max(ReservationID) as xx from reservations"); 
        $nextID = 0;
        $chkdate = $request->input('checkindate');
        $DateKey =  str_replace('-', '',$chkdate);
        //$nextID = $lastID + $incre;
        $nextID = $lastID[0]->xx + 1;
        //referencenumber format = YYMMDD1RHR-O
        //echo json_encode($DateKey.$REFKEY.$nextID);
        $REFKEY = $DateKey.$REFKEY.$nextID;

        $store = new BookingModel();
        $store->BookingReferenceNumber= $REFKEY ;
        $store->Name         =       $request->input('customerName');
        $store->Email        =       $request->input('email');
        $store->Phone        =       $request->input('phone');
        $store->RoomID       =       $request->input('roomid');
        $store->RoomCharge   =       $request->input('roomrate');
        $store->checkindate  =       $request->input('checkindate');
        $store->checkoutdate =       $request->input('checkoutdate');
        $store->save();
        return view('reports.itinerary')->with('success','Reservation Saved!')->with('REFKEY',$REFKEY); 
        
    }

    public function itinerary(Request $request)
    {
        $refnum =  $request->input('refnumber');
        $this->refx = $refnum;
        $yourBookings = DB::select("SELECT * FROM reservations WHERE BookingReferenceNumber = '".$refnum."'; ");
        

        if($yourBookings == [] ){
            return view('templates.itinerary')->with('error','No Records Found!')->with('bookingDetails',$yourBookings); 
           
        }
        else
        {
            
            return view('templates.itinerary')->with('success','Records Found!')->with('bookingDetails',$yourBookings);
           
        }

        
    }
    public function viewBookings(Request $request)
    {
        $refnum =  $request->input('refnumber');
      
        $bookingdetails = DB::select("SELECT reservations.*,rooms.* FROM reservations INNER JOIN rooms on rooms.RoomID = reservations.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        //dd($bookingdetails);
        return view('templates.viewBooking')->with('bookingdetails',$bookingdetails);


    }

    public function noShow(Request $request)
    {


        $refnum =  $request->input('refnumber');

      // $refnum = $request->get('refnum');
        $updateBooking = DB::statement("UPDATE reservations set reservations.Status = 'No Show' where BookingReferenceNumber = '".$refnum."' ");
        
       $details = DB::select("SELECT * FROM reservations where BookingReferenceNumber = '".$refnum."'");
       $this->toNoShow($details);
       
       DB::statement("DELETE FROM reservations where reservations.BookingReferenceNumber = '".$refnum."'");
       return redirect('/bookings');
      // return response()->json( [ 'msg' => 'Updated Successfully!' ] );
      // $detailsx = DB::select("SELECT * FROM noshow where BookingReferenceNumber = '".$refnum."'");
     // 
        //return view('admin.tables');
     // return view('admin.reservationdeltails')->with('reservationDetails',$detailsx);
    }

    public function toNoShow($details)
    {

        $status = "No-Show";
        $store = new NoShowModel();
        $store->noshowID = $details[0]->ReservationID ;
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


    public function checkin(Request $request)
    {

        $refnum = $request->input('refnumber');
      
        $req = DB::select("SELECT * FROM requests");
        $updateBooking = DB::statement("UPDATE reservations set reservations.Status = 'Checked-in' where BookingReferenceNumber = '".$refnum."' ");

        $bookingdetails = DB::Select("SELECT 
                                            reservations.*,
                                            rooms.* ,
                                            reservationtype.*,
                                            paymentstatus.*,
                                            roomstatus.RoomStatus_desc as RoomStatusCode,
                                            paymode.*
                                        FROM reservations 
                                        LEFT JOIN rooms ON reservations.RoomID = rooms.RoomID LEFT JOIN reservationtype ON reservations.reservation_type = reservationtype.reservationtype_ID
                                        LEFT JOIN paymentstatus ON reservations.PaymentStatus = paymentstatus.PaymentStatus_ID 
                                        RIGHT JOIN roomstatus ON rooms.RoomStatus = roomstatus.RoomStatus_Code
                                        LEFT JOIN paymode ON reservations.PaymentMode = paymode.Paymode_ID
                                        WHERE 
                                        BookingReferenceNumber = '".$refnum."'; ");
        
        // DB::select("  SELECT reservations.*,rooms.*,DATEDIFF(reservations.checkoutDate,reservations.CheckinDate) as numnights,reservationtype.*,roomstatus.RoomStatus_desc as RoomStatusCode
        //                                 FROM reservations 
        //                                 INNER JOIN rooms on rooms.RoomID = reservations.RoomID 
        //                                 LEFT JOIN reservationtype on reservationtype.reservationtype_id = reservations.reservation_type
        //                                 RIGHT JOIN roomstatus ON rooms.RoomStatus = roomstatus.RoomStatus_ID
        //                                 WHERE BookingReferenceNumber = '".$refnum."';");

        $requests = DB::select("SELECT * FROM guests_requests where BookingRefNum='".$refnum."' ");  
        return view('admin.reservationdeltails')->with('reservationDetails',$bookingdetails)->with('guestrequests',$request)->with('requests',$req);
    }


    public function checkout(Request $request)
    {

        $refnum = $request->input('refnumber');
      

        $updateBooking = DB::statement("UPDATE reservations set reservations.Status = 'Checked-Out' where BookingReferenceNumber = '".$refnum."' ");

        $bookingdetails = DB::select("SELECT 
                                        reservations.*,
                                        rooms.* ,
                                        reservationtype.*,
                                        paymentstatus.*,
                                        roomstatus.RoomStatus_desc as RoomStatusCode
                                    FROM reservations 
                                    LEFT JOIN rooms ON reservations.RoomID = rooms.RoomID LEFT JOIN reservationtype ON reservations.reservation_type = reservationtype.reservationtype_ID
                                    LEFT JOIN paymentstatus ON reservations.PaymentStatus = paymentstatus.PaymentStatus_ID 
                                    RIGHT JOIN roomstatus ON rooms.RoomStatus = roomstatus.RoomStatus_Code
                                    WHERE 
                                    BookingReferenceNumber = '".$refnum."'; ");
            
            //"SELECT reservations.*,rooms.*,DATEDIFF(reservations.CheckoutDate,reservations.CheckinDate) as numnights FROM reservations INNER JOIN rooms on rooms.RoomID = reservations.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
        
    //dd($bookingdetails);
        return view('reports.receipt')->with('bookingdetails',$bookingdetails)->with('guestrequests',$request)->with('requests',$req);;
    }

    public function viewx(Request $request)
    {
        
       
        if($request->ajax())
        {
            
            $refnumber = $request->refnumber;

            dd($refnumber);
            $bookingdetails = DB::select("SELECT reservations.*,rooms.* FROM reservations INNER JOIN rooms on rooms.RoomID = reservations.RoomID WHERE BookingReferenceNumber = '".$refnum."';");
            
            return response($bookingdetails);
        }


    }


    public function checkedoutlists(Request $request)
    {


        
        $bookings = DB::select("SELECT * FROM checkedout;");

        return view('admin.checkedouttable')->with('bookings',$bookings);


    }
    public function showcheckedoutdetails($id)
    { 
       
        $addons = DB::select("SELECT * from add_item;");
        
        $resto = DB::select("SELECT * FROM resto;");
        
        $req = DB::select("SELECT * FROM requests");
        // $reservationDetails = DB::select("SELECT 
        //                                         checkedout.*,
        //                                         rooms.* 
        //                                     FROM checkedout 
        //                                     LEFT JOIN rooms ON checkedout.RoomID = rooms.RoomID 
        //                                     WHERE 
        //                                         BookingReferenceNumber = '".$id."' ");

        $reservationDetails =  DB::select("SELECT 
                                                checkedout.*,
                                                rooms.* ,
                                                reservationtype.*,
                                                paymentstatus.*,
                                                roomstatus.RoomStatus_desc as RoomStatusCode,
                                                paymode.*
                                            FROM checkedout 
                                            LEFT JOIN rooms ON checkedout.RoomID = rooms.RoomID LEFT JOIN reservationtype ON checkedout.reservation_type = reservationtype.reservationtype_ID
                                            LEFT JOIN paymentstatus ON checkedout.PaymentStatus = paymentstatus.PaymentStatus_ID 
                                            RIGHT JOIN roomstatus ON rooms.RoomStatus = roomstatus.RoomStatus_Code
                                            LEFT JOIN paymode ON checkedout.PaymentMode = paymode.Paymode_ID
                                            WHERE 
                                            BookingReferenceNumber = '".$id."'; ");

        $requests = DB::select("SELECT * FROM guests_requests where BookingRefNum='".$id."' ");             

        return view('admin.reservationdeltails')->with('reservationDetails',$reservationDetails)->with('guestrequests',$requests)->with('requests',$req);

    }


    public function addReservationAdminView()
    {
        $requests=DB::select("SELECT * FROM requests");
        $paymentmode=DB::select("SELECT * FROM paymode");
        $paymentstatus = DB::select("SELECT * from paymentstatus");

        $REFKEY ='RHR-';
        $lastID = 0;
        $lastID = DB::select("select max(ReservationID) as xx from reservations"); 
        $nextID = 0;
        $nextID = $lastID[0]->xx + 1;
        //dd($paymentstatus);
        return view('admin.addReservation_admin')->with('requests',$requests)->with('paymode',$paymentmode)->with('paymentstatus',$paymentstatus)->with('nextid',$nextID);

    }

    public function saveNewReservation(Request $request)
    {
        //return response()->json( [ 'msg' => 'Post done successfully' ] );

        $stat = Null;
        $reservationdata = $request->get('guestinfo');
        $requestdata  = array($request->get('requests'));
        //$transactions = array($request->get('transaction'));

        $name           =  $reservationdata['name'];
        $address        =  $reservationdata['address'];
        $contact        =  $reservationdata['contact'];
        $email          =  $reservationdata['email'];
        //$message        =  $reservationdata['message'];
        $roomid         =  $reservationdata['roomid'];
       // $numberofguests =  $reservationdata['numberofguests'];
        $numextrabed    =  $reservationdata['numextrabed'];
        $extrabed_price =  $reservationdata['extrabed_price'];
        $numofstay      =  $reservationdata['numofstay'];
        $roomcharge     =  $reservationdata['roomcharge'];
        $partialpayment =  $reservationdata['partialpayment'];
        $totalcharge    =  $reservationdata['totalcharge'];
        $checkindate    =  $reservationdata['checkindate'];
        $checkoutdate   =  $reservationdata['checkoutdate'];
        $promocode      =  $reservationdata['promocode'];
        $status         =  $reservationdata['status'];
        $reservationtype=  $reservationdata['reservationtype'];

        if($status =="Walk-in"){

            $stat = "Checked-in";

        }

       
        $REFKEY ='RHR-';
        $lastID = 0;
        $incre = 1;
        $lastID = DB::select("select max(ReservationID) as xx from reservations"); 
        $nextID = 0;
        $chkdate = $checkindate;
        $DateKey =  str_replace('-', '',$chkdate);
        //$nextID = $lastID + $incre;
        $nextID = $lastID[0]->xx + 1;
        //referencenumber format = YYMMDD1RHR-O
        //echo json_encode($DateKey.$REFKEY.$nextID);
        $REFKEY = $DateKey.$REFKEY.$nextID;
        $paymentstat = 1;
        $store = new BookingModel();
        $store->BookingReferenceNumber= $REFKEY;
        $store->Name            =      $reservationdata['name'];
        $store->Address         =      $reservationdata['address'];
        $store->Email           =      $reservationdata['email'];
        $store->Phone           =      $reservationdata['contact'];
        $store->NumberOfAdultGuests  = $reservationdata['numberguestsadult'];
        $store->NumberOfChildGuests  = $reservationdata['numberguestschild'];
        $store->RoomID          =      $reservationdata['roomid'];
        $store->CheckinDate     =      $reservationdata['checkindate'];
        $store->checkoutDate    =      $reservationdata['checkoutdate'];
        $store->RoomCharge      =      $reservationdata['roomcharge'];
        $store->Extrabed        =      $reservationdata['numextrabed'];
        $store->Extrabed_Price  =      $reservationdata['extrabed_price'];
        $store->Total_Charges   =      $reservationdata['totalcharge'];
        $store->Promo_Code      =      $reservationdata['promocode'];
        $store->Partial_Payment =      $reservationdata['partialpayment'];
        $store->ArrivalTime     =      $reservationdata['arrivaltime'];
        $store->Status          =      $stat;
        $store->PaymentStatus   =      (int)$paymentstat;
        $store->reservation_type=      (int)$reservationdata['reservationtype'];
        $store->PaymentMode     =      (int)$reservationdata['paymode'];
        $store->PaymentStatus   =      (int)$reservationdata['paymentstatus'];
        $store->save();

        
        $reqcount = sizeof($requestdata);
       if(!$requestdata[0] == Null){
                    foreach($requestdata[0] as $reqs){
                        $reqID = (int)$reqs[0];
                    
                            $saverequest = DB::insert("INSERT INTO guests_requests(BookingRefNum,Request_ID)VALUES('".$REFKEY."',".$reqID.")");

                
                        

                    }
            return json_encode($reqcount); 
            }
      
     
       return json_encode($REFKEY); 
       
       //return response()->json( [ 'msg' => 'Post done successfully' ] );



    }

    public function arrivals()
    {
        $today = date("Y-m-d");
        $arrivals = DB::select("SELECT * FROM reservations where CheckinDate='". $today."' and Status <> 'No Show' ");
    
        return view('admin.arrivals')->with('arrivals',$arrivals);

    }

    public function arrivalCount()
    {

        $today = date("Y-m-d");
        $arrivalcount = DB::select("SELECT COUNT(reservationID) as arrivalCount FROM reservations where CheckinDate='". $today."' ");
    
        return json_encode($arrivalcount);

    }
 
    public function departures()
    {
        $today = date("Y-m-d");
        $departures = DB::select("SELECT * FROM reservations where checkoutDate='". $today."' ");
    
        return view('admin.departures')->with('departures',$departures);

    }

    public function departureCount()
    {

        $today = date("Y-m-d");
        $departurecount = DB::select("SELECT COUNT(reservationID) as departureCount FROM reservations where checkoutDate='". $today."' and Status <> 'No Show' ");
    
        return json_encode($departurecount);

    }


    public function newReservations(){

        $today = date("Y-m-d");
        $newReservations=DB::select("SELECT * FROM reservations where date(created_at) = '".$today."' ");
        //return json_encode($newReservations);

        return view('admin.tables')->with('bookings',$newReservations);
    }

    public function newReservationsCount()
    {

        $today = date("Y-m-d");
        $newReservationsCount = DB::select("SELECT COUNT(reservationID) as newReservationCount FROM reservations where Date(created_at)='". $today."' ");


        return json_encode($newReservationsCount);

    }

    public function calendar()
    {
        return view('admin.calendarview');
    }



    public function roomManagement()
    
    {
        $roomGroups = DB::select("SELECT * FROM rooms GROUP BY RoomClass,RoomType");

        return json_encode($roomGroups);

    


    }


 
 

}



