<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['libelArt'];
		$slug = slugify($name);
		$category = $_POST['sous_famille'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['libelArt'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM article WHERE slug=:slug");
		$stmt->execute(['slug'=>$slug]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Article existant';
		}
		else{
			if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename = $slug.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
			}
			else{
				$new_filename = '';
			}

			try{
				$stmt = $conn->prepare("INSERT INTO article (codeSousFamille, libelArt, description, slug, price, photo) VALUES (:sous_famille, :libelArt, :description, :slug, :price, :photo)");
				$stmt->execute(['sous_famille'=>$category, 'libelArt'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo'=>$new_filename]);
				$_SESSION['success'] = 'Ajout d\'utilisateur réussi';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Remplir d\'abord le formulaire d\'articles';
	}

	header('location: products.php');

?>