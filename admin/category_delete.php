<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['codecateg'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM category WHERE codecateg=:codecateg");
			$stmt->execute(['codecateg'=>$id]);

			$_SESSION['success'] = 'Categorie supprimée avec succès';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Selectionner categorie à supprimer';
	}

	header('location: category.php');
	
?>