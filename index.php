<?php
	$loginUrl = 'http://cn.v2ex.com/signin';			//登陆入口
	$v2ex = new v2ex('otokaze','');		//你的账号密码，请符合v2ex的用户名规范
	if(!is_file($v2ex->CookiePath)){					//对已有登陆状态cookie的账号，程序会自动跳过登陆
		file_put_contents($v2ex->CookiePath,'');
		$v2ex->getOnceAndSession($loginUrl);			//获取初始状态的once值以及SESSIONID	
		$v2ex->login();
	}
	$v2ex->getOnce('http://cn.v2ex.com',$v2ex->CookiePath); //获得最新Once值，用于签到
	$v2ex->sign('http://cn.v2ex.com/mission/daily/redeem',$v2ex->CookiePath); //执行签到步骤
	$v2ex->update();

	function __autoload($className){  //自动引入类库
		include './class/'.$className.'.class.php';
	}
?>
