<?php 
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="style/erfasserubersicht.css" type="text/css">
</head>
<body>
<!-- Fragebogenübersicht -->
<h1>Fragebogenübersicht</h1>

<a href="neuerfragebogen.php">Neuer Fragebogen</a>
<br><br>
<table border="1" rules="">
  <tr>
    <th>Fragebogentitel</th>
    <th>bearbeiten</th>
    <th>kopieren</th>
    <th>auswerten</th>
    <th>bearbeitende Kurse</th>
    
  </tr>
  
<!-- Loop über Fragebögen -->
  <?php
  include 'datenbankconnect.php';
  $erfasser = $_SESSION['benutzername']; 
  $sql = mysqli_query($con,  "SELECT * FROM fragebogen WHERE benutzername='$erfasser'");
  //echo mysqli_num_rows($sql);
  while($row = mysqli_fetch_assoc($sql)){
  
  ?>
  
  <tr style="valign: middle;">
    <td><?php echo $row['titel'];?></td>
    <td>
    	<form action="fragebogenbearbeiten.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="<?php echo $row['titel'];?>">    
    	<input type="submit" value="bearbeiten">
    	</form>
    </td>
    <td>
    	<form action="erfasserubersicht.php" method="post" style="vertical-align: middle;">
    	<input type="hidden" name="fragebogentitel" value="<?php echo $row['titel'];?>">    
    	<input type="submit" value="kopieren" >
    	</form>
    </td>
    <td>
    	<form action="fragebogenauswertung.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="<?php echo $row['titel'];?>">    
    	<input type="submit" value="auswerten">
    	</form>
    </td>
    <td>
    	<?php 
    	$kurse = mysqli_query($con, "SELECT kname FROM darfbearbeiten WHERE titel='".$row['titel']."'");
    	while($kurs = mysqli_fetch_assoc($kurse)){
			echo $kurs['kname']."<br/>";
    	}
    	?>
    	<br>
    	<form action="kursfreigeben.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="<?php echo $row['titel'];?>">    
    	<input type="submit" value="Kurse freigeben">
    	</form>
    </td>
  </tr>
  
  <?php 
  }
  ?>
<!-- Ende Loop -->  
  
</table>
</body>
</html>