<?php
header("Content-type: text/xml");
require("dbinfo.php");

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

//Tomo los parametos de la URL

$linea = $_GET["lin"];
$sen = $_GET["s"];
$posO = "'" . $_GET["ParO"] . "'" ;
$posD =  "'" . $_GET["ParD"] . "'" ;
$sent = "'" . $sen . "'";
$base = $database . "paradas";
$tabla = "`".$linea."`";

// Conexión a la Base de Datos
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($base, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$query = "SELECT * FROM $tabla WHERE Sentido=$sent AND (id >= $posO) AND (id <= $posD)";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}


// Empieza a formarse el XML
echo "<markers>\n";

while ($row = @mysql_fetch_assoc($result))
{
  // Se agrega al documento XML
    echo '<recorrido ';
	echo 'id= "' . $row['id'] . '" ';
    echo 'Lat="' . $row['Lat'] . '" ';
	echo 'Long="' . $row['Lng'] . '" ';
    echo "/>\n";
	}

// Fin del achivo XML
echo "</markers>\n";

?>