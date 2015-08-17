<?php 
session_start();
include 'datenbankconnect.php';
?>
<html>
<head>
</head>
<body>
<h1>Kurs freigeben</h1>
<?php 

if (!isset($_GET['action'])){
	$_SESSION['fragebogen'] = $_POST['fragebogentitel'];
	$fragebogen = $_SESSION['fragebogen'];
	
	echo "Fragebogen: $fragebogen<br><br>";
	echo "<form action='kursfreigeben.php?action=1' method='post'>";
	
	$sql = mysqli_query($con, "SELECT kname FROM kurs");
	while($row = mysqli_fetch_assoc($sql)){
		
		$kname = $row['kname'];
		$sql2 = mysqli_query($con, "SELECT * FROM darfbearbeiten WHERE titel='$fragebogen' AND kname='$kname'");
		$anzahl = mysqli_num_rows($sql2);
		$checked = $anzahl > 0;
		
		echo "<input type='checkbox' name='kurs[]' value='$kname'";
		if ($checked){
			echo " checked";
		}
		echo ">$kname<br/>";
	}	
	

echo '<input type="submit" value="Kurse freigeben"></form>';
}
elseif ($_GET['action'] == 1){
	$fragebogen = $_SESSION['fragebogen'];
	$kurse = $_POST['kurs'];
	mysqli_query($con, "DELETE FROM darfbearbeiten WHERE titel='$fragebogen'");
	
	foreach ($kurse as $kurs){
		mysqli_query($con, "INSERT INTO darfbearbeiten VALUES ('$kurs', '$fragebogen')");
	}
	echo "Kurse erfolgreich freigegeben.<br><a href='erfasserubersicht.php'>Zurück zur Übersicht</a>";
}

?>

</body>
</html>