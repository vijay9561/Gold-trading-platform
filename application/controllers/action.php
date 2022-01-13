<?php 
session_start();
$action=$_GET['action'];
if($action=='Submit_data'){
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$referring_code=$_POST['referring_code'];
$postdata='username='.$username.'&email='.$email.'&password='.$password.'&referring_code='.$referring_code;
//$postdata = json_encode($post);
$ch = curl_init('https://api.bitteenpatti.com/register/');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',"cache-control: no-cache"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//print_r($response);
//echo '<br>';
$rs = json_decode($response);
$code= $rs->code;
if($code=='5002'){
 $otp=$rs->OTP; 
 $message=$rs->message;
 $_SESSION['code']=$code;
 $_SESSION['message']=$message;
 $_SESSION['OTP']=$otp;
 $_SESSION['username']=$username;
 $_SESSION['email']=$email;
header('Location:register.php'); 
}else{
$_SESSION['code']=$code;
$_SESSION['message']=$message;
header('Location:register.php');    
}
}
if($action=='verify_otp'){
$email=$_POST['email_id'];
$postdata='email='.$email;
//$postdata = json_encode($post);
$ch = curl_init('https://api.bitteenpatti.com/verifyUser/');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',"cache-control: no-cache"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//print_r($response);
//echo '<br>';
$rs = json_decode($response);
$code= $rs->code;  
$message=$rs->message;
$_SESSION['message1']=$message;
 unset($_SESSION['code']);
 unset($_SESSION['message']);
 unset($_SESSION['OTP']);
 unset($_SESSION['username']);
 unset($_SESSION['email']);
header('Location:register.php'); 
 }
?>