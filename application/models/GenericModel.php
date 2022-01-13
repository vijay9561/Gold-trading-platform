<?php

defined('BASEPATH') OR exit('No direct script access allowed');
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');

class GenericModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function sendEmail($to, $from, $subject, $messagebody, $successmsg = "Email Sent Successfully", $errmsg = "Some Error Occured") {
        //if Unabla to send or exceed sending limit then send with grid
        $url = 'https://api.sendgrid.com/';
        $user = 'btcmonk';
        $pass = 'btcmonk@123';
        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'to' => $to,
            'subject' => $subject,
            'html' => $messagebody,
            'text' => $messagebody,
            'from' => $from,
        );
        $request = $url . 'api/mail.send.json';
        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        curl_close($session);
        $res = json_decode($response);
        // print everything out
        if ($res->message == 'success') {
            $data = array(
                'status' => true,
                'msg' => $successmsg
            );
            return $data;
        } else {
            $data = array(
                'status' => false,
                'msg' => $errmsg
            );
            return $data;
        }
    }

}
