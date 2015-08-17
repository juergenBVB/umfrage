<?php 
include 'datenbankconnect.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Ihre Eingabe wird geprüft</title>
		
	</head>

	<body>
		<div>
			<header>
				<h1>Deine eingegebene Matrikelnummer wird geprueft</h1>
			</header>
		</div>
	</body>
	
	
	
	
	<?php
	$mnr = $_POST['mnr_student']; 
	$result = mysqli_query($con, "SELECT mnr from student where mnr='student.mnr');
		
	
	while ($row = mysqli_fetch_assoc($result))	
	{
		;
		
	} 
	mysqli_close($con);
	
	?>
	
	
</html>
