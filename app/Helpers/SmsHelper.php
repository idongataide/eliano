<?php

namespace App\Helpers;

use Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use File;
use Validator;
use App\Models\company;
use App\Models\AuditTrail;
use App\Models\notification;
use App\Models\user;


class SmsHelper
{
    public static function smsv1($to,$message)
    {
        $basic = company::find(1);
        //$url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=". $basic->sms_api . "&from=". $basic->sms_sender . "&to=". $to. "&body=".$message;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://www.bulksmsnigeria.com/api/v1/sms/create?");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"api_token=". $basic->sms_api . "&from=". $basic->sms_sender . "&to=". $to. "&body=".$message);

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        // Further processing ...
        GeneralHelper::audit_admin_trail("Message from sms:" . $server_output,Auth::user()->id,Auth::user()->name);

    }

    public static function smsv2($to,$message)
    {
        $basic = company::find(1);
        //$url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=". $basic->sms_api . "&from=". $basic->sms_sender . "&to=". $to. "&body=".$message;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://www.bulksmsnigeria.com/api/v1/sms/create?");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"api_token=". $basic->sms_api . "&from=". $basic->sms_sender . "&to=". $to. "&body=".$message);

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

    }
}