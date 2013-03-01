<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Musica</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
<? if(!isset($_POST['user'])){?>
<form action="musica.php" method="post">
	User: <input type="text" name="user">
	<input type="submit" value="Enviar">
</form>
<? }else{ $user=$_POST['user']?>
<h1>Musica de <?=$user?></h1>
<?

$url = 'http://ws.audioscrobbler.com/2.0/user/'.$user.'/topartists.xml';
$xmlstr = file_get_contents($url);
$artist = new SimpleXMLElement($xmlstr);
//echo '<ul>';
$res = $artist->xpath("//artist/name");
foreach($res as $art){
	if(!empty($art)) echo $art.'<br />';
}
//echo '</ul>';

}

?>
	</body>
</html>
