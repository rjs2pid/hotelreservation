<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\roomsModel;
use App\reservations;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $rooms = DB::select("SELECT *
                        FROM rooms
                        WHERE roomid NOT IN(
                            SELECT DISTINCT roomid
                            FROM reservations
                            WHERE checkindate <= '2018-04-06' AND checkoutdate >='2018-04-07' and reservations.Status <> 'Checked-in');");
     
        return view('templates.result')->with('rooms',$rooms);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($roomid,$checkindate,$checkoutdate,Request $request)
    {
        $rmid = $roomid;
        //$checkindate = $request->input('checkindate');
        //$checkoutdate = $request->input('checkoutdate');
        $roomdetails = DB::select("SELECT * FROM rooms WHERE ROOMID = ".$rmid." LIMIT 1");

        $data = array();
         $data = [
            'checkindate' =>  $checkindate,
            'checkoutdate' =>  $checkoutdate,
            //'roomclass' =>  $roomclass,
            'roomid' =>  $rmid
      ];
       return view('templates.createbooking')->with('data',$data)->with('roomdetails',$roomdetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'checkindate' => 'required',
            'checkoutdate' => 'required',
            'customerName' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        
        
        $lastID = DB::table('reservations')->orderBy('ReservationID', 'desc')->first();    
         


        $store = new roomsModel();
        $store->ReferenceNumber= 'RHRR000'.$this->lastid();
        $store->Name = $request->input('customerName');
        $store->Email = $request->input('email');
        $store->Phone = $request->input('phone');
        $store->RoomID=$request->input('roomid');
        $store->checkindate = $request->input('checkindate');
        $store->checkoutdate = $request->input('checkoutdate');
        $store->save();
        return redirect('/bookings')->with('success','Your Reservation Has Been Successfully Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  
    }


    public function getDates(Request $request){
        $dates = array();
        $start_time =  $request->input('start_time');
        $end_time = $request->input('end_time');
        $dates = [
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time')
        ];
        $rooms = DB::select("SELECT *
                    FROM rooms
                    WHERE roomid NOT IN(
                        SELECT DISTINCT roomid
                        FROM reservations
                        WHERE checkindate <= '".$end_time."' AND checkoutdate >='".$start_time."');");
        return view('templates.result')->with('rooms',$rooms)->with('checkindate', $start_time)->with('checkoutdate',$end_time);
    }

    public function showAvailRooms($start_date,$end_Date)
    {

       
        $rooms = DB::select("SELECT *
                        FROM rooms
                        WHERE roomid NOT IN(
                            SELECT DISTINCT roomid
                            FROM reservations
                            WHERE checkindate <= '".$end_Date."' AND checkoutdate >='".$start_date."');");
    
      echo json_encode($rooms);
    }
    public function lastid()
    {
        $lastID = DB::select("select max(ReservationID) from reservations");
        //$last = (int)substr($lastID->ReservationID, strrpos($lastID->ReservationID, '0'));
        return $lastID;
    }

    public function testx()
    {
        $testx = $this->lastid() + 1;
        $ad = (int)2;
        return $testx;
    }
    public function roomdetails($rmid)
    {
    
        //$rmid = $_GET['id'];
        $roomdetails = DB::select("SELECT * FROM rooms WHERE ROOMID = ".$rmid." LIMIT 1");

        //return response()->json(array('roomdetails'=> $roomdetails), 200);
       // return json_encode($roomdetails);
        return ($roomdetails);
    }
    public function roomdetailsAdmin()
    {
    
        $rmid = $_GET['id'];
        $roomdetails = DB::select("SELECT * FROM rooms WHERE ROOMID = ".$rmid." LIMIT 1");

        //return response()->json(array('roomdetails'=> $roomdetails), 200);
       return json_encode($roomdetails);
       // return ($roomdetails);
    }

    public function getResults(Request $request,$checkindate)
    {
        $dates = array();

        $start_time = $_GET['checkindate'];
        $end_time = $_GET['checkoutdate'];
        



       // $start_time =  $request->input('start_time');
        //$end_time = $request->input('end_time');
        $dates = [
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time')
        ];
        $rooms = DB::select("SELECT rooms.*,roomlocation.*
                    FROM rooms
                    LEFT JOIN roomlocation ON roomlocation_id = rooms.Room_Location
                    WHERE roomid NOT IN(
                        SELECT DISTINCT roomid
                        FROM reservations
                        WHERE (checkindate <= '".$end_time."' AND checkoutdate >='".$start_time."'))");
  

        return json_encode($rooms);
      // return json_encode($dates);

        //return view('admin.addReservation_admin')->with('rooms',$rooms)->with('checkindate', $start_time)->with('checkoutdate',$end_time);


    }
    public function addReservationAdminView()
    {
        $rooms = DB::select("SELECT *
                    FROM rooms");

        $reservationtype = DB::select("SELECT * FROM reservationtype");
        $promo =DB::select("SELECT * FROM promo where status ='Active';");
        $requests=DB::select("SELECT * FROM requests");
        $paymentmode=DB::select("SELECT * FROM paymode");
        $paymentstatus=DB::select("SELECT * FROM paymentstatus");

        $lastID = 0;
        $lastID = DB::select("select max(ReservationID) as xx from reservations"); 
        $nextID = 0;
        $nextID = $lastID[0]->xx + 1;

        return view('admin.addReservation_admin')->with('rooms',$rooms)->with('promo',$promo)->with('requests',$requests)->with('reservationtype',$reservationtype)->with('paymode',$paymentmode)->with('paymentstatus',$paymentstatus)->with('nextid',$nextID);

    }

    public function roommanagement(Request $request)
    {

        $roomid = $request->get('roomid');
        $roomstatus = DB::select("SELECT * from roomstatus");
        $viewrooms = DB::select("SELECT rooms.*,roomlocation.*,roomstatus.* FROM rooms 
                    LEFT JOIN roomlocation on rooms.Room_Location = roomlocation.Roomlocation_ID 
                    LEFT JOIN roomstatus on rooms.RoomStatus = roomstatus.roomstatus_id");

        //dd($viewrooms);
       return view('admin.roomanagement')->with('viewrooms',$viewrooms)->with('roomstatus',$roomstatus);

    }
    public function viewroom($roomid)
    {
       //$roomid = $request->get('roomid');
        
       $roomstatus = DB::select("SELECT * FROM roomstatus");
        $roomdetails = DB::select("SELECT rooms.*,roomlocation.*,roomstatus.* FROM rooms 
        LEFT JOIN roomlocation on rooms.Room_Location = roomlocation.Roomlocation_ID 
        LEFT JOIN roomstatus on rooms.RoomStatus = roomstatus.roomstatus_id
        WHERE rooms.RoomID = '".$roomid."'");

        return view('admin.viewroom')->with('roomdetails',$roomdetails)->with('roomstatus',$roomstatus);
    }   

    public function updateroom(Request $request)
    {
        //$request->input('customerName');
        $rmid = $request->input('roomnumber');
        $rmtype= $request->input('roomtype');
        $rmrate = $request->input('roomrate');
        $rmclass=$request->input('roomclass');
        $rmlocation = $request->input('roomlocation');
        $rmstatus= $request->input('roomstatus');

        DB::update("UPDATE rooms set RoomType = '".$rmtype."', RoomClass='".$rmclass."',RoomRate = '".$rmrate."',RoomStatus = '".$rmstatus."' WHERE RoomID = ".$rmid." ");
      
        return redirect('/roommanagement')->with('message','Updated Successfully!');

    }

    public function roomstatus($roomid)
    {
        $roomdetails =DB::select("SELECT * FROM rooms where RoomID = '".$roomid."' ");
        //= DB::select("SELECT rooms.*,roomlocation.* FROM rooms LEFT JOIN roomlocation on rooms.Room_Location = roomlocation.Roomlocation_ID");
        dd($roomdetails);
       // return json_encode($roomdetails);

    }
}
