Linux系统环境检测
Linux系统可以使用以下脚本测试本机PHP环境是否满足WorkerMan运行要求。
curl -Ss http://www.workerman.net/check.php | php
上面脚本如果全部显示ok，则代表满足WorkerMan要求

下载 web-msg-sender 框架url:  https://www.workerman.net/download/senderzip
启动：linux系统cd到到框架目录里运行php start.php start -d
测试：浏览器访问端口http://ip:2123或者http://域名:2123

具体实现代码，一般改下url ，然后端口不变，再增加对应业务逻辑即可：
class Pushmsg extends Controller
{
	public function index(){
		echo "<script src='http://cdn.bootcss.com/socket.io/1.3.7/socket.io.js'></script>
				<meta http-equiv='Access-Control-Allow-Origin' content='*' />
				<script>
				    // 连接服务端，workerman.net:2120换成实际部署web-msg-sender服务的域名或者ip
				    var socket = io('http://www.yaowaren.com:2120');
				    // uid可以是自己网站的用户id，以便针对uid推送以及统计在线人数
				    uid = 123;
				    // socket连接后以uid登录
				    socket.on('connect', function(){
				    	socket.emit('login', uid);
				    });
				    // 后端推送来消息时
				    socket.on('new_msg', function(msg){
				        console.log('收到消息：'+msg);
				    });
				    // 后端推送来在线数据时
				    socket.on('update_online_count', function(online_stat){
				        console.log(online_stat);
				    });
				</script>";
	}

	public function pushMsgs(){
		// 指明给谁推送，为空表示向所有在线用户推送
		$to_uid = "456";
		// 推送的url地址，使用自己的服务器地址
		$push_api_url = "http://www.yaowaren.com:2121/";
		$post_data = array(
		   "type" => "publish",
		   "content" => "这个是Jackey推送的测试数据456",
		   "to" => $to_uid, 
		);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
		curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		var_export($return);
	}
}
