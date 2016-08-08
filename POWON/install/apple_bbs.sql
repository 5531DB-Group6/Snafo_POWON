CREATE TABLE IF NOT EXISTS `bbs_groups` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `replycount` int(10) NOT NULL DEFAULT '0',
  `motifcount` int(10) NOT NULL DEFAULT '0',
  `owner` int(11) DEFAULT NULL,
  `grouppic` varchar(200) NOT NULL DEFAULT 'public/images/forum.gif',
  `description` mediumtext,
  `orderby` smallint(6) NOT NULL DEFAULT '0',
  `lastpost` varchar(600) DEFAULT NULL,
  `namestyle` char(10) DEFAULT NULL,
  `ispass` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gid`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_gmembers` (
  `gid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `approved` tinyint(2) NOT NULL DEFAULT '0',
  `admin` tinyint(2) NOT NULL DEFAULT '0',
  `mute` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gid`,`uid`),
  FOREIGN KEY (`gid`) REFERENCES `bbs_groups`(`gid`) ON DELETE CASCADE,
  FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_gposts` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `parentid` int(10) NOT NULL DEFAULT '0',
  `authorid` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `voteoptions` varchar(600) DEFAULT NULL,
  `gid` int(10) NOT NULL,
  `addtime` int(12) NOT NULL,
  `replycount` int(12) NOT NULL DEFAULT '0',
  `hits` int(12) NOT NULL DEFAULT '0',
  `isdel` tinyint(2) NOT NULL DEFAULT '0',
  `isdisplay` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`gid`) REFERENCES `bbs_groups`(`gid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_gpostdelete` (
  `pid` int(10) NOT NULL,
  `deletetime` int(12) NOT NULL,
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`pid`) REFERENCES `bbs_gposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_upostdelete` (
  `pid` int(10) NOT NULL,
  `deletetime` int(12) NOT NULL,
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`pid`) REFERENCES `bbs_uposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_mails` (
  `mailid` int(10) NOT NULL AUTO_INCREMENT,
  `senderid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `sendtime` int(12) NOT NULL,
  `isread` tinyint(2)  DEFAULT '0',
   PRIMARY KEY (`mailid`),
   FOREIGN KEY (`senderid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
   FOREIGN KEY (`receiverid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_uposts` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `parentid` int(10) NOT NULL DEFAULT '0',
  `authorid` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `addtime` int(12) NOT NULL,
  `replycount` int(12) NOT NULL DEFAULT '0',
  `hits` int(12) NOT NULL DEFAULT '0',
  `isdel` tinyint(2) NOT NULL DEFAULT '0',
  `isdisplay` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`authorid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_pposts` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `authorid` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `addtime` int(12) NOT NULL,
  `isdel` tinyint(2) NOT NULL DEFAULT '0',
  `isdisplay` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`authorid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `classname` varchar(60) NOT NULL,
  `parentid` int(10) NOT NULL,
  `classpath` char(20) DEFAULT NULL,
  `replycount` int(10) NOT NULL DEFAULT '0',
  `motifcount` int(10) NOT NULL DEFAULT '0',
  `compere` char(10) DEFAULT NULL,
  `classpic` varchar(200) NOT NULL DEFAULT 'public/images/forum.gif',
  `description` mediumtext,
  `orderby` smallint(6) NOT NULL DEFAULT '0',
  `lastpost` varchar(600) DEFAULT NULL,
  `namestyle` char(10) DEFAULT NULL,
  `ispass` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cid`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_friend` (
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `approved` tinyint(2) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `addtime` int(12) NOT NULL,
  PRIMARY KEY (`uid`,`fid`),
  FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
  FOREIGN KEY (`fid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_chat` (
  `chatid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `msg` text,
   PRIMARY KEY (`chatid`),
  FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
  FOREIGN KEY (`fid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE)
  ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_profileVisible` (
  `uid` int(11) NOT NULL,
  `firstname_visible` tinyint(2) DEFAULT '2',
  `lastname_visible` tinyint(2) DEFAULT '2',
  `sex_visible` tinyint(2) DEFAULT '2',
  `bday_visible` tinyint(2) DEFAULT '2',
  `address_visible` tinyint(2) DEFAULT '2',
  `place_visible` tinyint(2) DEFAULT '2',
   `profession_visible` tinyint(2) DEFAULT '2',
   PRIMARY KEY (`uid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_profileVisibleMember` (
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `firstname_visible` tinyint(2) DEFAULT '1',
  `lastname_visible` tinyint(2) DEFAULT '1',
  `sex_visible` tinyint(2) DEFAULT '1',
  `bday_visible` tinyint(2) DEFAULT '1',
  `address_visible` tinyint(2) DEFAULT '1',
  `place_visible` tinyint(2) DEFAULT '1',
  `profession_visible` tinyint(2) DEFAULT '1',
   PRIMARY KEY (`uid`,`tid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
   FOREIGN KEY (`tid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_gpostsPermission` (
  `pid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `view` tinyint(2) DEFAULT '1',
  `comment` tinyint(2) DEFAULT '1',
  `addlink` tinyint(2) DEFAULT '1',
   PRIMARY KEY (`pid`,`uid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
   FOREIGN KEY (`pid`) REFERENCES `bbs_gposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_upostsPermission` (
  `pid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `view` tinyint(2) DEFAULT '1',
  `comment` tinyint(2) DEFAULT '1',
  `addlink` tinyint(2) DEFAULT '1',
   PRIMARY KEY (`pid`,`uid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
   FOREIGN KEY (`pid`) REFERENCES `bbs_uposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_upostsPermissionPublic` (
  `pid` int(10) NOT NULL,
  `view` tinyint(2) DEFAULT '1',
  `comment` tinyint(2) DEFAULT '1',
  `addlink` tinyint(2) DEFAULT '1',
   PRIMARY KEY (`pid`),
   FOREIGN KEY (`pid`) REFERENCES `bbs_uposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_voterecord` (
  `pid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote` tinyint(2) DEFAULT '0',
   PRIMARY KEY (`pid`,`uid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE,
   FOREIGN KEY (`pid`) REFERENCES `bbs_gposts`(`pid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_bill` (
  `billid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `invoice` varchar(16),
  `paydate` int(12),
   `amount` double NULL,
   PRIMARY KEY (`billid`),
   FOREIGN KEY (`uid`) REFERENCES `bbs_user`(`uid`) ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `tid` int(10) NOT NULL DEFAULT '0',
  `authorid` int(10) NOT NULL,
  `title` varchar(600) NOT NULL,
  `content` mediumtext NOT NULL,
  `smiley` smallint(4) DEFAULT NULL,
  `addtime` int(12) NOT NULL,
  `addip` int(12) NOT NULL,
  `classid` int(10) NOT NULL,
  `replycount` int(12) NOT NULL DEFAULT '0',
  `hits` int(12) NOT NULL DEFAULT '0',
  `istop` tinyint(2) NOT NULL DEFAULT '0',
  `elite` tinyint(2) NOT NULL DEFAULT '0',
  `ishot` tinyint(2) NOT NULL DEFAULT '0',
  `rate` smallint(3) NOT NULL DEFAULT '0',
  `attachment` smallint(3) DEFAULT NULL,
  `isdel` tinyint(2) NOT NULL DEFAULT '0',
  `style` char(10) DEFAULT NULL,
  `isdisplay` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20; dbg6;

CREATE TABLE IF NOT EXISTS `bbs_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `email` char(30) NOT NULL,
  `udertype` tinyint(2) NOT NULL,
  `regtime` int(12) NOT NULL,
  `lasttime` int(12) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'public/images/avatar_blank.gif',
  `firstname` char(32) DEFAULT NULL,
  `lastname` char(32) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT '0',
  `birthday` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
   `profession` varchar(50) DEFAULT NULL,
   `status` tinyint(1) NOT NULL DEFAULT '0',
   `coins` tinyint(2) NOT NULL DEFAULT '10',
   PRIMARY KEY (`uid`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; dbg6;
