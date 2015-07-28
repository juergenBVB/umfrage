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
  <tr style="valign: middle;">
    <td>Testtitel</td>
    <td>
    	<form action="fragebogenbearbeiten.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="Testtitel">    
    	<input type="submit" value="bearbeiten">
    	</form>
    </td>
    <td>
    	<form action="erfasserubersicht.php" method="post" style="vertical-align: middle;">
    	<input type="hidden" name="fragebogentitel" value="Testtitel">    
    	<input type="submit" value="kopieren" >
    	</form>
    </td>
    <td>
    	<form action="fragebogenauswertung.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="Testtitel">    
    	<input type="submit" value="auswerten">
    	</form>
    </td>
    <td>
    	Kurs1, Kurs2
    </td>
  </tr>
<!-- Ende Loop -->  
  
</table>
</body>
</html>