
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
<title>Willkommen zum Umfragetool HuAiSt</title>
</head>
<body>
	<h1> Anmeldung Student</h1>
	
	<h2>Bitte Anmelden via Matrikelnummer</h2>
	<form action="fragebogenuebersicht.php" method="post">
	

	
	
	
	<!-- Hier fehlt Gegenpr¸fung ob MNR vorhanden -> JA-> fragebogenuebersicht.php ; NEIN -> mnrnichtvorhanden.php -->
	
		Deine Matrikelnummer <input name="mnr_student" type="text" size="40" maxlength="30" > <br>
		<input type="submit" name="anmeldung_mnr" = "anmelden"> <br>
		
		

	
	
	<h3>Die alternative Anmeldung f√ºr Erfasser ist unter folgendem Link zu finden</h3>
	<a href=erfasserlogin.php>Erfasserlogin</a> 

</form>
</body>
</html>