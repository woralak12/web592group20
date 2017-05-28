<?php
 use google\appengine\api\users\UserService;
 global $appid,$page,$title,$userdata;
 //ไฟล์ความคิดเห็นจะบันทึกไว้ในไฟล์ json ตามชอื่ $page
// เชน่ หน้า home ก็จะบันทึกข ้อมูลไว้ในไฟล์ home.json
 $fbfile = "gs://$appid/$page.json";
 $fbdata = array();
 //ถ้ามีไฟล์ข้อมูลให้อ่านไฟล์มาแสดงผล
 if(file_exists($fbfile)){
 $fbjson = file_get_contents($fbfile);
 $fbdata = json_decode($fbjson, true);
 echo "<hr>";
 foreach($fbdata as $fb){
 $text = htmlspecialchars($fb['feedback']);
 $time=date("d/m/Y H:i:s",$fb['time']);
 //มีการเรียก userpic เพอื่ แสดงภาพผใู้ช ้
 $pic = userpic($fb['user']);
 echo "<div class='row'>";
 echo "<div class='col-xs-1'><img src='$pic' width='48'></div>";
 echo "<div class='col-xs-10'>";
 echo "<a href='#'>$fb[name]</a><br>$text <br>";
 echo "<a href='#'>ถูกใจ</a> $time<hr>";
 echo "</div>";
 echo "</div>";
 }
 }

 //กรณีทผี่ ใู้ช ้login แล้ว ให้สามารถแสดงความคิดเห็นได ้
 $user = UserService::getCurrentUser();
 if($user){
 include("lovee_feedback_add.php");
 }
?>