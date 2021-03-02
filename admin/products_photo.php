<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['codeArt'];
		$filename = $_FILES['photo']['name'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM article WHERE codeArt=:codeArt");
		$stmt->execute(['codeArt'=>$id]);
		$row = $stmt->fetch();

		if(!empty($filename)){
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$new_filename = $row['slug'].'_'.time().'.'.$ext;
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
		}
		
		try{
			$stmt = $conn->prepare("UPDATE article SET photo=:photo WHERE codeArt=:codeArt");
			$stmt->execute(['photo'=>$new_filename, 'codeArt'=>$id]);
			$_SESSION['success'] = 'Photo de l\'article mise à jour avec succès';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Selectionner photo de l\'article à mettre à jour';
	}

	header('location: products.php');
?>