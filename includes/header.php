<?php
	$connect = mysqli_connect("localhost", "root", "", "ecomm1");
	$query_cat = "
 SELECT * FROM category
";
$result_cat= mysqli_query($connect, $query_cat);



?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Ecommerce Site using PHP</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<!--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">-->
    <!-- Magnify -->
    <link rel="stylesheet" href="magnify/magnify.min.css">
	
     <link rel="stylesheet" type="text/css" href="assets/css/style.css" /> 
     <link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Paypal Express -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <!-- Google Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

  	<!-- Custom CSS -->
    <style type="text/css">
    /* Small devices (tablets, 768px and up) */
    @media (min-width: 768px){ 
      #navbar-Recherche-input{ 
        width: 60px; 
      }
      #navbar-Recherche-input:focus{ 
        width: 100px; 
      }
    }

    /* Medium devices (desktops, 992px and up) */
    @media (min-width: 992px){ 
      #navbar-Recherche-input{ 
        width: 150px; 
      }
      #navbar-Recherche-input:focus{ 
        width: 250px; 
      } 
    }

    .word-wrap{
      overflow-wrap: break-word;
    }
    .prod-body{
      height:300px;
    }

    .box:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .register-box{
      margin-top:20px;
    }

    #trending{
      list-style: none;
      padding:10px 5px 10px 15px;
    }
    #trending li {
      padding-left: 1.3em;
    }
    #trending li:before {
      content: "\f046";
      font-family: FontAwesome;
      display: inline-block;
      margin-left: -1.3em; 
      width: 1.3em;
    }

    /*Magnify*/
    .magnify > .magnify-lens {
      width: 100px;
      height: 100px;
    }
    body{background-image:url('images/fond2.jpg');
      margin:0 auto;
       background-repeat:no-repeat;
      background-attachment: fixed;
      background-size:cover;
      font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
      font-weight:400;overflow-x:hidden;
      overflow-y:auto}
      h3{text-align:center;font-size:x-large;font-weight:bold;font-family:'Source Sans Pro',sans-serif;color:blue}
      a{color:rgb(128,64,64)}
      .navbar a{
        color:white

      }
      .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;
        min-width:0;word-wrap:break-word;background-clip:border-box;
        border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}
        .card-body{-ms-flex:1 1 auto;flex:1 1 auto;min-height:1px;padding:1.25rem;}
        
      
    </style>

</head>