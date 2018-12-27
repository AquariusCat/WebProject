<?php
  //打开缓存区
  ob_start();
  session_start();
  //时区时间
  $timezone=date_default_timezone_set("Asia/Shanghai");
  
  //连接数据库
  $conn=mysqli_connect("127.0.0.1","root","","mymusic");
  //检查数据库是否连接成功
  if(mysqli_connect_errno()){
 	  if(isset($_POST[$name])){
 		  echo $_POST[$name];
 	  }
   }
?>