<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    //发送邮件方法
    public function sendEmail(){
    	if (!IS_POST) {
    		$this->display('sendEmail');
    	}else{
    		$name = I("post.name");
    		$email = I("post.email");
    		$data = D('Index')->create();//tp中的create是返回一个一维数组，key是字段名
    		$data['password']=md5(I("post.password"));
    		$res = D('Index')->add($data);
    		var_dump(think_send_mail("$email","尊敬的$name","欢迎使用邮箱验证方式,请点击下面的连接，进行邮箱验证","http://thinkphp/index.php/Home/Index/verify/m_id/".$res));
    		echo "<script type='text/javascript'>alert('sendEmail success.');</script>";
    	}
    }//sendEmail end

	//邮箱验证
	public function verify(){
		$w['m_id']=I("get.m_id");
		$data['type']=1;
		$res = D('Index')->where($w)->save($data);
		if ($res) {
			$this->success("验证成功，赶快去登录吧");
		}else{
			$this->error("验证失败！请联系安管理员");
		}
	}

}//IndexController  end