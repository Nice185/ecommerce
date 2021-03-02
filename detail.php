<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['codeart'];

	try{
		 		
		$stmtart = $conn->prepare("SELECT * FROM article WHERE codeart = :slug");
	    $stmtart->execute(['slug' => $slug]);
		$art = $stmtart->fetch();
		
		$stmtcat = $conn->prepare("SELECT * FROM article WHERE codeSousFamille = :catid");
		$stmtcat->execute(['catid' => $art['codeSousFamille']]);
		$stmtunecat = $conn->prepare("SELECT * FROM sous_famille WHERE codeSousFamille = :catid");
		$stmtunecat->execute(['catid' => $art['codeSousFamille']]);
		$cat = $stmtunecat->fetch();
		
	}
	
	catch(PDOException $e){
		echo "Problème de connexion: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if( $art['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE article SET compteur= compteur+1 WHERE codeArt=:codeArt");
		$stmt->execute(['codeArt'=> $art['codeArt']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE article SET compteur=1, date_view=:now WHERE codeArt=:codeArt");
		$stmt->execute(['codeArt'=> $art['codeArt'], 'now'=>$now]);
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
					<?php foreach ($stmtcat as $article) {?>
		            <div class="row">
		            	<div class="col-sm-6">
							<img src="<?php echo (!empty( $article['photo'])) ? 'images/'. $article['photo'] : 'images/noimage.jpg'; ?>"
							 width="100%" class="zoom" data-magnify-src="images/large-<?php echo  $article['photo']; ?>">
		            		<br><br>
		            		<form class="form-inline" id="productForm">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg">
												<i class="fa fa-minus"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo  $article['codeSousFamille']; ?>" name="codeSousFamille">
							        </div>
			            			<button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
			            		</div>
		            		</form>
		            	</div>
		            	<div class="col-sm-6">
						<h1 class="page-header"><?php echo  $article['libelArt']; ?></h1>
						<h3><b>&#36; <?php echo number_format( $article['price'], 2); ?></b></h3>
						<p><b>Categorie:</b> <a href="category.php?category=<?php echo $cat['codeSousFamille']; ?>"><?php echo  $cat['libelSousFamille']; ?></a></p>
						<p><b>Description:</b></p>
						<p><?php echo  $article['description']; ?></p>
		            	</div>
		            </div>
					<?php } ?>
		            <br>
		<div class="fb-comments" data-href="http://localhost/ecommerce/product.php?product=<?php echo $slug; ?>" data-numposts="10" width="100%"></div> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script>
</body>
</html>