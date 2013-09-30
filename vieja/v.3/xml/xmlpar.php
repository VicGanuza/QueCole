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
$ids = $_GET["id"];
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

// Selecciono aquellos items que estan cerca de las latitudes y longitudes pasadas por parámetro
if (!$ids)
{
	$query = "SELECT * FROM $tabla WHERE Sentido=$sent";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}


// Empieza a formarse el XML
echo "<markers>\n";

$dist=0;

if($row = @mysql_fetch_assoc($result)) {$LatAc  = $row['Lat'];
                                        $LongAc = $row['Lng'];
										echo '<parada ';
                                        echo 'Lat="' . $LatAc . '" ';
                                     	echo 'Long="' . $LongAc . '" ';
                                     	echo 'Distancia="' . $dist .'" ';
										echo 'Id="' . $row['id'] .'" ';
                                    	echo "/>\n";
                                          }

while ($row = @mysql_fetch_assoc($result))
{
  // Se agrega al documento XML
    $LatAn = $LatAc;
	$LongAn = $LongAc;
	$LatAc = $row['Lat'];
	$LongAc = $row['Lng'];
	$dLat = ($LatAc-$LatAn);
	$dLon = ($LongAc-$LongAn);
	$a = $dLat * $dLat;
	$c = $dLon * $dLon;
	$d = sqrt($a+$c)*100000;
	$dist = $dist+$d;

	echo '<parada ';
    echo 'Lat="' . $LatAc . '" ';
	echo 'Long="' . $LongAc . '" ';
	echo 'Distancia="' . $dist .'" ';
	echo 'Id="' . $row['id'] .'" ';
	echo "/>\n";	

}	 
// Fin del achivo XML

}
else
{
$query = "SELECT * FROM $tabla WHERE Sentido=$sent AND id<=$ids";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}


// Empieza a formarse el XML
echo "<markers>\n";

$dist=0;

if($row = @mysql_fetch_assoc($result)) {$LatAc  = $row['Lat'];
                                        $LongAc = $row['Lng'];
									     }

while ($row = @mysql_fetch_assoc($result))
{
  // Se agrega al documento XML
   
	$LatAn = $LatAc;
	$LongAn = $LongAc;
	$LatAc = $row['Lat'];
	$LongAc = $row['Lng'];
	$dLat = ($LatAc-$LatAn);
	$dLon = ($LongAc-$LongAn);
	$a = $dLat * $dLat;
	$c = $dLon * $dLon;
	$d = sqrt($a+$c)*100000;
	$dist = $dist+$d;
	
	$idd = $row['id'];

	

}	
    echo '<parada ';
    echo 'Lat="' . $LatAc . '" ';
	echo 'Long="' . $LongAc . '" ';
	echo 'Distancia="' . $dist .'" ';
	echo 'id= "' . $idd  . '" ';
    echo "/>\n";	
	
// Fin del achivo XML
}
echo "</markers>\n";

?>
