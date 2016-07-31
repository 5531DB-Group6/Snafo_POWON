<?php include template("header.html");?>
<!--TOP start-->
<?php include template("top.html");?>
<!--TOP end-->

<!--HEAD start-->
<?php include template("head.html");?>
<!--HEAD end-->
<link rel="stylesheet" type="text/css" href="<?php echo $domain_resource; ?>/css/post.css" />
<!--LIST start-->
<div id="wp" class="wp">
    <div id="pt" class="bm cl">
        <div class="z"><a href="./" class="nvhm" title="<?php echo $title; ?>"><?php echo $title; ?></a><em>&raquo;</em><a href="index.php">Home</a><em>&raquo;</em><a href="group.php">Group</a><em>&raquo;</em><a href="group_postlist.php?gid=<?php echo $groupId; ?>"><?php echo $OnGname; ?></a><em>&raquo;</em>Add Post</div>
    </div>
    <form method="post" autocomplete="off" id="postform" action="group_addc.php">
        <div id="ct" class="ct2_a ct2_a_r wp cl">
            <div class="mn">
                <div class="bm bw0 cl" id="editorbox">
                    <ul class="tb cl mbw">
                        <li class="a"><a href="javascript:;">Add Post</a></li>
                    </ul>

                    <div id="postbox">
                        <div class="pbt cl">
                            <div class="z">
                                <span><input type="text" name="subject" id="subject" class="px" onkeyup="showLength(this,'checklen',80);" style="width: 25em" tabindex="1" /></span>
                                <span id="subjectchk">Your can still enter another <strong id="checklen">80</strong> Characters </span>
                            </div>
                        </div>

                        <div id="e_body_loading">
                            <script type="text/javascript" src="public/ckeditor/ckeditor.js"></script>
                            <script src="public/ckeditor/sample.js" type="text/javascript"></script>
                            <textarea  class="ckeditor"  name="content"  id="editor1"></textarea>
                        </div>

                        <input type="hidden" id="gid" name="gid" value="<?php echo $groupId; ?>" />
                        <div class="mtm mbm pnpost">
                            <button type="submit" id="postsubmit" class="pn pnc" value="true" name="topicsubmit">
                                <span>Add Post</span>
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
<!--LIST end-->

<!--FOOT start-->
<?php include template("footer.html");?>
<!--FOOT end-->
</body>
</html>

