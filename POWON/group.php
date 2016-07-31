<?php
/**
 * group
 */
include './common/common.php';

$title = 'Group - ' . WEB_NAME;
$menu = WEB_NAME;

$Glist = $_GET['glist'];

//判断用户是否登录
if(!$_COOKIE['uid'])
{
    $notice = 'Sorry, you have not logged in，';
    $url = $_SERVER['HTTP_REFERER'];
    $style = 'alert_error';
    $toTime = 3000;
    include 'notice.php';
    exit;
}

$GrMenuAll = dbSelect('groups','gid,name,owner,grouppic',null,'name asc');

$select='g.gid as gid, g.name as name, g.grouppic as grouppic,g.owner as owner';
$GrMenu = DBduoSelect('groups as g','gmembers as m','on g.gid = m.gid and m.approved=1',null,null,$select,'m.uid ='.$_COOKIE['uid'].'');


if(!empty( $_GET['ap'])){
    $result=dbInsert('gmembers','gid,uid',''.$groupId.','.$_COOKIE['uid'].'');
    if($resutl){
        $notice = 'apply submitted,';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_right';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }else{
        $notice = 'apply failed';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_right';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }
}


include template("group.html");