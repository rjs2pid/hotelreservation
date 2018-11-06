<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PaymentModel;



class transactionContoller extends Controller
{
    public function storeTrans(Request $request)
    { 
       
        $transDetails = $request->get('transaction');

        //dd($transdetails);
        $KEY = 'HTLSCC-INVC-';
        $invoiceid = DB::select("select max(TransactionID) as xx from transaction"); 
        if($invoice = Null){

                $invoice = 1;
        }
        $nextInvoice = $invoiceid[0]->xx + 1;
        $invoicenumber = $KEY.$nextInvoice;

        $refnumber = $transDetails['bookingrefnum'];
        $totoldues = $transDetails['totaldues'];
        $cash      = $transDetails['cash'];
        $paymode   = $transDetails['paymode'];
        //$cardnumber= $transDetails['cardnumber'];
        //$cardcode  = $transDetails['cardcode'];
        $transdate = date('Y-m-d');
        $seqnum = DB::select("select max(SequenceNumber) as seqnumx from transaction where BookingRefNumber = '".$refnumber."'"); 
        if($seqnum = Null){

            $seqnum = 1;
        }
        $nextSeqNum = $seqnum[0]->seqnumx + 1;
        //$invoicenumber = $nextSeqNum;

        if($cardnumber ==""){

            $cardnumber = Null;
            $cardcode = Null;
        }

        $store = new PaymentModel();
        $store->InvoiceNumber       =   $invoicenumber;
        $stor->SequenceNumber       =   $nextSeqNum;
        $store->BookingRefNumber    =   $refnumber;
        $store->TotalDues           =   $totoldues;
        $store->Cash                =   $cash;
        $store->TransactionDate     =   $transdate;
        $store->PaymentMode         =   $paymode;
        //$store->CardNumber          =   $cardnumber;
        //$store->CardCode            =   $cardcode;
        $store->save();

        return json_encode($transDetails);
       
       
    }
}
