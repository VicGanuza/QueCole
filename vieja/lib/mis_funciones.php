<?php

// Datos de Conexi�n con la Base de Datos MySQL 
  define('HOST',"localhost", 1);
  define('USER',"quecolec_vitilin",    1);
  define('PSWD',"vitit081",    1);
  define('BASE',"quecolec_colectivos",    1);
/* ----------------------------------------------------------
   Funci�n que devuelve el n�mero de visitas recibidas desde
     una fecha en particular  
------------------------------------------------------------- */
function Contar_Visitas($conx, $aniodesde, $mesdesde, $diadesde )
{
   $sql="select count(*) from visitas 
         where fecha >= '$aniodesde-$mesdesde-$diadesde'";
    $result= mysql_query($sql,$conx) or die(mysql_error());
    if($row = mysql_fetch_array($result))
    {
      return $row[0];
    }
    else
     return(0);
}
/* ----------------------------------------------------------
   Funci�n que registra una visita. 
   Es recomendable que el $IDUSER sea la IP para que de este 
   modo se registren visitas �nicas, pero puede ser 
   tambi�n el SESSION_ID para registrar varias entradas del
   mismo usuario.
------------------------------------------------------------- */
function Registrar_Visita($conx, $IDUSER)
{
 $fecha=date('Y-m-d H:i:s'); // Fecha y hora actual
  /* --------------------------------------------------
    Primero hacemos una consulta para ver si ese mismo
    usuario ya est� registrado el d�a de hoy.
    ------------------------------------------------- */
 $sql="select * from visitas 
       where direccion_ip='$IDUSER' 
         and year(fecha)=year(CURDATE()) 
         and month(fecha)=month(CURDATE()) 
         and DAYOFMONTH(fecha)=DAYOFMONTH(CURDATE())";
 $result= mysql_query($sql,$conx) or die(mysql_error());
 if(mysql_num_rows($result)==0) // Registrar la visita
 {
  $sql="INSERT INTO visitas VALUES(NULL,'$IDUSER','$fecha')";
  mysql_query($sql,$conx) or die(mysql_error());
 }
}
?>