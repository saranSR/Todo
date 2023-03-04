<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\WorldLine\ReqMsgDTO;
class WorldlineController extends Controller
{
    //

    public function pay()
    {
            ReqMsgDTO::setMid('WL0000000027698');
            // Merchant Unique order id
            ReqMsgDTO::setOrderId(1485365);
            //Transaction amount in paisa format
            ReqMsgDTO::setTrnAmt(100);
            //Transaction remarks
            ReqMsgDTO::setTrnRemarks("This txn has to be done ");
            // Merchant transaction type (S/P/R)
            ReqMsgDTO::setMeTransReqType('S');
            // Merchant encryption key
            ReqMsgDTO::setEnckey('6375b97b954b37f956966977e5753ee6');
            // Merchant transaction currency
            ReqMsgDTO::setTrnCurrency('INR');
            // // Recurring period, if merchant transaction type is R
            // ReqMsgDTO::setRecurrPeriod($_REQUEST['recurPeriod']);
            // // Recurring day, if merchant transaction type is R
            // ReqMsgDTO::setRecurrDay($_REQUEST['recurDay']);
            // // No of recurring, if merchant transaction type is R
            // ReqMsgDTO::setNoOfRecurring($_REQUEST['numberRecurring']);
            // Merchant response URl
            ReqMsgDTO::setResponseUrl('http://localhost:8000');
            // Optional additional fields for merchant
            // ReqMsgDTO::setAddField1($_REQUEST['addField1']);
            // ReqMsgDTO::setAddField2($_REQUEST['addField2']);
            // ReqMsgDTO::setAddField3($_REQUEST['addField3']);
            // ReqMsgDTO::setAddField4($_REQUEST['addField4']);
            // ReqMsgDTO::setAddField5($_REQUEST['addField5']);
            // ReqMsgDTO::setAddField6($_REQUEST['addField6']);
            // ReqMsgDTO::setAddField7($_REQUEST['addField7']);
            // ReqMsgDTO::setAddField8($_REQUEST['addField8']);
            AWLMEAPI::generateTrnReqMsg();

             if (AWLMEAPI::getStatusDesc() == "Success"){
                $merchantRequest = AWLMEAPI::getReqMsg();
            }
            return view('pay',compact('merchantRequest'));
	
    }

    
}
