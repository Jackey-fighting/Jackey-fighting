<?php
$arr = array(1,234,542,2,44,33,10,24,100);

/**
*冒泡排序方法
*@param array $data
*@return array|string 
*/
function MaopaoSort($data){
   if (is_array($data)) {
      $count = count($data);

      for ($i=1; $i < $count; $i++) { //控制冒泡的次数
         //控制对比的次数
         for ($k=0; $k < $count-$i; $k++) { //这里为何要-$i是因为一轮对比后最大的数会在最右
            if ($data[$k] > $data[$k+1]) {
               $tmp = $data[$k];
               $data[$k] = $data[$k+1];
               $data[$k+1] = $tmp;
            }
         }
      }

      return $data;
   }
   return array();
}

var_dump(MaopaoSort($arr));
