<?php
//verifica si vienen datos por POST
if(trim($HTTP_POST_VARS["user"]) != "")
{
//verifico si las credenciales son correctas
$user = $HTTP_POST_VARS["user"]; 
$log = false;
//$password = $HTTP_POST_VARS["pass"];

$usuarios = array(
	          1 => array('lu' => '61140', 'nombre' => 'Luján Ganuza', 'tema' => '1'),
	          2 => array('lu' => '60277', 'nombre' => 'Victoria Ganuza', 'tema' => '2')
	        );
//si solo es un usuario haces algo como
foreach ($usuarios as $alu) {
 if ($user == $alu['lu']) {
	$tema = $alu['tema'];
	$nombre = $alu['nombre'];
	$log = true;
 }
}
if ($log)
{
$_SESSION['autorizado'] = TRUE;
echo 'Ingreso correcto'; //aca iria el contenido que quieres mostrar
printf('BIENVENIDO! ' .$nombre);// 'BIENVENIDO! ' .$nombre. "\n";
echo 'Tu tema es el nro: ' .$tema. '\n';
echo 'GOOD LUCK!!!';

?>
<html>
<font face="Calibri">
Bienvenido al Examen de Introduccion a la Programacion Orientada a Objetos

	<ol>
		<li>Descargar el archivo base desde <a href="lab.zip">AQUI</a> </li>
		<li>Descomprimir el archivo utilizando algun extractor instalado (WinZip, 7zip, Windows)</li>
		<li>Renombrar el directorio</li>	
		<li>Resuelva lo pedido completando la clase correspondiente</li>
		<li>Cuando esté en condiciones de entregar comprima el proyecto que contiene la solución del problema planteado sin olvidar incluir la clase Hora completa y la clase tester implementada. El archivo comprimido debe ser renombrado
		de la siguiente forma: "Apellido_LU_IPOO_2013";<br />
        Ejemplo:  si el alumno es Sebastián Urbina, entonces debe comprimir sus archivos en un  nuevo archivo llamado: <em>Urbina_45658_IPOO_2013.zip</em></li>
		
		<li>Subir el archivo <a href="examen/upload/">AQUI</a></li>		
		
		<li>VERIFICAR ANTES DE RETIRARSE DEL LABORATORIO QUE HA SUBIDO EL ARCHIVO. SI ES NECESARIO SOLICITE A UN AYUDANTE QUE VERIFIQUE ESTA ACCIÓN </li>		
		
	</ol>
</font>
	 
	 
</html>
<?php 
} 
else
{
$_SESSION['autorizado'] = FALSE;
echo 'Credenciales incorrectas';

}
}else
{
$_SESSION['autorizado'] = FALSE;
echo 'ERROR:Usted no tiene permiso para ver este contenido';
}
?>