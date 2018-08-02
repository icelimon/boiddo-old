<?php
	session_start();
	$_SESSION = array();
	if(isset($_COOKIE['id']) || isset($_COOKIE['user']) || isset($_COOKIE['mail']) || isset($_COOKIE['pass'])){
		setcookie("id",'',strtotime('-5 days'),'/');
		setcookie("user",'',strtotime('-5 days'),'/');
		setcookie("mail",'',strtotime('-5 days'),'/');
		setcookie("pass",'',strtotime('-5 days'),'/');
		setcookie("cat",'',strtotime('-5 days'),'/');
	}

	if(isset($_COOKIE[regconfname])){
		setcookie('regconfname', "", strtotime('-5 days'));
	}
	if(isset($_COOKIE[regconfemail])){
		setcookie('regconfemail', "", strtotime('-5 days'));
	}
	if(isset($_COOKIE[regconfcat])){
		setcookie('regconfcat', "", strtotime('-5 days'));
	}
	if(isset($_COOKIE[comcode])){
		setcookie('comcode', "", strtotime('-5 days'));
	}
	session_destroy();
    
    
	if(isset($_SESSION['username'])){
		header("location: message.php?msg= Error:_Logout_Field");
	}else{
		header("location: index.php");
		exit();
	}
?>