<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--HEAD start-->
<?php include template("head.html");?>
<!--HEAD end-->

<!--LIST start-->
<div id="wp" class="wp">
    <div id="pt" class="bm cl">
        <div class="z">
            <a href="./" class="nvhm" title="<?php echo $title; ?>"><?php echo $title; ?></a><em>&raquo;</em><a href="index.php">Home</a><em>&raquo;</em><a href="group.php">Group</a><em>&raquo;</em><a href="group_postlist.php?gid=<?php echo $groupId; ?>"><?php echo $OnGname; ?></a>
        </div>
    </div>
    <div class="boardnav">
        <div id="ct" class="wp bm cl" style="margin-left:145px;">
            <div id="sd_bdl" class="bdl" style="width:130px;margin-left:-145px">
                <div class="tbn" id="forumleftside"><h2 class="bdl_h">Menue</h2>
                    <dl class="a" id="lf_group">
                        <dt><a href="javascript:;" title="Posts">Posts</a></dt>
                        <dd>
                            <a href="group_postlist.php?gid=<?php echo $OnGid; ?>" title="Post List">Post List</a>
                        </dd>
                    </dl>
                    <dl class="a" id="lf_member">
                        <dt><a href="javascript:;" title="Members">Members</a></dt>
                        <dd>
                            <a href="group_memberlist.php?gid=<?php echo $OnGid; ?>" title="Member List">Member List</a>
                        </dd>
                        <?php if($admin==1){?>
                        <dd>
                            <a href="group_pendinglist.php?gid=<?php echo $OnGid; ?>" title="Pending List">Pending List</a>
                        </dd>
                        <?php }?>
                    </dl>
                    <dl class="a" id="lf_operation">
                        <dt><a href="javascript:;" title="Operation">Opeation</a></dt>
                        <dd class="bdl_a">
                            <a href="group_info.php?gid=<?php echo $OnGid; ?>" title="Post List">Opeation</a>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="mn" style="margin-left:15px;">
                <div class="bm bw0">
                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                        <table cellspacing="0" cellpadding="0" class="tfm">
                            <caption>
                                <h2 class="xs2"><?php echo $OnGname; ?></h2>
                            </caption>
                            <tr>
                                <td>
                                    <img src="<?php echo $Gpic; ?>" style="border:1px solid #ccc;width:auto;height:auto;max-width: 150px;max-height:200px;" /><br /><br />
                                    <?php if($admin){?>
                                    <h2 class="xs2">Set new logo</h2><br/>
                                    <input name="pic" type="file" style="height:23px; width:300px;" />
                                    <?php }?>
                                </td>
                            </tr>
                            <?php if($admin){?>
                            <tr>
                                <td>
                                    <button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnc" /><strong>Save</strong></button>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                <h3 class="xs2">Invite new member</h3>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:30px;">User Name</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="username" class="px" ></th>
                            </tr>
                            <tr>
                                <th>
                                    <button type="submit" name="invitesubmitbtn" id="invitesubmitbtn" value="true" class="pn pnc" /><strong>Invite</strong></button>
                                </th>
                            </tr>
                            <?php }?>
                            <tr><th><br/></th></tr>
                            <?php if(!$isOwner){?>
                            <tr>
                                <th>
                                    <h3 class="xs2">Leave the Group</h3>
                                </th>
                            </tr>
                            <tr>
                                <th><button type="submit" name="leavesubmitbtn" id="leavesubmitbtn" value="true" class="pn pnc" /><font color="#8b0000"><strong>Leave</strong></font></button></th>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <th>
                                    <h3 class="xs2">Dismiss the Group</h3>
                                </th>
                            </tr>
                            <tr>
                                <th><button type="submit" name="destroyubmitbtn" id="destroyubmitbtn" value="true" class="pn pnc" /><strong><font color="#8b0000">Dismiss</font></strong></button></th>
                            </tr>
                            <?php }?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--LIST end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

