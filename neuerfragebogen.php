<?php 
session_start();
include 'datenbankconnect.php';
?>
<html>
<head>
<link rel="stylesheet" href="style/neuerfragebogen.css" type="text/css">
</head>
<body>
<h1>Neuer Fragebogen</h1>


<?php 
if ((!isset($_GET['action'])) OR ($_GET['action'] == 0)){
?>
<form action="neuerfragebogen.php?action=1" method="post">
<table>
<tr><td><label>Fragebogentitel: </label></td><td><input type="text" name="fragebogentitel" size="40"></td></tr>
<tr><td><label>Anzahl Fragen: </label></td><td><input type="number" name="anzahlfragen" size="4" min="0"></td></tr>
<tr><td><input type="submit" value="Speichern"></td><td></td></tr>
</form>
</table>
<?php 
} elseif ($_GET['action'] == 1){
	
	echo "<p> Fragen eingeben: </p>";
	
	$anzahlfragen = $_POST['anzahlfragen'];
	$_SESSION['fragebogen'] = $_POST['fragebogentitel'];

	echo "<form action='neuerfragebogen.php?action=2' method='post'><table>";
	for ($i = 1; $i <= $anzahlfragen; $i++){
		echo "<tr><td>Frage $i:</td><td><input type='text' size='60' name='frage[]' value=''></td></tr>";	
	}
	echo "</table><br><input type='submit' value='Speichern'>";
	echo "</form>";
}
elseif ($_GET['action'] == 2){
	$fragen = $_POST['frage'];
	mysqli_query($con, "INSERT INTO fragebogen VALUES ('".$_SESSION['fragebogen']."', '".$_SESSION['benutzername']."')");
	echo "Fragebogen ".$_SESSION['fragebogen']." wurde erfolgreich gespeichert.";	
	foreach ($fragen as $frage){
		//In Datenbank schreiben
		mysqli_query($con, "INSERT INTO frage (fname, titel) VALUES ('$frage', '".$_SESSION['fragebogen']."')");	
		
	}	
	echo "<br><a href='erfasserubersicht.php'>Zurück zur Übersicht</>";
}
?>


</body>
</html>