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
                            <a href="group_memberlist.php?gid=<?php echo $OnGid; ?>&cat=0" title="Member List">Member List</a>
                        </dd>
                        <?php if($admin){?>
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
                            <tr>
                                <td>
                                    <?php if($admin){?>
                                <h2 class="xs2">Set new group description</h2><br/>
                                <input type="text" name="groupdescription" class="px" value="<?php echo $description; ?>">
                                    <?php } else { ?>
                                    <h2 class="xs2">Group description</h2><br/>
                                    <?php echo $description; ?>

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
                                <th style="width:30px;">Username</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="username" class="px" ></th>
                            </tr>
                            <tr>
                                <th style="width:30px;">User's First Name</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="userfirstname" class="px" ></th>
                            </tr>
                            <tr>
                                <th style="width:30px;">User Email</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="useremail" class="px" ></th>
                            </tr>
                            <tr id="tr_birthday">
                                <th id="th_birthday">Birthday</th>
                            </tr>
                            <tr>
                                <td id="td_birthday">
                                    <select name="birthyear" id="birthyear" class="ps" onchange="showbirthday();">
                                        <option value="2016" selected="selected">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                        <option value="2006">2006</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        <option value="1999">1999</option>
                                        <option value="1998">1998</option>
                                        <option value="1997">1997</option>
                                        <option value="1996">1996</option>
                                        <option value="1995">1995</option>
                                        <option value="1994">1994</option>
                                        <option value="1993">1993</option>
                                        <option value="1992">1992</option>
                                        <option value="1991">1991</option>
                                        <option value="1990">1990</option>
                                        <option value="1989">1989</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                    </select>&nbsp;
                                    <select name="birthmonth" id="birthmonth" class="ps">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>&nbsp;
                                    <select name="birthday" id="birthday" class="ps">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <button type="submit" name="invitesubmitbtn" id="invitesubmitbtn" value="true" class="pn pnc" /><strong>Invite</strong></button>
                                </th>
                            </tr>
                            <?php }?>
                            <tr><th><br/></th></tr>
                            <?php if(!$result){?>
                            <tr>
                                <th>
                                    <h3 class="xs2">Apply to Join</h3>
                                </th>
                            </tr>
                            <tr>
                                <th><button type="submit" name="applysubmitbtn" id="applysubmitbtn" value="true" class="pn pnc" /><strong>Apply</strong></button></th>
                            </tr>
                            <?php } else if($result and $approved==0){ ?>
                            <tr>
                                <th>
                                    <h3 class="xs2">Apply to Join</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <b>Your apply has been sent</b>
                                <th>
                            </tr>
                            <?php } else { ?>
                            <?php if(!$admin){?>
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

