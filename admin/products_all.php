<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM article");
	$stmt->execute();
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['codeArt']."' class='append_items'>".$row['libelArt']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>