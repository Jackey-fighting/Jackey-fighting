<?php
namespace app\index\controller;
require VENDOR_PATH.'/Carbon/autoload.php';
use Carbon\Carbon;

class Index
{
    public function index()
    {	//获取starTime 的第一天
    	$starMonth = '2018-03';
		$starTime = (new Carbon("first day of ".$starMonth))->toDateString();
		//获取endTime 的最后一天
		$endMonth = '2018-05';
		$endTimeArr = explode('-', $endMonth);
		$endTime = Carbon::create($endTimeArr[0], $endTimeArr[1])->endOfMonth()->toDateString();
		echo '<br/><br/>';

		$result = model('TestNum')->select($starTime, $endTime);

		$year = substr($starMonth, 0, 6);//获取开始的年
		$day = substr($starMonth, -1, 1);//获取月用于递增判断
		$end = substr($endMonth, -1, 1);//获取最后一个月份的月
		$sum_category_num = [];//用来存月数的总数

		for ($i=$day; $i <= $end; $i++) { 
			echo $i.'月份：<br/>';
			foreach ($result as $value) {
				if (substr($value['data_date'], 0, 7) == $year.$i) {
					$sum_category_num[$i] = (!empty($sum_category_num[$i]) ? $sum_category_num[$i] : 0) + $value['category_num'];
				}
			}//end foreach
			echo '总数'.(!empty($sum_category_num[$i]) ? $sum_category_num[$i] : 0).'<br/>';
		}//end for
    }
}
