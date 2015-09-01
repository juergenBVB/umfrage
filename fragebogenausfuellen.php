<?php
session_start();
include 'datenbankconnect.php';
$mnr = $_SESSION['mnr'];
$titel= $_POST['fragebogentitel'];
$i=1;
?>
<html>
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style/erfasserubersicht.css" type="text/css">

		<title>Fragebogen <?php echo $titel;?> bearbeiten</title>
</head>
<body>

<header>
<h1>Fragebogen <?php echo $titel;?> bearbeiten</h1>
</header>
<table border="1">
<tr><td>Fragenummer</td>
<td>Frage</td>
<td>bewerten</td>
</tr>
<?php $sql= mysqli_query($con, "SELECT fid, fname
								FROM frage f, darfbearbeiten dbf, Student s
								WHERE f.titel = dbf.titel
								AND s.kname = dbf.kname
								AND s.mnr = '$mnr' and f.titel='$titel'");
		while($row = mysqli_fetch_assoc($sql))
		{
			?>
			<tr>
			<td> <?php echo $i;?></td>
			<td> <?php echo $row['fname']?></td>
			<td> <form action="fragebewerten.php" method="post">
						<input type="hidden" name="frage" value="<?php echo $row['fname'];?>">
						<input name="buttons" type="submit" value="Bewerten"/>
					
					 </form></td>
					 </tr>
			<?php $i++;
		}
		?>

</table>
</body>




</html>