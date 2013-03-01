<?
class ReverseDB{
	var $server;
	var $user;
	var $pass;
	var $db;
	var $data;
	var $keys;
	var $rels;
	
	function ReverseDB($server_, $user_, $pass_){
		/*$this->server = $server_;
		$this->user = $user_;
		$this->pass = $pass_;
		$this->ConnectDB();*/
	}
	
	function ConnectDB(){
		//mysql_connect($this->server, $this->user, $this->pass);
		mysql_connect('draco.salle.url.edu', 'globalbus', 'globalbus');
	}
	
	function GetDBs(){
		$list = mysql_list_dbs();
		return $list;
	}
	
	function UseDB($name){
		$this->db = $name;
		mysql_select_db($name);
	}
	
	function GetTables(){
		$list = mysql_list_tables($this->db);
		while($row = mysql_fetch_row($list)){
			$this->data[$row[0]] = $this->GetFields($row[0]);
		}
		return $this->data;
	}

	function GetFields($table){
		$r = mysql_query("SHOW COLUMNS FROM ".$table);
		if(mysql_num_rows($r)>0){
			while($row = mysql_fetch_assoc($r)){
				$fields[$row['Field']] = $row;
			}
		}
		return $fields;
	}
	
	function Draw(){
		foreach($this->data as $key=>$value){
			echo '<div style="position:relative;float:left;border:1px #000 solid; width: 100px;margin:5px;">';
			echo '<div style="font-size:16; font-weight:bold;width:100%;position:relative: float:left;border-bottom:1px #000 solid;">'.$key.'</div>';
			foreach($value as $camp=>$caract){
				echo '<div style="font-size:12;font-weight:bold;width:100%;position:relative: float:left;">'.$camp.'</div>';
				foreach($caract as $nom=>$valor){
					if($nom!="Field"){
						echo '<div style="font-size:10;width:90%;position:relative: float:left;">'.$nom.' = '.$valor.'</div>';
					}
				}
			}
			echo '</div>';
		}
	}
	function FindKeys(){
		foreach($this->data as $key=>$value){
			$i=0;
			foreach($value as $camp=>$caract){
				if($caract['Key']=='PRI'){
					$this->keys[$key][$i]=$camp; 
					$i++;
				}
			}
		}
	}
	function DrawKeys(){
		foreach ($this->keys as $key=>$value){
			echo '<div style="position:relative;float:left;border:1px #000 solid; width: 100px;margin:5px;">';
			echo '<div style="font-size:16; font-weight:bold;width:100%;position:relative: float:left;border-bottom:1px #000 solid;">'.$key.'</div>';
			foreach ($value as $index=>$camp){
				echo '<div style="font-size:12;font-weight:bold;width:100%;position:relative: float:left;">'.$camp.'</div>';
			}
			echo '</div>';
		}
	}
	
	function Relation(){
		foreach($this->keys as $key=>$value){
			foreach($value as $index=>$clau){
				$this->rels[$clau] = array();
				$i=0;
				foreach($this->keys as $taula=>$camp){
					foreach($camp as $index2=>$valor){
						if($clau==$valor && !in_array($taula, $this->rels[$clau])){
							$this->rels[$clau][$i] = $taula;
							$i++;
						}
					}
				}
			}
		}
	}
	function DrawRel(){
		foreach ($this->rels as $key=>$value){
			echo '<div style="position:relative;float:left;border:1px #000 solid; width: 100px;margin:5px;">';
			echo '<div style="font-size:16; font-weight:bold;width:100%;position:relative: float:left;border-bottom:1px #000 solid;">'.$key.'</div>';
			foreach ($value as $index=>$camp){
				echo '<div style="font-size:12;font-weight:bold;width:100%;position:relative: float:left;">'.$camp.'</div>';
			}
			echo '</div>';
		}
	}
	function DrawImg(){
		// Definimos los headers
		header("Content-type: image/gif");
		
		// Creamos la imagen
		$imagen = imagecreate(900,600);
		
		// Agregamos contenido
		$blanco = imagecolorallocate($imagen,255,255,255);
		$negro = imagecolorallocate($imagen,0,0,0);
		$rojo = imagecolorallocate($imagen,200,0,0);
		$verde = imagecolorallocate($imagen,0,130,0);
		$gris = imagecolorallocate($imagen,140,140,140);
		$taules = array("Taula 1", "Taula 2", "Taula 3");
		$x1=0;$y1=0;
		$x2=100;$y2=100;
		foreach($taules as $key=>$value){
			imagerectangle($imagen,$x1,$y1,$x2,$y2,$negro);
			$x1 += 110;
			$x2 += 110;
			$x = $x2 - intval((strlen($value) * imagefontwidth(2))/2);
			imagestring($imagen,2,$x,2,$value,$negro);
		}
		// Damos salida a la imagen
		imagegif($imagen);
		
		// Destruimos la imagen
		imagedestroy($imagen);
				
	}

}

?>