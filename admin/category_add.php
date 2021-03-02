
<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['libcateg'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE libcateg=:libcateg");
		$stmt->execute(['libcateg'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'La categorie existe déjà';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO category (libcateg) VALUES (:libcateg)");
				$stmt->execute(['libcateg'=>$name]);
				$_SESSION['success'] = 'Categorie ajoutée avec succès';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Remplir d\'abord le formulaire de catégorie';
	}

	header('location: category.php');

?>