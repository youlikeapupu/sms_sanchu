<?php
	// 取得目前三竹簡訊額度
	function getMsgPoint($mitake_account, $mitake_pwd){
	    // 取得目前簡訊額度
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, "http://smexpress.mitake.com.tw/SmQueryGet.asp?username=".$mitake_account."&password=".$mitake_pwd);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $output = explode("=",$result);
	    $ot=isset($output[1])?$output[1]:'';
	    return $ot;
	}

	// 發送三竹簡訊
	function setMsgSend($username, $password, $phone, $msg) {

	    $sms_url = 'http://smexpress.mitake.com.tw/SmSendGet.asp?';
	    $sms_url .= 'username='.$username;
	    $sms_url .= '&password='.$password;
	    $sms_url .= '&dstaddr='.$phone;
	    $sms_url .= '&DestName=TEST&dlvtime=&vldtime=&encoding=UTF8&smbody='.$msg;

	    // 建立CURL連線
	    $ch = curl_init();
	    $timeout = 5;

	    //設定port
	    // curl_setopt($ch, CURLOPT_PORT, 9600);

	    // 設定擷取的URL網址
	    curl_setopt($ch, CURLOPT_URL, $sms_url);
	    curl_setopt($ch, CURLOPT_HEADER, false);

	    //將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

	    //設定抓取時間
	    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	    // 執行
	    $file_contents = curl_exec($ch);

	    // 關閉CURL連線
	    curl_close($ch);

	    // echo $file_contents;
	    return true;
	}
?>
