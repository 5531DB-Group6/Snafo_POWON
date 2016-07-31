<?php
/**
 * Created by PhpStorm.
 * User: Chao
 * Date: 31/07/2016
 * Time: 5:05 PM
 */

if(empty($_COOKIE['uid']))
{
    $msg = '<font color=red><b>You have not logged in</b></font>';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

$uid = $_GET['uid'];

if ($uid == $_COOKIE['uid']){
    header('location:home.php');
}


$uname = $_REQUEST['uid'];
$msg = $_REQUEST['msg'];





include template("member_chatbox.html");
