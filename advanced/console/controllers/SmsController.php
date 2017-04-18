<?php 
namespace console\controllers;
 use Yii;
use yii\console\Controller;
use common\models\Comment;

class SmsController extends Controller{
	public function actionSend(){
		$newCommentCount=Comment::find()->where(['remind'=>0,'status'=>1])->count();

		if($newCommentCount>0){
			$content='you'.$newCommentCount.'tiao ping lun dai shen he.';

			$result = $this->vendorSmsService($content);

			if($result['status']=='success'){
				Comment::updateAll(['remind'=>1]);
				echo '['.date("Y-m-d H:i:s",$result['dt']).']'.$content.'['.$result['length'].']'."\r\n";
			}
			return 0;
		}
	}

	protected function vendorSmsService($content)
	{
		//实现第三方短信供应商提供的短信发送接口。
	
		//     	$username = 'companyname';		//用户账号
		//     	$password = 'pwdforsendsms';	//密码
		//     	$apikey = '577d265efafd2d9a0a8c2ed2a3155ded7e01';	//密码
		//     	$mobile	 = $adminuser->mobile;	//号手机码
	
		//     	$url = 'http://sms.vendor.com/api/send/?';
		//     	$data = array
		//     	(
		//     			'username'=>$username,				//用户账号
		//     			'password'=>$password,				//密码
		//     			'mobile'=>$mobile,					//号码
		//     			'content'=>$content,				//内容
		//     			'apikey'=>$apikey,				    //apikey
		//     	);
		//     	$result= $this->curlSend($url,$data);			//POST方式提交
		//     	return $result;    //返回发送状态，发送时间，字节数等数据
		//     	}
		 
		$result=array("status"=>"success","dt"=>time(),"length"=>43);  //模拟数据
		return $result;
		 
	}

}
?>
