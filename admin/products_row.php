<?php 
	include 'includes/session.php';

	if(isset($_POST['codeArt'])){
		$id = $_POST['codeArt'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, article.codeArt AS prodid, article.libelArt AS prodname, codeSousFamille.libelSousFamille AS catname FROM article LEFT JOIN sous_famille ON sous_famille.codeSousFamille=article.codeSousFamille WHERE article.codeArt=:codeArt");
		$stmt->execute(['codeArt'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>