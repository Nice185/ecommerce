<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body>
<div class="hold-transition login-page">

<div class="login-box">
  <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
    <h3>CONNEXION</h3>

  	<div class="login-box-body">
    	<p class="login-box-msg">Connectez-vous pour démarrer votre session</p></br>

    	<form action="verify.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div></br>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div></br>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-sm pull-left" name="login"><i class="fa fa-sign-in"></i> Se connecter</button>
            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <button type="reset" class="btn btn-primary btn-sm " name="to cancel"> Annuler</button>
      		</div>
      </form>
      </br></br>
    <ul>
      <a href="signup.php" class="text-center"><i class="fa fa-hand-o-right"></i> Inscrivez-vous</a></br></br>
      <a href="index.php"><i class="fa fa-home"></i> Accueil</a>
      </ul>
   </div>
</div>
</div>	
<?php include 'includes/scripts.php' ?>
</body>
</html>