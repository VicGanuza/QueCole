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

$center_latI = $_GET["latI"];
$center_lngI = $_GET["lngI"];
$center_latD = $_GET["latD"];
$center_lngD = $_GET["lngD"];
$radius = $_GET["radius"];
//$linea= $_GET["lin"];
$base = $database . "paradas";
$tabla ="`518`";
/*
echo $tabla."<br>";
echo $base."<br>";
echo $center_latI."<br>" ;
*/

// Conexión a la Base de Datos
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($base, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Selecciono aquellos items que estan cerca de las latitudes y longitudes pasadas por parámetro

$queryI = sprintf("SELECT Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY distance ",
  mysql_real_escape_string($center_latI),
  mysql_real_escape_string($center_lngI),
  mysql_real_escape_string($center_latI),
  mysql_real_escape_string($radius));

$queryD = sprintf("SELECT Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY distance ",
  mysql_real_escape_string($center_latD),
  mysql_real_escape_string($center_lngD),
  mysql_real_escape_string($center_latD),
  mysql_real_escape_string($radius));

//echo $queryI."<br>";

$resultI = mysql_query($queryI);
if (!$resultI) {
  die('Invalid query: ' . mysql_error());
}

$resultD = mysql_query($queryD);
if (!$resultD) {
  die('Invalid query: ' . mysql_error());
}

$i=0;
$j=0;

// Empieza a formarse el XML
echo "<markers>\n";

while ($row = @mysql_fetch_assoc($resultI))
{
  // Se agrega al documento XML

  echo '<origen ';
  echo 'ParLat="' . $row['Lat'] . '" ';
  echo 'ParLng="' . $row['Lng'] . '" ';
  echo 'Linea="' . $linea . '" ';
  echo 'Sentido="' . $row['Sentido'] . '" ';
  echo 'distance="' . $row['distance'] . '" ';
  echo 'Pos="' . $i . '" ';
  echo "/>\n";
  $i+=1;

}

while ($row = @mysql_fetch_assoc($resultD))
{
  // Se agrega al documento XML
 
  echo '<destino ';
  echo 'ParLat="' . $row['Lat'] . '" ';
  echo 'ParLng="' . $row['Lng'] . '" ';
  echo 'Linea="' . $linea . '" ';
  echo 'Sentido="' . $row['Sentido'] . '" ';
  echo 'distance="' . $row['distance'] . '" ';
  echo 'Pos="' . $j . '" ';
  echo "/>\n";
 //}
 $j+=1;
}
echo "</markers>\n";
// Fin del achivo XML


?>
