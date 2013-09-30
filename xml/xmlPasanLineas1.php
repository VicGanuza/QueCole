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
$l = $_GET["l"];
$radius = $_GET["radius"];
$base = $database . "paradas";
$base1 = $database . "colectivos";

 echo "<markers>\n";
// Empieza a formarse el XML

// Conexión a la Base de Datos
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($base, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

if ($l == 0)
{
   $db_selected1 = mysql_select_db($base1, $connection);
   if (!$db_selected1) {
       die ('Can\'t use db : ' . mysql_error()); 
      }

    $query = "SELECT nombre FROM $base1.lineas";

    $result = mysql_query($query);
    if (!result)
     { die('Invalid query: ' . mysql_error());
          }

   
   while ($row = @mysql_fetch_assoc($result)) 
    {
      $lin=$row['nombre'];
      $tabla = $base . ".`".$lin."`";

       // Selecciono aquellos items que estan cerca de las latitudes y longitudes pasadas por parámetro

      $queryI = sprintf("SELECT id, Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY Sentido, distance ",
        mysql_real_escape_string($center_latI),
        mysql_real_escape_string($center_lngI),
        mysql_real_escape_string($center_latI),
        mysql_real_escape_string($radius));

      $queryD = sprintf("SELECT id, Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY Sentido, distance ",
        mysql_real_escape_string($center_latD),
        mysql_real_escape_string($center_lngD),
        mysql_real_escape_string($center_latD),
        mysql_real_escape_string($radius));

    
      $SuperQuery = "SELECT Origen.id AS PO, Origen.Lat AS LatO, Origen.Lng AS LngO, Origen.Sentido AS sent, Destino.id AS PD, Destino.Lat AS LatD, Destino.Lng As LngD, Destino.Sentido FROM ($queryI) AS Origen, ($queryD) AS Destino WHERE (Origen.id<Destino.id ) AND (Origen.Sentido=Destino.Sentido)";

      $resultS = mysql_query($SuperQuery);
      if (!$resultS) 
	      {  die('Invalid query: ' . mysql_error()); }

      if (mysql_num_rows($resultS)!=0)
	   { if($rowS=@mysql_fetch_assoc($resultS))
		 {
           echo '<pasa_por_ambas ';
           echo 'Linea="'. $lin . '" ';
		   echo 'PosO= "'. $rowS['PO'] . '" ';
		   echo 'PosD= "'. $rowS['PD'] . '" ';
		   echo 'OriLat= "' . $rowS['LatO'] . '" ';
		   echo 'OriLng= "' . $rowS['LngO'] . '" ';
		   echo 'DestLat= "' . $rowS['LatD'] . '" ';
		   echo 'DestLng= "' . $rowS['LngD'] . '" ';
		   echo 'Sent= "' . $rowS['sent'] . '" ';
		   echo "/>\n";
		  }//if rowS
	   } //if resultS
     } //while
} // if $l==0

else 
{
  $tabla = $base . ".`". $l."`";

  // Selecciono aquellos items que estan cerca de las latitudes y longitudes pasadas por parámetro

  $queryI = sprintf("SELECT id, Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY Sentido, distance ",
        mysql_real_escape_string($center_latI),
        mysql_real_escape_string($center_lngI),
        mysql_real_escape_string($center_latI),
        mysql_real_escape_string($radius));

   $queryD = sprintf("SELECT id, Lat, Lng, Sentido, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( Lat ) ) ) ) AS distance FROM $tabla HAVING distance < '%s' ORDER BY Sentido, distance ",
        mysql_real_escape_string($center_latD),
        mysql_real_escape_string($center_lngD),
        mysql_real_escape_string($center_latD),
        mysql_real_escape_string($radius));

    
   $SuperQuery = "SELECT Origen.id AS PO, Origen.Lat AS LatO, Origen.Lng AS LngO, Origen.Sentido AS sent, Destino.id AS PD, Destino.Lat AS LatD, Destino.Lng As LngD, Destino.Sentido FROM ($queryI) AS Origen, ($queryD) AS Destino WHERE (Origen.id<Destino.id ) AND (Origen.Sentido=Destino.Sentido)";

   $resultS = mysql_query($SuperQuery);
   if (!$resultS) 
	 {  die('Invalid query: ' . mysql_error()); }

    if (mysql_num_rows($resultS)!=0)
	 { if($rowS=@mysql_fetch_assoc($resultS))
		 {
           echo '<pasa_por_ambas ';
           echo 'Linea="'. $l . '" ';
		   echo 'PosO= "'. $rowS['PO'] . '" ';
		   echo 'PosD= "'. $rowS['PD'] . '" ';
		   echo 'OriLat= "' . $rowS['LatO'] . '" ';
		   echo 'OriLng= "' . $rowS['LngO'] . '" ';
		   echo 'DestLat= "' . $rowS['LatD'] . '" ';
		   echo 'DestLng= "' . $rowS['LngD'] . '" ';
		   echo 'Sent= "' . $rowS['sent'] . '" ';
		   echo "/>\n";
		  }//if rowS
	   } //if resultS
 }//else
echo "</markers>\n";
// Fin del achivo XML

?>
