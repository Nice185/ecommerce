<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	  
	    <div class="container">

	      
				
			</div>
	        <div class="row">
				<div class="col-sm-3">
				<?php include 'includes/sidebar.php'; ?>
				</div>
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		
		            
		       		<?php if(isset($_GET['code'])&&$_GET['code']!=""){
						 if(isset($_GET['codecat'])){
							 /* Traitement lié affichage de la catégorie*/
							 $connect = mysqli_connect("localhost", "root", "", "ecomm1");
								$query_cat = '
							 SELECT * FROM category
							 WHERE codecateg="'.$_GET['codecat'].'"
							';
							$result_cat= mysqli_query($connect, $query_cat);
							$row_cat=mysqli_fetch_array($result_cat);
							 echo '<h2>'.$row_cat['libcateg'].'</h2>';
							 
						 }
						 if(isset($_GET['codefam'])){
							 /* Traitement lié affichage de la famille d'article*/
							 echo '<h2>Nos famille d\'article</h2>';
							 
						 }
						 if(isset($_GET['codesfa'])){
							 /* Traitement lié affichage de la sous famille d'article*/
							 echo '<h2>Nos sous familles d\'article</h2>';
						 }
						 if(isset($_GET['codeart'])){
							 /* Traitement lié affichage d'article*/
							
							  /* Traitement lié affichage de la catégorie*/
							  
							 $connect = mysqli_connect("localhost", "root", "", "ecomm1");
							
							$query_art = "
										SELECT * FROM article
										WHERE codeart='".$_GET['codeart']."'
										";
							$result_art= mysqli_query($connect, $query_art);
							$row_art=mysqli_fetch_array($result_art);
							 $query_sfa = "
								 SELECT * FROM sous_famille
								 WHERE codeSousFamille='".$row_art['codeSousFamille']."'
								";
								$result_sfa= mysqli_query($connect, $query_sfa);
								$num_rows_sfa = mysqli_num_rows($result_sfa);
								$row_sfa=mysqli_fetch_array($result_sfa);
								/*  Afficher le titre des articles */
								 echo '<h2>'.$row_sfa['libelSousFamille'].'</h2>';
								 $query_art1 = "
										SELECT * FROM article
										WHERE codeart='".$_GET['codeart']."'
										";
							$result_art1= mysqli_query($connect, $query_art1);
							$row_art1=mysqli_fetch_array($result_art1);
							while($row_art1=mysqli_fetch_array($result_art1))
							{
								/*  Afficher la liste des articles */
								
								
							}
							include 'affiche.php';
						 }
						
						 ?>					
					
					<?php } else {?>
						<h2>Les plus vendus</h2>
					<?php } ?>
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