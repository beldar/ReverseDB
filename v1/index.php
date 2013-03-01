<?
//session_start();
include_once("ReverseDB.class.php");
$db = new ReverseDB('c','c','c');
$db->drawImg();
/*if(isset($_POST['a'])) $a = intval($_POST['a']);
else $a=-1;
switch($a){
		case 0:
			if(isset($_POST['server']) && isset($_POST['user']) && isset($_POST['pass'])){
				$_SESSION['constr'] = $_POST['server'].'_'.$_POST['user'].'_'.$_POST['pass'];
				$file = fopen("bd.txt","w");
				fwrite($file, $_SESSION['constr']);
				fclose($file);
				$db = new ReverseDB('draco.salle.url.edu', 'globalbus', 'globalbus');
				$dbs = $db->GetDBs();
				echo 'Selecciona Base de Dades: <form action="'.$_SERVER['PHP_SELF'].'" method="POST" id="db"> <select name="dbs">';
				while($row = mysql_fetch_object($dbs)){
					echo '<option value="'.$row->Database.'">'.$row->Database.'</option>';
				}
				echo '</select><br /><input type="hidden" name="a" value="1" /><input type="submit" value="Entrar"/></form>';
			}else{
				echo '<p>Has d\'omplir tots els camps</p><br /><a href="'.$_SERVER['PHP_SELF'].'">Tornar</a>';
			}
			break;
		
		case 1:
			if(isset($_POST['dbs'])){
				//$constr = explode("_", $_SESSION['constr']);
				$file = fopen("bd.txt","r");
				$gestor = @fopen("bd.txt", "r");
				if ($gestor) {
					while (!feof($gestor)) {
						$constr = fgets($gestor, 4096);
					}
					fclose ($gestor);
				}
				$constr = explode("_", $constr);
				$db = new ReverseDB('draco.salle.url.edu', 'globalbus', 'globalbus');
				$name = $_POST['dbs'];
				$db->UseDB('globalbus');
				$db->GetTables();
				//$db->Draw();
				$db->FindKeys();
				$db->Relation();
				var_dump($db->rels);
				$db->DrawRel();*/
			/*}else echo 'Algo falla';
			break;


		default:
?>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" id="db">
				<label for="server">Server: </label><input type="text" name="server" /><br />
				<label for="user">User: </label><input type="text" name="user" /><br />
				<label for="pass">Password: </label><input type="password" name="pass" /><br />
				<input type="hidden" name="a" value="0" />
				<input type="submit" value="Enviar" />
			</form>
<?
			break;
} */
?>