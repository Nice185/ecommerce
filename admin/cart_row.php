<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN article ON codeArt=cart.codeArt WHERE cart.id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>