<?php
class Download
{

    /*
     * 导出岗位，树状图呈现
     */
    public function download_roster(){

        
        $result = Db::name('group')->field('id, title, pid, type')->select();
        header('content-type:text/html;charset=utf-8');
        //获取树状图
        $tree = $this->getSonTree($result);
        //引入phpexcel
        require "vendor/phpexcel/PHPExcel.php";
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('岗位树状图');
        //sheet的字母排列
        $sheetArr = array(
            "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "Q",
            "R",
            "S",
            "T",
            "U",
            "V",
            "W",
            "X",
            "Y",
            "Z",
            "AA",
            "AB",
            "AC",
            "AD",
            "AE",
            "AF",
            "AG",
            "AH",
            "AI",
            "AJ",
            "AK",
            "AL",
            "AM",
            "AN",
            "AO",
            "AP",
            "AQ",
            "AR",
            "AS",
            "AT",);

        $line = 1;
        $i = 0;
        foreach($tree as $k => $v){
            $line++;
           /* $objPHPExcel->getActiveSheet()->setCellValue('A'.$line, $v['title']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$line, $v['lev']);*/

             $objPHPExcel->getActiveSheet()->setCellValue($sheetArr[$v['lev']].$line, $v['title']);

             //设置水平对齐方式
           /* $objPHPExcel->getActiveSheet()->getStyle($sheetArr[$v['lev']].$line)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
            //设置垂直居中
            $objPHPExcel->getActiveSheet()->getStyle($sheetArr[$v['lev']].$line)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        }
        
        //输出到浏览器
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment;filename='岗位管理".date('Y-m-d-His').".xlsx'");
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }

    /**
    *@param array $arr 获取到的数据
    *@param int $id 父id
    *@param int $lev 级别
    *@return array
    */
   public function getSonTree($arr,$id=0,$lev=1){
    static $res=array();
    foreach ($arr as $v) {
        if ($v['pid']==$id) {
            $v['lev']=$lev;
            $res[] = $v;
            $this->getSonTree($arr,$v['id'],$lev+1);
        }
    }
    return $res;
    }
    
    /*
      //设第一行的名称
            $objPHPExcel->getActiveSheet()->setCellValue($k.$t, $v[0]);
            //设置填充颜色
            $objPHPExcel->getActiveSheet()->getStyle($k.$t)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle($k.$t)->getFill()->getStartColor()->setARGB('FF4F81BD');
            //设置字体
            $objPHPExcel->getActiveSheet()->getStyle($k.$t)->getFont()->setName('微软雅黑');
            //设置文字大小
            $objPHPExcel->getActiveSheet()->getStyle($k.$t)->getFont()->setSize(9);
            //设置文字颜色
            $objPHPExcel->getActiveSheet()->getStyle($k.$t)->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
    */
}
