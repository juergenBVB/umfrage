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
		$fid=$fid-1;
	}
	
	if ($_GET['button'] == "Zum Kommentar")
	{
		mysqli_query($con, "insert into beantwortet values ('$mnr','$fid', '$bewertung')");
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
<?php if ($_GET['button']!= "Zum Kommentar"){
echo '<table border="1">';
echo '<tr><td>Fragenummer</td>';
echo '<td>Frage</td>';
echo '</tr>';

if(!isset($fid))
		{ $sql= mysqli_query($con, "SELECT fid, fname
								FROM frage f, darfbearbeiten dbf, Student s
								WHERE f.titel = dbf.titel
								AND s.kname = dbf.kname
								AND s.mnr = '$mnr' and f.titel='$titel'
								ORDER BY f.fid");
		
		$sql2 =mysqli_query($con, "SELECT Max(fid) as maxfid, Min(fid) as minfid
								FROM frage f, darfbearbeiten dbf, Student s
								WHERE f.titel = dbf.titel
								AND s.kname = dbf.kname
								AND s.mnr = '$mnr' and f.titel='$titel'
								ORDER BY f.fid");
		}
		else 
		{
			$sql= mysqli_query($con, "SELECT fid, fname
					FROM frage f, darfbearbeiten dbf, Student s
					WHERE f.titel = dbf.titel
					AND s.kname = dbf.kname AND f.fid='$fid'
					AND s.mnr = '$mnr' and f.titel='$titel'
					order by f.fid");
			
			$sql2 =mysqli_query($con, "SELECT Max(fid) as maxfid, Min(fid) as minfid
					FROM frage f, darfbearbeiten dbf, Student s
					WHERE f.titel = dbf.titel
					AND s.kname = dbf.kname
					AND s.mnr = '$mnr' and f.titel='$titel'
					ORDER BY f.fid");
		}
		$row = mysqli_fetch_assoc($sql);
		$row2 =mysqli_fetch_assoc($sql2);
			
		echo '<tr>';
		echo "<td>", $row['fid'], "</td>";
		echo "<td>", $row['fname'], "</td>";
		echo "</tr>	";
		
		echo "</table> <br/> <br/>";

echo '<form name="seitenwechsel" action="fragebogenausfuellen.php" method="get">';

echo '<input type="radio" name="bewertung" id ="5" value="5"/><label for="5"> 5</label>';
echo '<input type="radio" name="bewertung" id ="4" value="4"/><label for="4"> 4</label>';
echo '<input type="radio" name="bewertung" id ="3" value="3"/><label for="3"> 3</label>';
echo '<input type="radio" name="bewertung" id ="2" value="2"/><label for="2"> 2</label>';
echo '<input type="radio" name="bewertung" id ="1" value="1"/><label for="1"> 1</label>';
echo '<br/><br/>';
echo '<input name="fid" type="hidden" value="'. $row['fid'].'"/>';
 	if ($fid!=$row2['minfid']and isset($fid)){
			echo'<input name="button" type="submit" value="zurueck"/>';}
			
		if ($fid!=$row2['maxfid']){ 
			echo '<input name="button" type="submit" value="weiter"/>';}
			
		if ($fid==$row2['maxfid']) { 
			echo '<input name="button" type="submit" value="Zum Kommentar"/>';}


echo "</form>";}

if($_GET['button']=="Zum Kommentar"){
	echo "<h2>Was möchten Sie sonst noch zur Frage sagen?</h2>";
	echo '<form name="kommentar_speichern" action="fragebogenuebersicht.php" method="post">';
	echo '<textarea name="kommentarfeld" rows="5" cols="60"></textarea>';
	echo '<br/> <input name="button" type="submit" value="Speichern"/>';
	echo '</form>';
	
}

?>
</body>

</html>