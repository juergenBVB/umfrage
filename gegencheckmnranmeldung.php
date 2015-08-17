<?php session_start(); 
include 'datenbankconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Ihre Eingabe wird geprüft</title>
		
	</head>

	<body>
	
	<?php
	$mnr = $_POST['mnr_student']; 
	$result = mysqli_query($con, "SELECT mnr from student where mnr='$mnr'");
		
	
	while ($row = mysqli_fetch_assoc($result))	
	{
		if ($row['mnr']==$mnr){
			echo '<h1>Studentenanmeldung erfolgreich</h1> <br><br>
			MNR vorhanden
			<a href=fragebogenuebersicht.php> <h3> Zur Fragenbogenuebersicht </h3> </a>';
			$_SESSION ["mnr"]=$mnr;
		}
		else 
		{
			echo 'MNR nicht vorhanden. Bitte versuchen Sie es erneut <br>
			<a href=anmeldemaske.php> <h3> Zurück zur Anmeldemaske </h3>';
		}
		
	} 
	mysqli_close($con);
	
	?>
	</body>
	
	
</html>
