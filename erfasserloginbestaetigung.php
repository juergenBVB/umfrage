<?php session_start(); ?>
<html>
	<head>
	</head>
	<body>
		<h1>
			Anmeldung erfolgreich!
		</h1>
		<?php
		echo '<p>Hallo Welt </p>';
		echo 'Benutzername: '.$_POST['ebenutzername'];
		echo '<br>Kennwort:_'.$_POST['ekennwort'];

		?>
	</body>
	
	
	
	
</html>