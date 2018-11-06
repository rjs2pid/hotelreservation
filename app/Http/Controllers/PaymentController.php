<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PaymentModel;
use App\BookingModel;




class PaymentController extends Controller
{
    public $seqNumtoSave;
   

   

    public function storeTrans(Request $request)
    { 
       
        $transDetails = $request->get('transaction');

        

        $KEY = 'HTLSCC-INVC-';
        $invoiceid = DB::select("select max(TransactionID) as xx from transaction"); 
        $nextInvoice = $invoiceid[0]->xx + 1;
        $invoicenumber = $KEY.$nextInvoice;

        $refnumber = $transDetails['bookingrefnum'];
        $totoldues = $transDetails['totaldues'];
        $cash      = $transDetails['cash'];
        $paymode   = $transDetails['paymode'];
        $cardnumber= $transDetails['cardnumber'];
        $cardcode  = $transDetails['cardcode'];
      // $payment_mode=5;


        $transdate = date('Y-m-d');
        //$seqnum = DB::select("select max(SequenceNumber) as seqnumx from transaction where BookingRefNumber = '".$refnumber."'"); 
        //$nextSeqNum = $seqnum[0]->seqnumx + 1;
        //if($nextSeqNum == Null){
            $seqNumtoSave = 1;

        //}
        //$invoicenumber = $nextSeqNum;

        $store = new PaymentModel();
        $store->InvoiceNumber       =   $invoicenumber;
        //$store->SequenceNumber       =   $seqNumtoSave;
        $store->BookingRefNumber    =   $refnumber;
        $store->TotalDues           =   $totoldues;
        $store->AmountPaid                =   $cash;
        $store->Transaction_Date     =   $transdate;
        $store->PaymentMode         =   $paymode;
        $store->Card_Number          =   $cardnumber;
        $store->Card_Code            =   $cardcode;
        $store->save();



       // return $report->itineraryReportxx();
    //return response()->json( [ 'msg' => 'Post done successfully' ] );
        return json_encode($invoicenumber);

        
       
       
    }
}
