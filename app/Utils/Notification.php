<?php

namespace App\Utils;

class Notification
{
    public static function sendNotification($data = [],$to=''){
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAA8FQEc-M:APA91bGVRF42feYMjFcK3qf8W6h6p-dR-Pizs4pJsTTkpjOuDrJWdKQOadD-UAQjRp5PEI1CyU8nGcpurHBxAYSIxW_q3hRVs_XMR5TLzRSWnPdAY4KyEjS4dsJg3mbioqWXqErA4XLY';

        $arrayToSend = array('to' => $to, 'data' => $data, 'priority' => 'high');


        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            //die('FCM Send Error: ' . curl_error($ch));
            return false;
        }

        curl_close($ch);
        return true;
    }
}
