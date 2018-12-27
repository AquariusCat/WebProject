<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");
	$account=new Account($conn);
	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
	
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<title>个人音乐平台</title>
<link rel="stylesheet"  href="assets/css/register.css"/>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
</head>
</head>
	<script type="text/javascript">
		$(document).ready(function(){
				$("#loginForm").hide();
				$("#registerForm").show();
		})
	</script>
<body>
	<?php
	if(isset($_POST["registerButton"])){
		echo '<script type="text/javascript">
		$(document).ready(function(){
				$("#loginForm").hide();
				$("#registerForm").show();
		})
	</script>';
	}else{
		echo '<script type="text/javascript">
		$(document).ready(function(){
				$("#loginForm").show();
				$("#registerForm").hide();
		})
	</script>';
	}
	?>
<div id="background">
	<div id="loginContain">
	<div id="inputContainer">
	<form action="register.php" id="loginForm"  method="POST" accept-charset="utf-8">
			<h2>登陆你的账号</h2>

			<p>
					<label for="loginUsername">用户</label>
					<input type="text" id="loginUsername"  name="loginUsername"  placeholder="请输入你的用户名">
				 <?php
				echo $account->getError(Constants::$loginFailed);
				 ?>
			</p>

			<p>
					<label for="loginPassword">密码</label>
					<input type="password" id="loginPassword"  name="loginPassword"  placeholder="请输入你的密码">
			</p>

			<p>
					<button type="submit" name="loginButton">登陆</button>
			</p>
			<div class="hasAccountText"><span id="hideLogin">没有账户？请注册</span></div>
	</form>

	<form action="register.php" id="registerForm"  method="POST" accept-charset="utf-8">
			<h2>注册你的新账户</h2>
			<p>
					<label for="username">用户</label>
					<input type="text" id="username"  name="username"  placeholder="请输入你的用户名" value="<?php getInputValue('username')?>" required>
			<?php
				echo $account->getError(Constants::$usernameCharacters);
			?>
			</p>

			<p>
					<label for="name">名字</label>
					<input type="text" id="name"  name="name"  placeholder="请输入你的真实姓名" value="<?php getInputValue('name')?>" required>
			<?php
				echo $account->getError(Constants::$nameCharacters);
			?>
			<?php
				echo $account->getError(Constants::$usernameTaken);
			?>
			</p>
			<p>
					<label for="email">邮箱</label>
					<input type="text" id="email"  name="email"  placeholder="请输入你的邮箱地址" value="<?php getInputValue('email')?>" required>
			<?php
				echo $account->getError(Constants::$emailInvalid);
			?>
			<?php
				echo $account->getError(Constants::$emailTaken);
			?>
			</p>

			<p>
					<label for="password">密码</label>
					<input type="password" id="password"  name="password"  placeholder="请输入你的密码" required>
			<?php
				echo $account->getError(Constants::$passwordNotMatch);
			?>
			<?php
				echo $account->getError(Constants::$passwordWithNumAndLetter);
			?>
			<?php
				echo $account->getError(Constants::$passwordCharacters);
			?>
			</p>
			<p>
			
					<label for="password2">确认密码</label>
					<input type="password" id="password2"  name="password2"  placeholder="请确认你的密码" required>
			</p>
			<div>
					<button type="submit" name="registerButton">注册</button>
			</div>
			<div class="hasAccountText"><span id="hideRegister">已有账户？请登录</span></div>
	</form>
	</div>
	<div id="loginText">
		<h1>听属于自己的音乐</h1>
		<h2>在属于自己的世界</h2>
		<ul>
			<li>在音乐的世界里沉溺！</li>
			<li>创建自己的音乐列表！</li>
			<li>跟随自己喜爱的歌手！</li>	
		</ul>
	</div>
	</div>
</div>
</body>
</html>