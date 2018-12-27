<?php
function  sanitizeFormUsername($inputText){
    $inputText=strip_tags($inputText);
    $inputText=str_replace("","",$inputText);
    return $inputText;
}

function  sanitizeFormString($inputText){
    $inputText=strip_tags($inputText);
    $inputText=str_replace("","",$inputText);
    $inputText=ucfirst(strtolower($inputText));
    return $inputText;
}

function  sanitizeFormPassword($inputText){
    $inputText=strip_tags($inputText);
    return $inputText;
}


if(isset($_POST["registerButton"])){
    $username=sanitizeFormUsername($_POST["username"]);

    $name=sanitizeFormString($_POST["name"]);

    $email=sanitizeFormString($_POST["email"]);

    $password=sanitizeFormPassword($_POST["password"]);

    $password2=sanitizeFormPassword($_POST["password2"]);
	
	$isSuccessful=$account->register($username,$name,$email,$password,$password2);

	if($isSuccessful){
		$_SESSION["userLoggedIn"]=$username;
		header("Location:index.php");
	}
}
?>
