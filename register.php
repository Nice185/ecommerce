<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';
	if(isset($_POST['firstname'])&&$_POST['firstname']!=""){
		$connect = mysqli_connect("localhost", "root", "", "ecomm1");
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$usertype = $_POST['usertype'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		/*
		if(!isset($_SESSION['captcha'])){
			require('recaptcha/src/autoload.php');		
			$recaptcha = new \ReCaptcha\ReCaptcha('6LevO1IUAAAAAFCCiOHERRXjh3VrHa5oywciMKcw', new \ReCaptcha\RequestMethod\SocketPost());
			$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
			if (!$resp->isSuccess()){
		  		$_SESSION['error'] = 'Please answer recaptcha correctly';
		  		header('location: signup.php');	
		  		exit();	
		  	}	
		  	else{
		  		$_SESSION['captcha'] = time() + (10*60);
		  	}
		}*/

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
		}else{
			$query = " SELECT count(*) as nb FROM users WHERE email='".$email."'
			";
			$result=mysqli_query($connect, $query);
			$row = mysqli_fetch_array($result);
			if($row['nb']>0)
			{
				$_SESSION['error'] = 'Mail déjà utilisé';
				header('location: signup.php');
			}else
			{
				$query = "INSERT INTO users(email,password,type,firstname,lastname,status)
				VALUES ('".$email."','".md5($password)."',$usertype,'".$firstname."','".$lastname."',1)";
				$result=mysqli_query($connect, $query);
				if($result) $_SESSION['error'] = 'Insertion effectuée avec succès';
				else  $_SESSION['error'] = 'Dja legba';
				header('location: signup.php');
				
			}
		}
	}else{
		$_SESSION['error'] = 'Fill up signup form first';
		var_dump("Dieu est Grand");
		//$_SESSION['error']=$_POST['firstname'];
		header('location: signup.php');
	}

?>