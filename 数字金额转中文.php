<?php
    /**
     * @param $d
     * @return string
     * 数字转大写
     */
    function d2cn($d) {
        $aryN = array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
        $aryW = array('分','角','元','拾','佰','仟','万','拾','佰','仟','亿','拾','佰','仟','万');
        $return = "";
        $d = "". $d * 100;
        if(!$d || strlen($d) > 15) return $return;

        for ($i=0,$len=strlen($d); $i<$len; $i++) {
            $w = $len - $i - 1;
            if(!$d{$i}) {
                if($d{$i+1}) $return .= $aryN[$d{$i}];
                if(in_array($w, array(2,6,10))) $return .= $aryW[$w];
            }
            else $return .= $aryN[$d{$i}].$aryW[$w];
        }
        echo $return;
    }
