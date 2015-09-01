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
		foreach($auswertung->auswertung as $key => $value){
			
			$sql = mysqli_query($con, "SELECT fname FROM frage WHERE fid='$key'");
			if ($row = mysqli_fetch_assoc($sql)){
				echo "Frage: ".$row['fname']."<br>";
			}
			
			
			echo "Durchschnitt: ".$value[0]."<br>";
			echo "Minimum: ".$value[1]."<br>";
			echo "Maximum: ".$value[2]."<br>";
			echo "Standardabweichung: ".$value[3]."<br><br>";
		}
	}
	
	
?>
<br><a href="erfasserubersicht.php">Zuück zur Übersicht</a>
</body>
</html>