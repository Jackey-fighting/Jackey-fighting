var today = new Date();
    var oneday = 1000 * 60 * 60 * 24;//一天
	
	var format='yyyy-MM-dd';

	var yesterday=new Date(today - oneday);//昨天
	var lastWeek = new Date(today- oneday * 7);//上周
	/*if(lastWeek){//设置时分秒为0
        lastWeek.setHours(0);
        lastWeek.setMinutes(0);
        lastWeek.setSeconds(0);
        lastWeek.setMilliseconds(0);
    }*/
    //format时间格式化
    result_yesterday = yesterday==null?null:yesterday.format(format);
    result_lastweek  = lastWeek==null?null:lastWeek.format(format);

    $('.common-input-inner').val(result_lastweek + " 至 " + result_yesterday);
