<?php 
	include 'includes/session.php';

	if(isset($_POST['codecateg'])){
		$id = $_POST['codecateg'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM category WHERE codecateg=:codecateg");
		$stmt->execute(['codecateg'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>