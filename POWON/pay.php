<?php
require './paypal/start.php';

use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

include './common/common.php';


//if(!isset($_GET['success'], $_GET['paymendId'], $_GET['PayerID'])){
//    die();
//}

if((bool)$_GET['success']== false){
    die();
}

$paymentId = $_GET['paymentId'];
$payerId =$_GET['PayerID'];

$payment = Payment::get($paymentId,$paypal);

$execute = new PaymentExecution();
$execute ->setPayerId($payerId);

try{
    $result = $payment->execute($execute,$paypal);
}catch (Exception $e){
    $data = jason_decode($e->getData());
    //var_dump($data);
    echo $data->message;
    die();
}

$invoice= $result->getTransactions()[0]->invoice_number;
$amount = $result->getTransactions()[0]->getAmount()->total;

$uid = $_COOKIE['uid'];

$user  = dbSelect('user','*','uid='.$_COOKIE['uid'].'');

if($user[0]['expiretime']>time()){
    $expireDate = strtotime('+1 year',$user[0]['expiretime']);
}
else{
    $expireDate = strtotime('+1 year',time());
}
dbInsert('bill','uid, invoice, paydate, amount',''.$_COOKIE['uid'].',"'.$invoice.'",'.time().','.$amount.'');
dbUpdate('user','expiretime='.$expireDate.', status=0','uid='.$_COOKIE['uid'].'');


    $msg = '<font color=green><b>Transaction succeed</b></font>';
    $url = 'home_membership.php';
    $style = 'alert_right';
    include 'notice.php';



