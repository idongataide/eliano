<?php
namespace App\Helpers;

use App\Models\company;

class Infobip
{

//Constructor..
    public function __construct($from, $message, $mobile)
    {

        $mobile_num = $mobile;
        if (is_numeric($mobile_num) == TRUE) {
            $mobile_num = str_replace(' ', '', $mobile_num);
        }
        //REMOVE LEADING ZEROS
        $message = "$message ";
        $basic = company::first();

        $username = $basic->infobip_username;
        $password = $basic->infobip_password;
        $message = urlencode($message);

        $url="http://api.infobip.com/api/v3/sendsms/plain?user=$username&password=$password&sender=$from&SMSText=$message&GSM=$mobile_num&type=longSMS";
        //$url="http://api.infobip.com/api/v3/sendsms/plain?user=$username&password=&sender=$from&SMSText=$message&GSM=$mobile_num&type=longSMS";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
    }
}

?>