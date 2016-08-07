<?php
/**
 * Add posts
 */

	include './common/common.php';
    include 'logincheck.php';

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


    $isadmin = isAdmin();
    $result = dbSelect('groups','owner','gid='.$groupId.'','',1);
    $owner = $_COOKIE['uid']==(int)$result[0]['owner'];

    if($isadmin||$owner){
        $admin=1;
    }else{
        $admin=0;
    }

    $voteNum = $_REQUEST['VNum'];

    $select='u.uid as uid, u.username as username,u.picture as picture,m.admin as admin';
    $MemberList = DBduoSelect('user as u','gmembers as m','on u.uid = m.uid and m.approved=1',null,null,$select,'m.gid ='.$groupId.' and u.uid!='.$_COOKIE['uid'].'');
    $MemberListRest = 3-count($MemberList)%3;
    $MemberListRest = ($MemberListRest ==3)? 0:$MemberListRest;

	//发布帖子
	if($_POST['topicsubmit'])
    {
        $authorid = $_COOKIE['uid'];		//发布人ID
        $title = strMagic($_POST['subject']);		//标题
        $content = strMagic($_POST['content']);		//内容
        $addtime = time();			//发表时间
        $groupId = $_POST['gid'];		//类别ID
        $voteNum = $_POST['voteNum'];
        $picture = ($_FILES['pic']['error']>0)? null:upload('pic');
        if($voteNum>0) {
            $voteoptions = $_POST['option1'];
            for ($i=2; $i <= $voteNum; $i++) {
                $voteoptions = $voteoptions.'+||+'.$_POST['option'.$i.''];
            }
        }else{
            $voteoptions = null;
        }

        if(empty($title)) {
            $msg = '<font color=red><b>please add a title</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;
        }

        $n = 'first, authorid, title, content,image, addtime, gid, voteoptions';
        $v = '1, '.$authorid.', "'.$title.'", "'.$content.'", "'.$picture.'" ,'.$addtime.', '.$groupId.', "'.$voteoptions.'"';
        $result = dbInsert('gposts', $n, $v);

        $insert_id = dbSelect('gposts','pid','title="'.$title.'"','pid desc',1);
        $insertId = $insert_id[0]['pid'];
        if(!$result){

            $msg = '<font color=red><b>Posting failed, please contact the administrator</b></font>';
            $url = $_SERVER['HTTP_REFERER'];
            $style = 'alert_error';
            $toTime = 3000;
            include 'notice.php';
            exit;

        }else{

            //更新版块表的主题数量[Motifcount](跟帖是回复数量[eplycount])和最后发表[lastpost]
            $last = $insertId.'+||+'.$title.'+||+'.$addtime.'+||+'.$_COOKIE['username'];
            $result = dbUpdate('groups', 'motifcount=motifcount+1, lastpost="'.$last.'"', 'gid='.$groupId.'');
            $presult = dbInsert('gpostspermission','uid,pid,view,comment,addlink',''.$_COOKIE['uid'].','.$insertId.',1,1,1');

            if(is_array($MemberList)){
                foreach($MemberList AS $key=>$val){
                    $uid = $val['uid'];
                    $permission = $_POST['permission'.$uid.''];
                    switch ($permission){
                        case 0:
                            $view =0;
                            $comment=0;
                            $addlink=0;
                            break;
                        case 1:
                            $view =1;
                            $comment=0;
                            $addlink=0;
                            break;
                        case 2:
                            $view =1;
                            $comment=1;
                            $addlink=0;
                            break;
                        case 3:
                            $view =1;
                            $comment=1;
                            $addlink=1;
                            break;
                    }
                    $presult = dbInsert('gpostspermission','uid,pid,view,comment,addlink',''.$uid.','.$insertId.','.$view.','.$comment.','.$addlink.'');
                }
            }


            $msg = '<font color=red><b>Posting succeeded</b></font>';
            $url = 'group_post_detail.php?pid='.$insertId;
            $style = 'alert_right';
            $toTime = 3000;
            include 'notice.php';
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

