<?php session_start(); 
include 'datenbankconnect.php';

/* K�nnte man bei Login/Registrierung noch checken: Beide Felder bef�llt, kennwortl�nge lang genug,
 aber nicht zu lange  */
?>

<html>
	<head>
	</head>
	<body>	
	
		<?php
		$benutzername = $_POST['ebenutzername'];
		$kennwort = $_POST['ekennwort'];
			
		if ($_POST['buttons'] == "Einloggen")
		{
			$sqlresult =
				mysqli_query($con, "Select kennwort From erfasser where benutzername='$benutzername';");
			
			if (mysqli_num_rows($sqlresult)==0){
				echo '<h1>Registrierung fehlgeschlagen</h1> <br> Benutzername nicht vergeben
				<a href=erfasserlogin.php> <br> <br> <h3>Zur�ck zum Erfasserlogin</h3></a>';
			
			}
			
			while ($row = mysqli_fetch_assoc($sqlresult))
			{
				
				if ($row['kennwort']==$kennwort){
					echo '<h1> Benutzeranmeldung erfolgreich. </h1>
					<a href=erfasserubersicht.php> <br> <br> <h3>Zur Erfasser�bersicht</h3></a>';
					$_SESSION ["benutzername"]=$benutzername;
				}
				else
				{
					echo '<h1> Anmeldung fehlgeschlagen </h1>
						Kennwort oder Benutzername falsch. <br>
						Bitte versuchen Sie es noch einmal.<br>
						<a href=erfasserlogin.php> <br> <br> <h3>Zur�ck zum Erfasserlogin</h3></a>';
				}
			}
		}
		
		if ($_POST['buttons'] == "Registrieren")
		{
			$sqlresult =
				mysqli_query($con, "Select benutzername from erfasser where benutzername='$benutzername';");
			
			
				if (mysqli_num_rows($sqlresult)==1){
					echo '<h1>Registrierung fehlgeschlagen</h1> <br> Benutzername bereits vergeben
				<a href=erfasserlogin.php> <br> <br> <h3>Zur�ck zur Registrierung</h3></a>';
				
				}
				else {	
					mysqli_query($con, "insert into erfasser values ('$benutzername','$kennwort')");
						
					echo '<h1> Registrierung erfolgreich </h1>
							<br> Benutzer <b>'.$benutzername.'</b> wurde gespeichert. <br>
				Sie k�nnen sich	nun auf der Startseite einloggen.
				<a href=erfasserubersicht.php> <br> <br> <h3>Zur Startseite</h3></a>' ;
				}
			}		

		
	
		?>
	</body>
	
</html>