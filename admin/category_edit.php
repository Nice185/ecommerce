<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['codecateg'];
		$name = $_POST['libcateg'];

		try{
			$stmt = $conn->prepare("UPDATE category SET name=:name WHERE codecateg=:codecateg");
			$stmt->execute(['libcateg'=>$name, 'codecateg'=>$id]);
			$_SESSION['success'] = 'Mise à jour de la categorie réussie';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Remplir le premier formulaire éditer de categorie';
	}

	header('location: category.php');

?>