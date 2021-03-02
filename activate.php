<?php include 'includes/session.php'; ?>
<?php
	$output = '';
	if(!isset($_GET['code']) OR !isset($_GET['user'])){
		$output .= '
			<div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Erreur!</h4>
                Le code d\'activation du compte est introuvable.
            </div>
            <h4>Vous pouvez vous<a href="signup.php">Inscrire</a> ou revenir à la <a href="index.php">pade d\'Accueil</a>.</h4>
		'; 
	}
	else{
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code=:code AND id=:id");
		$stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			if($row['status']){
				$output .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Erreur!</h4>
		                Compte déjà activé.
		            </div>
		            <h4>Vous pouvez vous <a href="login.php">Identifier</a> ou revenir à la <a href="index.php">page d\'Accueil</a>.</h4>
				';
			}
			else{
				try{
					$stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
					$stmt->execute(['status'=>1, 'id'=>$row['id']]);
					$output .= '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Succès!</h4>
			               Compte Activé - Email: <b>'.$row['email'].'</b>.
			            </div>
			            <h4>Vous pouvez vous <a href="login.php">Identifier</a>ou revenir à la<a href="index.php">page d\'Accueil</a>.</h4>
					';
				}
				catch(PDOException $e){
					$output .= '
						<div class="alert alert-danger">
			                <h4><i class="icon fa fa-warning"></i> Erreur!</h4>
			                '.$e->getMessage().'
			            </div>
			            <h4>Vous pouvez vous<a href="signup.php">Inscrire</a> ou revenir à la<a href="index.php">page d\'Accueil</a>.</h4>
					';
				}

			}
			
		}
		else{
			$output .= '
				<div class="alert alert-danger">
	                <h4><i class="icon fa fa-warning"></i> Erreur!</h4>
	               Impossible d\'activer le compte. Code erronés.
	            </div>
	            <h4>Vous pouvez vous <a href="signup.php">Inscrire</a> ou revenir à la<a href="index.php">page d\'Accueil</a>.</h4>
			';
		}

		$pdo->close();
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php echo $output; ?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>