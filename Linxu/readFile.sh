#读取特定文件内容并把内容存到一个新文件上

#!/bin/bash
cat shell.sh | tail -n +0 |head -n 2|while read line
do
echo ${line%.*}
done >line.txt

#cat shell.sh 是读取了 shell.sh 文件内容
#tail -n +0 表示从第一行开始读到最后一行，如果是 -0 则表示从最后一行开始读到第一行
#head -n 2 表示读取2行的内容
#while read line 表示读取文件每行的内容，并 ${line%.*}， .* 表示正则的开始
#done >line.txt 表示将内容一行一行的存到line.txt文件上
