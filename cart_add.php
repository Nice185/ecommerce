<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['codeArt'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['user'])){
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND codeArt=:codeArt");
		$stmt->execute(['user_id'=>$user['id'], 'codeArt'=>$id]);
		$row = $stmt->fetch();
		if($row['numrows'] < 1){
			try{
				$stmt = $conn->prepare("INSERT INTO cart (user_id, codeArt, quantity) VALUES (:user_id, :codeArt, :quantity)");
				$stmt->execute(['user_id'=>$user['id'], 'codeArt'=>$id, 'quantity'=>$quantity]);
				$output['message'] = 'Article ajouté au panier22';
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Article déjà dans le panier';
		}
	}
	else{
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		$exist = array();

		foreach($_SESSION['cart'] as $row){
			array_push($exist, $row['productid']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'Article déjà dans le panier55555';
		}
		else{
			$data['productid'] = $id;
			$data['quantity'] = $quantity;

			if(array_push($_SESSION['cart'], $data)){
				$output['message'] = 'Article ajouté dans le panier8888888';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'Impossible d\'ajouté un article dans le panier';
			}
		}

	}

	$pdo->close();
	echo json_encode($output);

?>