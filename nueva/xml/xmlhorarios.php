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
$sen = "'". $_GET["s"]. "'";
$hora = $_GET["hora"];
$minutos = $_GET["min"];
$dia= "'". $_GET["dia"] ."'";
$base = $database . "horarios";
$tabla = "`".$linea."`";


// Conexión a la Base de Datos
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($base, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Selecciono aquellos items que estan cerca de las latitudes y longitudes pasadas por parámetro

$query = "SELECT * FROM $tabla WHERE Sentido=$sen and Dias=$dia";


$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$i=0;
// Empieza a formarse el XML
echo "<markers>\n";

while ($row = @mysql_fetch_assoc($result))
{ if ($i<3)
  { $tiempo= explode(":", $row['Hora']);
    $hor=$tiempo[0];
    $min=$tiempo[1];
	$difH=$hor-$hora;
	$difM=$min-$minutos;
	if ($difM<0) {$difH=$difH-1;
	              $difM=60+$difM;
				  }
	if($difH<0){$difH=24+$difH;}
	if (($hora==$hor)&($minutos==$min))
     { echo '<horario ';
       echo 'Hora="' . $hor . '" ';
	   echo 'Minutos="'. $min . '" ';
	   echo 'DifHora="' . $difH . '" ';
	   echo 'DifMinu="' . $difM . '" ';
	 //  echo 'Linea="' . $row['Linea'] . '" ';
       echo "/>\n";
      $i+=1;}
	 else if (($hora==$hor)&($minutos<$min))
     { echo '<horario ';
        echo 'Hora="' . $hor . '" ';
	    echo 'Minutos="'. $min . '" ';
		echo 'DifHora="' . $difH . '" ';
	   echo 'DifMinu="' . $difM . '" ';
	 //  echo 'Linea="' . $row['Linea'] . '" ';
       echo "/>\n";
      $i+=1;} 	
	  else if ($hora<$hor)
     { echo '<horario ';
       echo 'Hora="' . $hor . '" ';
	   echo 'Minutos="'. $min . '" ';
	   echo 'DifHora="' . $difH . '" ';
	   echo 'DifMinu="' . $difM . '" ';
	//   echo 'Linea="' . $row['Linea'] . '" ';
       echo "/>\n";
      $i+=1;}
	  }
  
}

// Fin del achivo XML
echo "</markers>\n";

?>
