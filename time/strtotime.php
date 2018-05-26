<?php
public function test(){
        $time = '2016-07-01 00:00:00';
        $i = 0;
        $time = date('Y-m-01 00:00:00', strtotime("$time +$i month"));
        $time = date('Y-m-t 00:00:00', strtotime("$time +1 month"));//当月的最后一天
    }
