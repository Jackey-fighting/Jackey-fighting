<?php
水平分表：就是把一个表拆分成多个表，然后命名规则是msg_01, msg_02....等等，但是必须要特别注意的是 （每张表的字段顺序、字段名称、字段类型、
索引定义的顺序及其定义的方式必须相同）；
1.使用合并表的方法
CREATE TABLE IF NOT EXISTS `user_01`(
`id` int(11) not null AUTO_INCREMENT,
`name` char(30) DEFAULT NULL,
`sex` int(1) not null default '0',
PRIMARY KEY(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `user_02`(
`id` int(11) not null AUTO_INCREMENT,
`name` char(30) DEFAULT NULL,
`sex` int(1) not null default '0',
PRIMARY KEY(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

合并表
CREATE TABLE IF NOT EXISTS `allusers`(
`id` int(11) not null AUTO_INCREMENT,
`name` char(30) DEFAULT NULL,
`sex` int(1) not null default '0',
INDEX(id)
)ENGINE=MERGE UNION=(user1,user2) INSERT_METHOD=LAST AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 

这里的INSERT_METHOD有3个方法：NO, LAST, FIRST，意思就是比如我们：insert into allusers(`name`, `sex`) values('王五',0);
就会把值存到user_02表了，这里的引擎也要选择MERGE，然后特别注意的是，不建议在合并表这里使用主键索引，直接使用INDEX索引即可。

  
2.然后这里在来说下不使用合并表的：
  CREATE TABLE IF NOT EXISTS `user_01`(
`id` int(11) not null AUTO_INCREMENT,
`uid` int(11) not null,
`name` char(30) DEFAULT NULL,
`sex` int(1) not null default '0',
PRIMARY KEY(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `user_02`(
`id` int(11) not null AUTO_INCREMENT,
`uid` int(11) not null,
`name` char(30) DEFAULT NULL,
`sex` int(1) not null default '0',
PRIMARY KEY(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

然后插入的时候，可以根据uid来分配插入到哪个表，比如：
  我们可以使用:
function insert_user($uid){
  $str = crc32($uid);
  if($str < 0){
    return '0'.substr(abs($str), 0, 1);
  }else{
    return substr($str, 0, 2);
  }
}
上面这个函数是根据uid随机选出哪个表来填充数据，这个规则可以自己定义，你也可以取模比如：$uid%2 这来搞。
  不过这种一般都是太死了，后期很难拓展。
