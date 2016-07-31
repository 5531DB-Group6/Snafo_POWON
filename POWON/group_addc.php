<?php
/**
 * Add posts
 */

	include './common/common.php';

	//判断用户是否登录
	if(!$_COOKIE['uid'])
    {
        $notice = 'Sorry，you are currently not logged in.';
        include 'close.php';
        exit;
    }

	//判断ID是否存在
    if(empty($_REQUEST['gid']) || !is_numeric($_REQUEST['gid']))
    {
        $msg = '<font color=red><b>Illegal operation is not allowed</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }else{
        $groupId = $_REQUEST['gid'];
    }

/*
	//读取导航索引
	$category = dbSelect('category','cid,classname,parentid','parentid<>0 and cid='.$classId.'','',1);
	if($category){

        $smallName = $category[0]['classname'];
        $smallId = $category[0]['cid'];
        $parentCategory = dbSelect('category','cid,classname','cid='.$category[0]['parentid'].'','',1);
        if($parentCategory)
        {
            $bigName=$parentCategory[0]['classname'];
            $bigId=$parentCategory[0]['cid'];
        }else{
            $msg = '<font color=red><b>非法操作</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }

    }else{
        $msg = '<font color=red><b>非法操作</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
        exit;
    }
*/

	//发布帖子
	if($_POST['topicsubmit'])
    {
        $authorid = $_COOKIE['uid'];		//发布人ID
        $title = strMagic($_POST['subject']);		//标题
        $content = strMagic($_POST['content']);		//内容
        $addtime = time();			//发表时间
        $groupId = $_POST['gid'];		//类别ID
        //$rate = $_POST['price'];			//帖子售价

        $n = 'first, authorid, title, content, addtime, gid';
        $v = '1, '.$authorid.', "'.$title.'", "'.$content.'", '.$addtime.', '.$groupId.'';
        $result = dbInsert('gposts', $n, $v);

        $insert_id = dbSelect('gposts','pid','title="'.$title.'"','pid desc',1);
        $insertId = $insert_id[0]['pid'];
        if(!$result){

            $msg = '<font color=red><b>Posting is failed, please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;

        }else{

            //$money = REWARD_T;	//发帖赠送积分
            //$result = dbUpdate('user', "grade=grade+{$money}", 'uid='.$_COOKIE['uid'].'');


            //更新版块表的主题数量[Motifcount](跟帖是回复数量[eplycount])和最后发表[lastpost]
            $last = $insertId.'+||+'.$title.'+||+'.$addtime.'+||+'.$_COOKIE['username'];
            $result = dbUpdate('groups', 'motifcount=motifcount+1, lastpost="'.$last.'"', 'gid='.$groupId.'');

            $msg = '<font color=red><b>Posting succeeded</b></font>';
            $url = 'group_post_detail.php?pid='.$insertId;
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
            /*
            $msg = '发帖赠送';
            include 'layer.php';
            */
            exit;
        }

    }

    $OnMenu = dbSelect('groups','gid,name,owner','gid='.$groupId.' and ispass=1','gid desc');
    if(!$OnMenu)
    {
        $msg = '<font color=red><b>cannot find the group</b></font>';
        $url = $_SERVER['HTTP_REFERER'];
        $style = 'alert_error';
        $toTime = 3000;
        include 'notice.php';
    }else{
        $OnGid = $OnMenu[0]['gid'];
        $OnGname = $OnMenu[0]['name'];
        $Owner = $OnMenu[0]['owner'];
    }

	$title = 'Add Posts'.$OnCname.' - '.WEB_NAME;
	$menu = WEB_NAME;
	include template("group_addc.html");

