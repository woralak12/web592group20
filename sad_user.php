<?php
	
	// สว่ นตงั้คา่ เรยี กใชง้าน UserService ของ Google
	use google\appengine\api\users\User;
	use google\appengine\api\users\UserService;
	global $user,$userdata,$appid;
	
	$user = UserService::getCurrentUser();
	if($user){
		$uid = $user->getUserId();
		$userfile = "gs://$appid/user_$uid.json";
		$userdata = array();
		if(file_exists($userfile)){
			// จะโหลดข ้อมูลในไฟล์ json
			$filedata = file_get_contents($userfile);
			$userdata = json_decode($filedata,true);
			}else{
			$userdata['nick']=$user->getNickname();
		}
		
		$url = UserService::createLogoutUrl('/sad.php');
		// แสดงภาพผใู้ช ้โดยการเรยี กฟังกช์ นั userpic จากข ้อที่ 1
		echo "<img src='".userpic($uid)."' width='200'><br>";
		echo $userdata['nick'];
		echo "<br><a href='sad.php?p=useredit'>User edit</a>";
		echo "<br><a href='$url'>Logout</a>";
		}else{
		$url = UserService::createLoginUrl('/sad.php');
		echo "<a href='$url'>Login or Register</a>";
	}
?>