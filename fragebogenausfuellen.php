<?php
session_start();
include 'datenbankconnect.php';
$mnr = $_SESSION['mnr'];

$titel= $_SESSION['fragebogentitel'];

if ($_POST['buttons']=="Bearbeiten")
{
$titel= $_POST['fragebogentitel'];
$_SESSION ["fragebogentitel"]=$titel;
}
$bewertung= $_GET['bewertung'];

$i=1;

$fid;
$fid= $_GET['fid'];

	if ($_GET['button'] == "weiter")
	{
		mysqli_query($con, "insert into beantwortet values ('$mnr','$fid', '$bewertung')");
		$fid++;
	}	
	elseif ($_GET['button'] == "zurueck")
	{
		$fid-1;
	}

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
</tr>
<?php

if(!isset($fid))
		{ $sql= mysqli_query($con, "SELECT fid, fname
								FROM frage f, darfbearbeiten dbf, Student s
								WHERE f.titel = dbf.titel
								AND s.kname = dbf.kname
								AND s.mnr = '$mnr' and f.titel='$titel'");
		}
		else 
		{
			$sql= mysqli_query($con, "SELECT fid, fname
					FROM frage f, darfbearbeiten dbf, Student s
					WHERE f.titel = dbf.titel
					AND s.kname = dbf.kname AND f.fid='$fid'
					AND s.mnr = '$mnr' and f.titel='$titel'");
		}
		$row = mysqli_fetch_assoc($sql);
		
			?>
			<tr>
			<td> <?php echo $row['fid'];?></td>
			<td> <?php echo $row['fname'];?></td>
					 </tr>	
		


</table>

<br/>
<br/>
<form name="seitenwechsel" action="fragebogenausfuellen.php" method="get">

<input type="radio" name="bewertung" id ="5" value="5"/><label for="5"> 5</label>
<input type="radio" name="bewertung" id ="4" value="4"/><label for="4"> 4</label>
<input type="radio" name="bewertung" id ="3" value="3"/><label for="3"> 3</label>
<input type="radio" name="bewertung" id ="2" value="2"/><label for="2"> 2</label>
<input type="radio" name="bewertung" id ="1" value="1"/><label for="1"> 1</label>
<br/><br/>
<input name="button" type="submit" value="zurueck"/>
<input name="button" type="submit" value="weiter"/>
<input name="fid" type="hidden" value="<?php echo $row['fid'];?>"/>



</form>

</body>




</html>