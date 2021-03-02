<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['codeArt'];
		$name = $_POST['libelArt'];
		$slug = slugify($name);
		$category = $_POST['sous_famille'];
		$price = $_POST['price'];
		$description = $_POST['description'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE article SET libelArt=:libelArt,libelArt=:libelArt, slug=:slug, codeSousFamille=:sous-famille, price=:price, description=:description WHERE codeArt=:codeArt");
			$stmt->execute(['libelArt'=>$name, 'slug'=>$slug, 'sous_famille'=>$category, 'price'=>$price, 'description'=>$description, 'codeArt'=>$id]);
			$_SESSION['success'] = 'Mise à jour de l\'article réussie';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Remplir d\'abord formulaire editer article';
	}

	header('location: products.php');

?>