<?php session_start(); 
include 'datenbankconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style/erfasserubersicht.css" type="text/css">

		<title>fragebogenuebersicht</title>
		
	</head>

	<body>
		<div>
			<header>
				<h1>Fragebogenuebersicht</h1>
			</header>
			<div>
			<?php 
			$mnr = $_SESSION['mnr'];
			$titel;
				echo '<h2>Sie sind erfolgreich
						 angemeldet als Student: ' . $mnr . '</h2>';
				echo '<h2>Fragebogenauswahl</h2>'; 
			
			if ($_POST['button']=="Speichern")	{
				$sql2=mysqli_query($con, "Insert into kommentar 
						values ('$mnr', '".$_SESSION['fragebogentitel']."', '".$_POST['kommentarfeld']."')");
				$sql3=mysqli_query($con, "Insert into speichert
						values ('$mnr', '".$_SESSION['fragebogentitel']."')");
			}
				
			?>
			<table border="1">
			<tr>
				<td>
				Titel Fragebogen
				</td>
				<td>
				Anzahl Fragen
				</td>
				<td>
				Bearbeiten
				</td>
			</tr>
			<?php 
			$sql=mysqli_query($con, "SELECT dfb.titel, Count(f.fid) AS anzahl_fragen
									FROM darfbearbeiten dfb, student s, frage f
									WHERE dfb.kname = s.kname
									AND f.titel = dfb.titel
									AND s.mnr = '$mnr'
									GROUP BY dfb.titel, s.mnr");
			//echo mysqli_num_rows($sql);
			while ($row = mysqli_fetch_assoc($sql))
			{
	//hier noch checken, ob der bearbeitenbutton �berhaupt angezeigt werden darf
				?>
				<tr style="valign: middle;"> 
				<td><?php echo $row['titel'];?></td>
				<td><?php echo $row['anzahl_fragen'];?></td>
				<td> <form action="fragebogenausfuellen.php" method="post">
						<input type="hidden" name="fragebogentitel" value="<?php echo $row['titel'];?>">
						<input name="buttons" type="submit" value="Bearbeiten"/>
					
					 </form></td>
				</tr>
				
				<?php 
			}
			?>
			
			</table>
			</div>
		</div>
	</body>
</html>
