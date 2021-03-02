<?php include 'includes/scripts.php'; ?>
<?php   
   $slug =$_GET['codeart'];
  // $slug="vetement";
	
	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM article WHERE codeart = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['codeSousFamille'];
	}
	catch(PDOException $e){
		echo "Problème de connexion: " . $e->getMessage();
	}

	//page view
	/*
	$now = date('Y-m-d');
	if( $article['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE article SET compteur= compteur+1 WHERE codeArt=:codeArt");
		$stmt->execute(['codeArt'=> $article['codeArt']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE article SET compteur=1, date_view=:now WHERE codeArt=:codeArt");
		$stmt->execute(['codeArt'=> $article['codeArt'], 'now'=>$now]);
	}
	*/
	$pdo->close();	
		$conn = $pdo->open();
		try{
			$inc = 3;	
			$stmt = $conn->prepare("SELECT * FROM article WHERE codeSousFamille = :catid");
			$stmt->execute(['catid' => $catid]);
			//$cat = $stmt->fetch();
			foreach ($stmt as $row) {

				$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
				$inc = ($inc == 3) ? 1 : $inc + 1;
				if($inc == 1) ?>
				
			<div class="callout" id="callout" style="display:none">
				<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
				<span class="message"></span>
			</div>
			<div class='row'>
	
		<div class="col-sm-4" style="text-align:center;">
			<img src="<?php echo $image; ?>"
			 width="100%" class="zoom" data-magnify-src="images/large-<?php echo  $row['photo']; ?>">
			<br><br>
			<form class="form-inline" id="productForm">
				<div class="form-group">
					<a href="product.php?codeart=<?php echo $row['codeArt'];?>" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Commander</a> 
				</div>
			</form>
		</div>
				
	<?php
				
			if($inc == 3) echo "</div>";
			}
			if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
			if($inc == 2) echo "<div class='col-sm-4'></div></div>";
		}
		catch(PDOException $e){
			echo "Problème de connexion: " . $e->getMessage();
		}

		$pdo->close();

	?> 
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