<?php
namespace Home\Controller;
require APP_PATH."../vendor/autoload.php";
use think\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RmqController extends Controller{
	//生产者
	public function product(){
		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();

		$channel->queue_declare('hello', false, false, false, false);

		$content = array('name'=>'Jackey_'.mt_rand(1,100), 'phone'=>intval('1234567891'.mt_rand(1,100)));
		$msg = new AMQPMessage(json_encode($content));
		$channel->basic_publish($msg, '', 'hello');

		echo " [x] Sent 'Hello World!'\n";
		$channel->close();
		$connection->close();
	}

	//消费者
	public function receive(){
		set_time_limit(0);
		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();

		$channel->queue_declare('hello', false, false, false, false);

		echo " [*] Waiting for messages. To exit press CTRL+C\n";

		$callback = function ($msg) {
			$data = json_decode($msg->body,true);
			M()->table('rmq')->add($data);
		  	echo ' [x] Received ', $msg->body, "\n";
		};

		$channel->basic_consume('hello', '', false, true, false, false, $callback);

		while (count($channel->callbacks)) {
		    $channel->wait();
		}
	}

	public function callFunc($msg){
		$content = json_decode($msg->body, true);
		//把用户信息插入数据库
		M()->table('rmq')->add([
				'name'=>$content['name'],
				'phone'=>$content['phone'],
			]);
	}
}
