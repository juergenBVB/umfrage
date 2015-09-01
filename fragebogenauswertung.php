<?php 
session_start();
include 'datenbankconnect.php';
include 'auswertung.cl.php';
?>
<html>
<head>
<title>Auswertung</title>
</head>
<body>
<h1>Fragebogen auswerten</h1>
<?php 
	if ((!isset($_GET['action'])) OR ($_GET['action'] == 0)){		
	
		$_SESSION['fragebogen'] = $_POST['fragebogentitel'];
		echo "Fragebogen: ".$_SESSION['fragebogen']."<br>";
		$sql = mysqli_query($con, "SELECT kname FROM darfbearbeiten WHERE titel = '".$_SESSION['fragebogen']."'");
		
		echo "<form action='fragebogenauswertung.php?action=1' method='post'>";
		while ($row = mysqli_fetch_assoc($sql)){
		?>
		<input type="radio" name="kurs" value="<?php echo $row['kname'];?>"> <?php echo $row['kname'];?><br>
		<?php 	
			
		}
		echo "<input type='submit' value='Auswählen'></form>";
	}
	elseif ($_GET['action'] == 1){
		$auswertung = new Auswertung($_SESSION['fragebogen'], $_POST['kurs']);
		
		?>
		<table border="1"><tr><th>Frage</th><th>Durchschnitt</th><th>Minimum</th><th>Maximum</th><th>Standardabweichung</th></tr>
		<?php 
		
		foreach($auswertung->auswertung as $key => $value){
			
			$sql = mysqli_query($con, "SELECT fname FROM frage WHERE fid='$key'");
			if ($row = mysqli_fetch_assoc($sql)){
				echo "<tr><td>".$row['fname']."</td>";
			}
			
			
			echo "<td>".$value[0]."</td>";
			echo "<td>".$value[1]."</td>";
			echo "<td>".$value[2]."</td>";
			echo "<td>".$value[3]."</td>";
		}
		?>
		</table>
		<br>Kommentare: <br>
		<?php 
		echo $auswertung->getKommentare();
	}
	
	
?>
<br><a href="erfasserubersicht.php">Zuück zur Übersicht</a>
</body>
</html>