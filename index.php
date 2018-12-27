<?php
include("includes/config.php");
if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn=$_SESSION['userLoggedIn'];
}else{
	header("Location:register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset=utf-8>
   <title>个人音乐平台</title>
</head>
<body>
    欢迎进入个人音乐平台,收听我们喜欢的音乐。
</body>
</html>