<?php
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
		
		$sql = mysqli_query($this->con, "SELECT sp.mnr FROM speichert sp, student st WHERE sp.mnr = st.mnr 
																							AND st.kname = '$this->kurs' AND
																						 sp.titel = '$this->titel'");	
		
		while ($row = mysqli_fetch_assoc($sql)){
			//  "MNR: ".$row['mnr']."<br>";
			
			$sql3 = mysqli_query($this->con, "SELECT fid FROM frage WHERE titel = '$this->titel'");
			while ($row3 = mysqli_fetch_assoc($sql3)){
			
				$sql2 = mysqli_query($this->con, "SELECT skalenwert FROM beantwortet WHERE mnr = '".$row['mnr']."' 
						AND fid = '".$row3['fid']."'");
				
				
				while ($row2 = mysqli_fetch_assoc($sql2)){
					//echo "FID: ".$row2['fid']."<br>";
					//echo "Skalenwert: ".$row2['skalenwert']."<br>";
					$frageid = $row3['fid'];
					$frage[$frageid][] = $row2['skalenwert'];
				}
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
		$sql = mysqli_query($this->con, "SELECT kommentar FROM kommentar k, student s WHERE k.mnr = s.mnr 
																							AND s.kname = '$this->kurs' 
																						AND titel = '$this->titel'");
		while ($row = mysqli_fetch_assoc($sql)){
			$result = $result.$row['kommentar']."<br>";
		}
		
		return $result;
	}
	
	
}

?>