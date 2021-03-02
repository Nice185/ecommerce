<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	  
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
			<div class="row">
				<div class="col-sm-12">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="data1/images/banner1.jpg" alt="banner1" title="banner1" id="wows1_0"/></li>
		<li><a href="http://wowslider.net"><img src="data1/images/banner2.jpg" alt="wow slider" title="banner2" id="wows1_1"/></a></li>
		<li><img src="data1/images/banner3.jpg" alt="banner3" title="banner3" id="wows1_2"/></li>
	</ul></div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
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
					<br/>
					<br/>
					<br/>
						<div class="row">

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
             <a href="#"><img class="card-img-top" src="images/az.jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Chemise Homme</a>
                </h4>
                <h5>$22.99</h5>
                <p class="card-text"><p class="card-text">Chemise Homme Fleurie.Manche longue.
				Chemise Homme Manche Longue en coton.</p>
                <p><strong>Taille:</strong>Grande Taille</p>
				 <p><strong>Marque:</strong>YANGFAN</p></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="images/blazer.jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Blazer</a>
                </h4>
                <h5>$13.96</h5>
                <p class="card-text"><p>Cet article est de type asiatique.Assortie et posée pour vos réunions professionnelles.</p>
				<p><strong>Taille:</strong>xl</p>
				 <p><strong>Marque:</strong>ZARA</p>
               </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="images/veste.jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Veste Col Etroit</a>
                </h4>
                <h5>$22.99</h5>
                <p class="card-text">Veste de costume,veste homme à col etroit,veste assortie pour vos réunions,vos services 
				professionnels.</p>
				<p><strong>Taille:</strong>xl</p>
				 <p><strong>Marque:</strong>ZARA</p>
              </div>
            </div>
          </div>
		  <br/>
		  <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="images/vin.jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Trio Vin Rouge</a>
                </h4>
                <h5>$29.90</h5>
                <p class="card-text">Offrez à vos proches un voyage à travers l'univers du vin italien! Pour votre dégustation
				voici notre sélection de trois vins phares livrés dans leurs emballages.</p>
				<p><strong>Marque:</strong>Primitivo,Pietronello,Nero d'Avola</p>
              </div>
            </div>
          </div>
		  <br/>
		 
		  
		  <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
               <a href="#"><img class="card-img-top" src="images/riz (2).jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Riz</a>
                </h4>
                <h5>$29.45</h5>
                <p class="card-text">Riz long parfumé RIZ DU MONDE:le sac de 20kg à retrouver en drive ou livraison au même prix
				qu'en magasin.</p>
              </div>
			  <br/>
			  
				<p><strong>Quantité:</strong>20kg</p><p><strong>Marque:</strong>RIZ DU MONDE</p>
				 
              
            </div>
          </div>
          <br/>
		  <br/>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
               <a href="#"><img class="card-img-top" src="images/boisson.jpg"style="width:250px;height:150px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Boissons</a>
                </h4>
                <h5>$20</h5>
                <p class="card-text">Quelques boissons disponibles en cartons de 12,24 et 60 chez nous.</p>
				<br/>
			  <br/>
			  <br/>
			  <br/>
				 <p><strong>Marque:</strong>Diverses</p>
				  </div>
			  
            </div>
          </div>

						
					<?php } ?>
	        	</div>
	        	
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script src="vendor1/jquery/jquery.min.js"></script>
  <script src="vendor1/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>