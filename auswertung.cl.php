<?php
include 'datenbankconnect.php';
class Auswertung {
	public $titel;
	public $kurs;
	public $auswertung;
	
	public $con;
	
	public function __construct($titel, $kurs){
		$this->titel = $titel;
		$this->kurs = $kurs;
		$this->databasecon();
		$this->doAuswertung();
	}
	
	private function databasecon(){
		$host = "localhost";
		$benutzername = "root";
		$password = "";
		$db = "umfrage";
		
		$this->con = mysqli_connect($host, $benutzername, $password);
		mysqli_select_db($this->con, $db);
	}
	
	
	
	private function doAuswertung(){
		//Fragen abfragen
		$frage = array();		
		
		$sql = mysqli_query($this->con, "SELECT mnr FROM speichert WHERE titel = '$this->titel'");	
		
		while ($row = mysqli_fetch_assoc($sql)){
			//  "MNR: ".$row['mnr']."<br>";
			$sql2 = mysqli_query($this->con, "SELECT fid, skalenwert FROM beantwortet WHERE mnr = '".$row['mnr']."'");
			
			
			while ($row2 = mysqli_fetch_assoc($sql2)){
				//echo "FID: ".$row2['fid']."<br>";
				//echo "Skalenwert: ".$row2['skalenwert']."<br>";
				$frageid = $row2['fid'];
				$frage[$frageid][] = $row2['skalenwert'];
			}
		}
		
		$auswertung = array();
		foreach ($frage as $key => $value){
			
			//Durchschnitt
			$avg = (!empty($value) ? array_sum($value) / count($value) : 0);
			
			//Minimum
			$min = min($value);
			
			//Maximum
			$max = max($value);
			
			//Standardabweichung
			foreach ($value as $valuearray)
				$result += pow($valuearray - $avg, 2);
			$count = ($count == 1) ? $count : $count - 1;
			$standardabweichung = sqrt($result / $count);
			
			$auswertung[$key] = array($avg, $min, $max, $standardabweichung);
		}
		
		$this->auswertung = $auswertung;
	}
	
	public function getAuswertung($fid){
		$auswertung = $this->auswertung;
		return $auswertung[$fid];
	}
	
	public function getKommentare(){
		$sql = mysqli_query($this->con, "SELECT kommentar WHERE titel = '$this->titel'");
		while ($row = mysqli_fetch_assoc($sql)){
			$result = $result.$row['kommentar']."<br>";
		}
		
		return $result;
	}
	
	
}

?>