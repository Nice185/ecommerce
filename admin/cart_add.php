<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$id = $_POST['id'];
		$product = $_POST['product'];
		$quantity = $_POST['quantity'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE codeArt=:id");
		$stmt->execute(['id'=>$product]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Article existant dans le panier';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO cart (user_id, codeArt, quantity) VALUES (:user, :product, :quantity)");
				$stmt->execute(['user'=>$id, 'product'=>$product, 'quantity'=>$quantity]);

				$_SESSION['success'] = 'Article ajouté au panier';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();

		header('location: cart.php?user='.$id);
	}

?>