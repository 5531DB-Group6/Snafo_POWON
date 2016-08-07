<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--CONTENT start-->
<script src="/POWON/public/js/moment.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div id="wp" class="wp">
    <div id="pt" class="bm cl">
        <div class="z">
            <a href="./" class="nvhm" title="<?php echo $title; ?>"><?php echo $title; ?></a><em>&raquo;</em><a href="index.php">Home</a>
        </div>

    </div>


</div>

<div class="mn">
</div>
<div class="fl bm">
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Mail <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Mail</a></li>
                </ul>
            </div>
        </div>

    </div>

    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <a href="mailbox_compose.php" class="btn btn-danger btn-sm btn-block" role="button">COMPOSE</a>
                <hr />
                <li class="active"><a href="mailbox.php"><span class="badge pull-right">42</span> Inbox </a>
                </li>
                <li><a href="mailbox_sentmail.php">Sent Mail</a></li>
                <li><a href=#"><span class="badge pull-right"></span>Drafts</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">

            <link rel="stylesheet" type="text/css" href="<?php echo $domain_resource; ?>/css/post.css" />
            <!--LIST start-->
            <div id="wp" class="wp">
                <form method="post" autocomplete="off" id="postform" action="mailbox_sendgift.php">
                    <div id="ct" class="ct2_a ct2_a_r wp cl">
                        <div class="mn">
                            <div class="bm bw0 cl" id="editorbox">

                                <div id="postbox">
                                    <div class="pbt cl">
                                        <div class="z">
                                            <span>To <span style="padding: 0 10px"></span>
                                                <input type="text" name="sendto" id="sendto"  style="font-size: 10pt; height: 30px; width:560px;" tabindex="1" placeholder="username" />
                                            </span>
                                        </div> </br></br>
                                        <div class="z">
                                            <span><input type="text" name="subject" id="subject" onkeyup="showLength(this,'checklen',80);" style="font-size: 10pt; height: 30px; width:600px;" tabindex="1" placeholder="subject"/></span>
                                            <span id="subjectchk">Your have <strong id="checklen">80</strong> Character left </span>
                                        </div>
                                    </div>

                                    <div id="e_body_loading">
                                        <img src="public/images/treasure-chest.gif" alt="treasure chest" style="width:400px;height:400px;">
                                    </div>

                                    <div class="mtm mbm pnpost">
                                        <button type="submit" id="giftsubmit" class="pn pnc" value="true" name="giftsubmit">
                                            <span>Send</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script>

                    var BROWSER = {};
                    var USERAGENT = navigator.userAgent.toLowerCase();
                    browserVersion({'ie':'msie','firefox':'','chrome':'','opera':'','safari':'','mozilla':'','webkit':'','maxthon':'','qq':'qqbrowser'});
                    if(BROWSER.safari) {
                        BROWSER.firefox = true;
                    }
                    BROWSER.opera = BROWSER.opera ? opera.version() : 0;

                    function showLength(obj,checklen,maxlen){

                        var v = obj.value, charlen = 0, maxlen = !maxlen ? 200 : maxlen, curlen = maxlen, len = strlen(v);
                        for(var i = 0; i < v.length; i++) {
                            if(v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
                                curlen -= 2;
                            }
                        }
                        if(curlen >= len) {
                            document.getElementById("checklen").innerHTML = curlen - len;
                        } else {
                            obj.value = mb_cutstr(v, maxlen, true);
                        }

                    }

                    function strlen(str) {
                        return (BROWSER.ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
                    }

                    function mb_cutstr(str, maxlen, dot) {
                        var len = 0;
                        var ret = '';
                        var dot = !dot ? '...' : '';
                        maxlen = maxlen - dot.length;
                        for(var i = 0; i < str.length; i++) {
                            len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? 3 : 1;
                            if(len > maxlen) {
                                ret += dot;
                                break;
                            }
                            ret += str.substr(i, 1);
                        }
                        return ret;
                    }

                </script>
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

