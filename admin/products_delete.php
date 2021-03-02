<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['codeArt'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM article WHERE codeArt=:codeArt");
			$stmt->execute(['codeArt'=>$id]);

			$_SESSION['success'] = 'Suppression d\'articles réussie';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Selectionner le premier article à supprimer';
	}

	header('location: products.php');
	
?>