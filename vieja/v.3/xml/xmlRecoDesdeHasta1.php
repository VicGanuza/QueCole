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
$base1 = $database . "recorridos";

// Conexión a la Base de Datos
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($base, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


$query = "SELECT * FROM $base.$tabla WHERE Sentido=$sent AND (id = $posO) OR (id = $posD)";

//echo $query;

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}


// Empieza a formarse el XML
echo "<markers>\n";

if ($row = @mysql_fetch_assoc($result))
{ 
  $lato =$row['Lat'];
  $longo = $row['Lng'];
}

if ($row = @mysql_fetch_assoc($result))
{ 
  $latd = $row['Lat'];
  $longd =$row['Lng'];
}

  $tab = $base1 . ".".$tabla;

  
  $db1_selected = mysql_select_db($base1, $connection);
  if (!$db1_selected) { die ('Can\'t use db : ' . mysql_error()); }

  $queryIni = sprintf("SELECT `id`, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( `Lat` ) ) * cos( radians( `Long` ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( `Lat` ) ) ) ) AS distance FROM $tab WHERE `Sent`=$sent ORDER BY distance ",
        mysql_real_escape_string($lato),
        mysql_real_escape_string($longo),
        mysql_real_escape_string($lato)
       );

  echo $queryIni;
  $resultIni = mysql_query($queryIni);
  if (!$resultIni) {  die('Invalid query: ' . mysql_error()); }

  if (mysql_num_rows($resultIni)!=0)
	{ if($rowI=@mysql_fetch_assoc($resultIni)) 
	     {$idIni = $rowI['id'];}
	  }

  $queryDest = sprintf("SELECT `id`, ( 6.371 * acos( cos( radians('%s') ) * cos( radians( `Lat` ) ) * cos( radians( `Long` ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( `Lat` ) ) ) ) AS distance FROM $tab WHERE `Sent`=$sent ORDER BY distance ",
        mysql_real_escape_string($latd),
        mysql_real_escape_string($longd),
        mysql_real_escape_string($latd)
       );

 // echo  $queryDest;
  $resultd = mysql_query($queryDest);
  if (!$resultd) {  die('Invalid query: ' . mysql_error()); }

  if (mysql_num_rows($resultd)!=0)
   { if($rowD=@mysql_fetch_assoc($resultd))
	  { $idDest = $rowD['id'];}
     }

  $Super = "SELECT `id`, `Lat`, `Long` FROM $tab WHERE (`id`>=$idIni) AND (`id`<=$idDest)";

  /*echo  $Super;
  echo "\n";
  echo $lato . ' ' . $latd . "\n";*/

  $resultS = mysql_query($Super);
  if (!$resultS) {  die('Invalid query: ' . mysql_error()); }

  $nreg = mysql_num_rows($resultS);

  echo $nreg;
  while($rowS=@mysql_fetch_assoc($resultS))
    {
		echo '<recorrido ';
		echo 'id= "' . $rowS['id'] . '" ';
		echo 'Lat="' . $rowS['Lat'] . '" ';
		echo 'Long="' . $rowS['Long']. '" ';
        echo "/>\n";
	
/*

   if ($nreg!=0)
	{ if($rowS=@mysql_fetch_assoc($resultS)) 
	     {$idA = $rowS['id'];
		  $latA = $rowS['Lat'];
		  $LongA = $rowS['Long'];
		  }

	  if($rowS=@mysql_fetch_assoc($resultS)) 
	     {$idB = $rowS['id'];
		  $latB = $rowS['Lat'];
		  $LongB = $rowS['Long'];
		  }

		
	  if (($latB - $latA)<0){ if (($lato - $latA)>0){  echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													   echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
										       else {  echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
						    }//id B-A<0
		               else { if (($lato - $latA)<0){  echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													   echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
										       else {  echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
						    }//else
	 
	$idA = $idB;
	$latA = $latB;
	$LongA = $LongB;

	for ($i=1;$i<=($nreg-3);$i++)
	{ if($rowS=@mysql_fetch_assoc($resultS)) 
		{ $idB = $rowS['id'];
		  $latB = $rowS['Lat'];
		  $LongB = $rowS['Long']; }

		echo '<recorrido ';
        echo 'id= "' . $idB . '" ';
		echo 'Lat="' . $latB . '" ';
		echo 'Long="' . $LongB . '" ';
        echo "/>\n";

		$idA = $idB;
        $latA = $latB;
	    $LongA = $LongB;
	}//for puntos internos
*/

        /*
		if (($latA - $latB)>0){ if (($latB - $latd)>0){/*echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													  
													   }
										       else {  echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													   echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
						    }//id B-A<0
		               else { if (($latB - $latd)<0){ *//* echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													  
													   }
										       else { echo '<recorrido ';
													   echo 'id= "' . $idA . '" ';
													   echo 'Lat="' . $latA . '" ';
													   echo 'Long="' . $LongA . '" ';
                                                       echo "/>\n";
													   echo '<recorrido ';
													   echo 'id= "' . $idB . '" ';
													   echo 'Lat="' . $latB . '" ';
													   echo 'Long="' . $LongB . '" ';
                                                       echo "/>\n";
													   }
						    }//else
  
       $idA = $idB;
	   $latA = $latB;
	   $LongA = $LongB;*/
	}//while

//if}

// Fin del achivo XML
echo "</markers>\n";

?>