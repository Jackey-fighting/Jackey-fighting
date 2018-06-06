#!bin/bash
#定义两个路径变量
LOGPATH=/usr/local/nginx/logs/z.com.access.log
BASEPATH=/usr/local/nginx/data/$(date -d yesterday +%Y%m)

#创建目录，每月创建一个
mkdir -p $BASEPATH

bak=$BASEPATH/$(date -d yesterday +%d%H%M).zcom.access.log
#echo $bak

#将LOGPATH的日志移动到$bak下，并更改命名
mv $LOGPATH $bak
touch $LOGPATH  #创建新的LOGPATH的日志文件

#执行完毕后杀死nginx的pid进程
kill -USR1 `cat /usr/local/nginx/logs/nginx.pid`
