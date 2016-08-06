<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--HEAD start-->
<?php include template("head.html");?>
<!--HEAD end-->

<!--CONTENT start-->
<script src="/POWON/public/js/moment.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>

<div id="wp" class="wp">
    <div id="pt" class="bm cl">
        <div class="z">
            <a href="./" class="nvhm" title="<?php echo $title; ?>"><?php echo $title; ?></a><em>&raquo;</em><a href="index.php">Home</a>
        </div>
        <div class="z" >
            <?php
                        $user  = dbSelect('user','*','uid='.$_COOKIE['uid'].'');
             ?>
            <script>
                var  nextmonth= moment().add(30, 'day').unix();
                var expiretime = <?php echo $user[0]['expiretime']; ?>;
                if( expiretime < nextmonth){
                    var dayleft = Math.round((expiretime-moment().unix())/60/60/24);
                    document.write(String("Your membership will be expired in "+dayleft+" days ").fontcolor("red"))
                }
            </script>
        </div>
    </div>

    <div class="mn">
    </div>
    <div class="fl bm">
        <!--public start-->
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <h2><a href="Public.php">Public Information</a></h2>
            </div>
            <div id="public" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                </table>
            </div>
        </div>
        <!--public end-->


        <?php if($_COOKIE['uid']){?>

        <!--friend start-->
        <div class="bm bmw cl">
            <div class="bm_h cl">
                <th>
                    <a href="member.php?mlist=1"><b>My Friends</b></a>
                </th>
                <?php if(!empty($FriendRequest)){?>
                <td><span class="pipe">|</span></td>
                <td class="common" style="text-align: right">
                    <a href="home_friend.php" style="color: rgba(159, 27, 5, 0.94);"><b>You have a friend request</b></a>
                </td>
                <?php }?>
            </div>
            <div id="friendlist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($FriendList)){foreach($FriendList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <?php
                        $msg = dbselect('chat','*','uid='.$val['uid'].' and fid='.$_COOKIE['uid'].' and isread=0')
                    ?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <a href="member_chatbox_index.php?uid=<?php echo $val['uid']; ?>"target="_blank">
                            <?php if(!empty($msg)){?>
                            <img src="public/images/unread_Chat.png" style="width: auto; height: auto;max-width: 20px;max-height: 30px" >
                            <?php } else { ?>
                            <img src="public/images/read_Chat.png" style="width: auto; height: auto;max-width: 20px;max-height: 30px" >
                            <?php }?></a>
                        <h2><p>
                            <span class="xi2"><?php echo $val['username']; ?></span>
                        </p> </h2>
                    </td>
                    <?php }}?>
                    <?php
                    for($i = 1;$i <= $FriendListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                    }
                    ?>
                </table>
            </div>
        </div>
        <!--friend end-->

        <!--group start-->
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <b><a href="group.php?glist=1">My Groups</a></b>
                <td><span class="pipe">|</span></td>
                <td class="common" style="text-align: right">
                    <b><a href="group_reg.php" style="color: rgba(159, 27, 5, 0.94);">Create Group</a></b>
                </td>
            </div>
            <div id="your_groups" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($GrMenu)){foreach($GrMenu AS $key=>$val) { ?>
                    <?php if($key%4==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:60px;height:80px;text-align: center;" >
                        <a href="group_postlist.php?gid=<?php echo $val['gid']; ?>"><img src="<?php echo $val['grouppic']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" alt="<?php echo $val['name']; ?>" /></a>
                    </td>
                    <td>
                        <h2><a href="group_postlist.php?gid=<?php echo $val['gid']; ?>" style="color:<?php echo $val['namestyle']; ?>"><?php echo $val['name']; ?></a></h2>
                        <p class="xg2"><?php echo $val['description']; ?></p>
                        <?php if(!empty($val['owner'])){?>
                        <p>Owner: <span class="xi2"><?php echo getUserName($val['owner']); ?></span></p>
                        <?php }?>
                    </td>
                    <?php }}?>
                </table>
            </div>
        </div>
        <!--group end-->

        <!--user start-->
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <h2><a href="member.php?mlist=0">POWON Members</a></h2>
            </div>
            <div id="memberlist" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($UserList)){foreach($UserList AS $key=>$val) { ?>
                    <?php if($key%8==0 and $key!=0){?><tr> </tr><?php }?>
                    <?php
                        $msg = dbselect('chat','*','uid='.$val['uid'].' and fid='.$_COOKIE['uid'].' and isread=0')
                    ?>
                    <td style="width:80px;height:100px;text-align: center;" >
                        <a href="member_home.php?uid=<?php echo $val['uid']; ?>"><img src="<?php echo $val['picture']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" ></a>
                        <a href="member_chatbox_index.php?uid=<?php echo $val['uid']; ?>"target="_blank">
                            <?php if(!empty($msg)){?>
                            <img src="public/images/unread_Chat.png" style="width: auto; height: auto;max-width: 20px;max-height: 30px" >
                            <?php } else { ?>
                            <img src="public/images/read_Chat.png" style="width: auto; height: auto;max-width: 20px;max-height: 30px" >
                            <?php }?></a>
                        <h2><p><span class="xi2"><?php echo $val['username']; ?></span></p></h2>
                    </td>
                    <?php }}?>

                    <?php
                    for($i = 1;$i <= $UserListRest; $i++){
                    echo '<td style="width:80px;height:100px;text-align: center;" ></td>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <!--user end-->

        <!--group start-->
        <div class="bm bmw  cl">
            <div class="bm_h cl">
                <b><a href="group.php?glist=0">All Groups</a></b>
                <td><span class="pipe">|</span></td>
                <td class="common" style="text-align: right">
                    <b><a href="group_reg.php" style="color: rgba(159, 27, 5, 0.94);">Create Group</a></b>
                </td>
            </div>
            <div id="all_groups" class="bm_c">
                <table cellspacing="0" cellpadding="0" class="fl_tb">
                    <?php if(is_array($GrMenuAll)){foreach($GrMenuAll AS $key=>$val) { ?>
                    <?php if($key%4==0 and $key!=0){?><tr> </tr><?php }?>
                    <td style="width:60px;height:80px;text-align: center;" >
                        <a href="group_postlist.php?gid=<?php echo $val['gid']; ?>"><img src="<?php echo $val['grouppic']; ?>" style="width: auto; height: auto;max-width: 60px;max-height: 80px" alt="<?php echo $val['name']; ?>" /></a>
                    </td>
                    <td>
                        <h2><a href="group_postlist.php?gid=<?php echo $val['gid']; ?>" style="color:<?php echo $val['namestyle']; ?>"><?php echo $val['name']; ?></a></h2>
                        <p class="xg2"><?php echo $val['description']; ?></p>
                        <?php if(!empty($val['owner'])){?>
                        <p>Owner: <span class="xi2"><?php echo getUserName($val['owner']); ?></span></p>
                        <?php }?>
                    </td>
                    <?php }}?>
                </table>
            </div>
        </div>
        <!--group end-->
        <?php }?>

    </div>


</div>
</div>
</div>
<!--CONTENT end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

