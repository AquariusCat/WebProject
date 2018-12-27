<?php
	class Account{
		private $errorArray;
		private $con;
		public function __construct($conn){
			$this->con=$conn;
			$this->errorArray=array();
		}
		public function login($username,$password){
			$password=md5($password);
			$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
			$query=mysqli_query($this->con,$sql);
			if(mysqli_num_rows($query)==1){
				return true;
			}else{
				array_push($this->errorArray,Constants::$loginFailed);
				return false;
			}
		}
		
		//给外部提供的一个公共方法
		public function register($username,$name,$email,$password,$password2){
			$this->validateUsername($username);
			$this->validateName($name);
			$this->validateEmail($email);
			$this->validatePassword($password,$password2);
			
			if(empty($this->errorArray)==true){
				//将得到的数据插入到数据库中
				return $this->insertUserDetails($username,$name,$email,$password,$password2);
			}else{
				return false;
			}
		}
		public function insertUserDetails($username,$name,$email,$password){
			$password=md5($password);
			$profilePic="assets/images/profile-pics/header.jpg";
			$date=date("Y-m-d G:i:s");
			$sql="INSERT INTO users VALUES('','$username','$name','$email','$password','$date','$profilePic')";
			$result=mysqli_query($this->con,$sql);
			return $result;
			
		}
		 
		//获取错误信息
		public function getError($error){
			if(!in_array($error,$this->errorArray)){
				$error="";
			}
			return "<span class='errorMessage'>$error</span>";
		}
		
		//验证用户名长度等信息
		private function validateUsername($un){
			if(strlen($un)>25||strlen($un)<5){
				array_push($this->errorArray,Constants::$usernameCharacters);
				return;
			}
			//TODO:检查用户名是否存在
			$sql="SELECT username FROM users WHERE username='$un'";
			$checkUsername=mysqli_query($this->con,$sql);
			if(mysqli_num_rows($checkUsername)!=0){
				array_push($this->errorArray,Constants::$usernameTaken);
				return;
			}
		}
		//验证名字长度等信息
		private function validateName($nm){
			if(strlen($nm)>25||strlen($nm)<2){
				array_push($this->errorArray,Constants::$nameCharacters);
				return;
			}
		}
		//验证邮箱等信息
		private function validateEmail($em){
			if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
				array_push($this->errorArray,Constants::$emailInvalid);
				return;
			}
			//TODO:检查邮箱是否存在
			$sql="SELECT email FROM users WHERE email='$em'";
			$checkEmail=mysqli_query($this->con,$sql);
			if(mysqli_num_rows($checkEmail)!=0){
				array_push($this->errorArray,Constants::$emailTaken);
				return;
			}
		}
		//验证密码等信息
		private function validatePassword($pw,$pw2){
			if($pw!=$pw2){
				array_push($this->errorArray,Constants::$passwordNotMatch);
				return;
			}
			if(preg_match('/[^A-Za-z0-9]/',$pw)){
				array_push($this->errorArray,Constants::$passwordWithNumAndLetter);
				return;
			}
			if(strlen($pw)>25||strlen($pw)<5){
				array_push($this->errorArray,Constants::$passwordCharacters);
				return;
			}
		}
	}
?>