<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['codecateg']."' class='append_items'>".$row['libcateg']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>