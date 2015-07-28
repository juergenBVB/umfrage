<?php session_start(); 
include 'datenbankconnect.php';?>

<html>
	<head>
	</head>
	<body>	
		<h1> Anmeldung erfolgreich!	</h1>		
		<?php
		$benutzername = $_POST['ebenutzername'];
		$kennwort = $_POST['ekennwort'];
	/*	echo 'Benutzername: '.$benutzername;
		echo '<br>Kennwort: '.$kennwort;		*/
		
			
		if ($_POST['buttons'] == "Einloggen")
		{

			$sqlresult =
				mysqli_query($con, "Select kennwort From erfasser where benutzername='$benutzername';");
			
			while ($row = mysqli_fetch_assoc($sqlresult))
			{
				if ($row['kennwort']==$kennwort){
					echo 'Benutzeranmeldung erfolgreich.
					<a href=erfasserubersicht.php> <br> <br> <h3>Zur Erfasserübersicht</h3></a>';
					$_SESSION ["benutzername"]=$benutzername;
				}
				else
				{
					echo 'Kennwort oder Benutzername falsch. <br>
						Bitte versuchen Sie es noch einmal.<br>
						<a href=erfasserubersicht.php> <br> <br> <h3>Zur Erfasserübersicht</h3></a>';
				}
			}
		}
		
		if ($_POST['buttons'] == "Registrieren")
		{
			mysqli_query($con, "insert into erfasser values ('$benutzername','$kennwort')");
			
			echo 'Benutzer <b>'.$benutzername.'</b> wurde gespeichert. <br>
				Sie können sich	nun auf der Startseite einloggen. 
				<a href=erfasserlogin.php> <br> <br> <h3>Zur Startseite</h3></a>' ;
		}
		
		?>
	</body>
	
</html>