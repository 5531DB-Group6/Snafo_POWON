<?php
/**
 * 个人资料
 */

	include './common/common.php';

	//判断用户是否登录
	if(empty($_COOKIE['uid']))
	{
		$msg = '<font color=red><b>You have not logged in</b></font>';
		$url = $_SERVER['HTTP_REFERER'];
		$style = 'alert_error';
		$toTime = 3000;
		include 'notice.php';
		exit;
	}

	//修改个人资料
	if($_POST['profilesubmitbtn'])
	{

		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $sex = $_POST['sex'];
		$birth = $_POST['birthyear'].'-'.$_POST['birthmonth'].'-'.$_POST['birthday'];
		$place = $_POST['place'];
        echo $firstname;
        echo $lastname;
        echo $sex;
        echo $birth;
        echo $place;

		$owner = dbUpdate('user', 'firstname="'.$firstname.'",lastname="'.$lastname.'",sex='.$sex.',birthday="'.$birth.'",region="'.$place.'"', 'uid='.$_COOKIE['uid'].'');
        //$owner = dbUpdate('user', 'firstname="'.$firstname.'",lastname="'.$lastname.'",sex='.$sex.',region="'.$place.'"', 'uid='.$_COOKIE['uid'].'');
		if($owner)
		{
			header('location:home.php');
		}else{
			$msg = '<font color=red><b>Error，please contact the administrator</b></font>';
			$url = $_SERVER['HTTP_REFERER'];
			$style = 'alert_error';
			$toTime = 3000;
			include 'notice.php';
			exit;
		}
	}

	//读取个人资料
	$result = dbSelect('user','*', 'uid='.$_COOKIE['uid'].' and allowlogin=0','',1);
	if(!$result)
	{
		$msg = '<font color=red><b>The user does not exist or is banded by the administrator</b></font>';
		$url = $_SERVER['HTTP_REFERER'];
		$style = 'alert_error';
		$toTime = 3000;
		include 'notice.php';
		exit;
	}
	$Jg = $result[0]['region'];
	if(!empty($result[0]['birthday']))
	{
		$bArr = explode('-', $result[0]['birthday']);
		$yBirthday = $bArr[0];
		$mBirthday = $bArr[1];
		$dBirthday = $bArr[2];
	}else{
		$yBirthday = '';
		$mBirthday = '';
		$dBirthday = '';
	}

	$yArr = [];
	$yn = date('Y');
	for($i=0; $i<100; $i++)
	{
		$yArr[] = $yn - $i;
	}

	$mArr= [];
	$mn = 1;
	for($i=0; $i<12; $i++)
	{
		$mArr[] = $mn + $i;
	}

	$dArr = [];
	$dn = 1;
	for($i=0; $i<30; $i++)
	{
		$dArr[] = $dn+$i;
	}


	$title = '个人资料 - '.WEB_NAME;
	include template("home.html");

