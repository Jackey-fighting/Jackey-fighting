<?php
public function fputcsv(){
        $header = array(1,2,3,4,5,6,6,7,78,9);
        
        $iconvToGbk = function($v) {
            return iconv('utf-8', 'gbk', $v);
        };

        $fp = fopen('php://output', 'w') or die('不能打开php://output');
        $filename = '测试csv.csv';
        //输出标题
        fputcsv($fp, array_map($iconvToGbk, array_values($header)));
        fclose($fp);

        header('Content-Type: application/csv');
        header("Content-Disposition:attachment;filename=".$filename); 
        header('Cache-Control: max-age=0');

}
