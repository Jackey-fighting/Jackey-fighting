<?php
$mongo = new MongoClient();
$db = $mongo->test;//链接数据库，没有则自动创建
$collection = $db->runoob;//链接集合，没有则自动创建

$collection->find();
//结果
/*{ "_id" : "01001", "city" : "AGAWAM", "loc" : [ -72.622739, 42.070206 ], "pop" : 15338, "state" : "MA" }
{ "_id" : "01002", "city" : "AGAWAM", "loc" : [ -72.51565, 42.377017 ], "pop" : 36963, "state" : "MA" }*/

//如果需要使用到别名的话，就需要用到管道的$project来重命名了
$collection->aggregate(['$project'=>['myid'=>"$_id"]]);
//结果
/*{ "_id" : "01001", "myid" : "01001" }
{ "_id" : "01002", "myid" : "01002" }
{ "_id" : "01005", "myid" : "01005" }
{ "_id" : "01007", "myid" : "01007" }
{ "_id" : "01008", "myid" : "01008" }*/
#如果你想要只显示myid的话，可以直接加个 _id:0；
#['$project'=>['myid'=>"$_id", '_id'=>0]]
