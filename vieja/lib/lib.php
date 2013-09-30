<?php

function BotonG()
{ 
  $datos  = '';
  $datos .= '<script type="text/javascript">
  (function() {
    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    po.src = "https://apis.google.com/js/plusone.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';

  return $datos;

}

function facebook()
{$datos = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
return $datos;
}

function Analytics ()
{ $datos  = '';
  $datos .= '<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-32689978-1"]);
  _gaq.push(["_setDomainName", "quecole.com.ar"]);
  _gaq.push(["_trackPageview"]);

  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>';

 return $datos;
}

function encabezado()
{
	$data  = '';
	$data .= '<!DOCTYPE html><html><head>';
	$data .= '<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />';
/*	$data .= '<link rel="shortcut icon" href="../images/LogoTitulo1.jpg" type="image/x-icon">
<link rel="icon" type="image/png" href="../images/LogoTitulo1.jpg" />
<link rel="image_src" href="../images/Logo_Cole.jpg" />';*/
	$data .= '<title>¿Qué Cole?</title>';
	$data .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>';
	$data .= '<link href="../Estilos.css" rel="stylesheet" type="text/css" />';
    $data .= Analytics();
	$data .= BotonG();
    $data .= ' <script type="text/javascript" src="lib/libreria.js"></script>';
	$data .= '</head>';

	return $data;
}

function cabecera()
{ 
   $datos =' <div id="cabecera"><img src="../images/LogoCabecera1.gif" border="0"></div> <!--height="100%"cabecera-->  ';
   return $datos;
  
  }

function Menu()
{ 
  $datos  = '';
  $datos .= '<div id="barra"><!-- -->
    <table width="100%">
      <tr>
	    <td width="50%"> 
		  <div id="navbar"> <span>
          <ul>
           <li><a href="index.php"><span>Como ir</span></a></li>
           <li><a href="recorridos.php"><span>Recorrido</span></a></li>
           <li><a href="paradas.php"><span>Paradas</span></a></li>
           <li><a href="contacto.php"><span>Contacto</span></a></li>
          </ul>
          </span> </div>
		</td>
		<td width="50%">
		<div id="navbar_public">
         <a target="_blank" href="http://www.facebook.com/sharer.php?u=http://www.quecole.com.ar"><img src="../images/LogoFace.gif" border=0 width=35 height=30 /></a>
		 <script> document.write(\'<a target="_blank" href="http://twitter.com/home?status=\' + encodeURIComponent("¿Querés saber que Cole tomar? http://www.quecole.com.ar") + \'"><img src="../images/LogoTwiterPaj.gif" border=0 width=48 height=30 alt="Comparte esto en Twitter" /></a>\');
</script>
<g:plusone></g:plusone>
		</div>
	    </td>
	  </tr>
	</table>
  </div> <!--barra-->    ';

  return $datos;
 }

function PubIndex()
{ 
  $datos ='<div id="PublicDer">
   
	  <a href="http://temporada-sma.com.ar/" target="_blank"> <div id="PubTempo"></div><!--PubTempo--></a>

	<div id="PubGoogle">
	<table width="100%" style="color:#FFFFFF" >
	 <tr align="center">
	  <td>
	    <script type="text/javascript">
		  google_ad_client = "ca-pub-2637818123363245";
             /* LateralDerecho */
          google_ad_slot = "2928436823";
          google_ad_width = 160;
          google_ad_height = 600;
		</script>	   
		<script type="text/javascript"
             src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
           </script>
		 </td>
	 </tr>
    </table>
	</div><!--PubGoogle-->
  </div> <!--PublicDer--> ';

  return $datos;
}

function pie()
{
	
//------- cargar las funciones -------
 require_once('lib/mis_funciones.php');
 //------- abrir la base de datos------
  $conx = mysql_connect (HOST,USER,PSWD) or die (mysql_error()); 
  mysql_select_db(BASE) OR die("Connection Error to Database"); 

 $datos  = '';
 $datos .= '<div id="pie">
             <table width="100%" >
              <tr height="30px">
			    <td width="50%" >';

Registrar_Visita($conx, $HTTP_SERVER_VARS['REMOTE_ADDR']);

 $datos .= '<b>'.Contar_Visitas($conx, date("Y"), date("m"), date("d")). '</b> visitas el día de hoy. <b>' . number_format(Contar_Visitas($conx, 2006, 1, 1 ),0). '</b> visitas totales.';

 $datos .= '</td>
            <td width="50%">
	          <img src="../images/Pie_de_Pagina3.gif" width="100%" border="0">
            </td>
             </tr>
             
			 </table>	
			</div>';

  return $datos;
 }

function consulta()
{ $datos = '<div id="consulta">
           <h2>Ingrese la consulta</h2> 
            <form name="formulario">
			<table class="Info">
			 <tr>
			   <td>Calle y Altura Origen:</td>
			 </tr>
			 <tr>
               <td aling="center"><input type="text" id="direOrigen"> </td>
			 </tr>
			 <tr>
			   <td>
			      Calle y Altura Destino:</td>
			 </tr>
			 <tr>
			    <td>  <input type="text" id="direDest"> </td>
			</tr>
			<tr>
			   <td> Máximo de cuadras a la parada mas cercana:</td>
			 </tr>
			 <tr>
			   <td>4 Por Defecto: <input type="text" id="cantCuad" size="1"> </td>
			 </tr>
			 <tr>
			  
			  <table width="100%">
			  <tr>
                  <td width="50%"></td>
                  <td width="50%"><div id="Boton">
	           <input type="button" onClick="BuscarLocaciones()" value="Consultar"/> </div><!--Boton-->
			    </td></tr>
			 </table>
	    	</tr>
            </table>
		   </form>
         </div> <!--Consulta-->';
  return $datos;
         
 }

function Respuesta ()
{ $datos ='<div id="respuestas"> 
		 <table class="Info">
		  <tr>
		    <td> Resultado de la consulta:</td>
		  </tr>
		  <tr>
		    <td>
			 <div id="Resultado">
               <div><select id="Seleccionar" style="width:100%;visibility:hidden"></select></div>
             </div><!--Resultado-->
			</td>
          </tr>
		  <tr>
		    <td>Horario Póximos Colectivos:</td>
		  </tr>
		  <tr>
		   <td>
		     <div id="result">
              <textarea rows="6" id="HorariosParadas"> </textarea> 
             </div><!--result-->
           </td>
          </tr>
		  <tr>
		  <table width="100%">
		    <tr>
              <td width="50%"></td>
              <td width="50%">
			     <form id="form2" name="form2" method="post" action="como_ir.php">
                  <label>
                    <input type="submit" name="Nueva consulta" id="Nueva consulta" value="Nueva consulta" />
                  </label>
                 </form>
              </td>
            </tr>
		  </table>
      </div><!--respuestas-->
';

 return $datos;
 }

function LateralCoIr()
 {
   $datos  = '';
   $datos .= consulta();
   $datos .= Respuesta();

   return $datos;
 
 }

function cuerpo2()
{
	$datos  = '';
	$datos .= encabezado();
	$datos .= '<body onload="initialize()"><div id="contenedor">';
	$datos .= PubIndex();
	$datos .= '<div id="centro">';
	$datos .= cabecera();
	$datos .= Menu();
	$datos .= '<div id="medio">';
	$datos .= '<div id="lateral">';
	$datos .= LateralCoIr();
	$datos .= '</div>';
	$datos .= '<div id="mapa"></div><!--mapa--></div>';
	$datos .= pie();
	$datos .= '</div><!--centro--></div><!--contenedor--></body></html>';

	return $datos;
}

function pub($id)
{}

function lateral($id)
{
  $datos ='<h2>Lineas (' . $id . ')</h2> 
  <div class="suckerdiv">
<ul id="suckertree1">

  <li><a href="' . $id . '.php">500</a>
    <ul>
      <li><a href="' . $id . '.php?lin=500&s=ida">Sesquicentenario - Ing. White</li></a>
      <li><a href="' . $id . '.php?lin=500&s=vuelta">Ing. White - Sequicenteranio</a></li>
    </ul>
  </li>
 
  <li><a href="' . $id . '.php">502</a>
    <ul>
      <li><a href="' . $id . '.php?lin=502&s=ida">V. Rosas - V. Floresta</a></li>
      <li><a href="' . $id . '.php?lin=502&s=vuelta">V. Floresta - V. Rosas</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">503</a>
     <ul>
      <li><a href="' . $id . '.php?lin=503&s=ida">Spurr - Wall-Mart</a></li>
      <li><a href="' . $id . '.php?lin=503&s=vuelta">Wall-Mart - Spurr</a></li>
	  <li><a href="' . $id . '.php"> Prolongacion </a>
	     <ul>
           <li><a href="' . $id . '.php?lin=503 P. CONICET&s=ida">Wall-Mart - CONICET</a></li>
		   <li><a href="' . $id . '.php?lin=503 P. CONICET&s=vuelta">CONICET - Wall-Mart</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">504</a>
    <ul>
      <li><a href="' . $id . '.php?lin=504&s=ida">Ing. White - Penna</a></li>
      <li><a href="' . $id . '.php?lin=504&s=vuelta">Penna - Ing. White</a></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=504 P. El Guanaco&s=ida">Alte. De Solier-Pje El Guanaco</a></li>
		   <li><a href="' . $id . '.php?lin=504 P. El Guanaco&s=vuelta">Pje El Guanaco-Alte. De Solier</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">505</a>
    <ul>
      <li><a href="' . $id . '.php?lin=505&s=ida">Rosendo Lopez - Noroeste</a></li>
      <li><a href="' . $id . '.php?lin=505&s=vuelta">Noroeste - Rosendo Lopez</a></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=505 P. Maldonado&s=ida">Charlone-Maldonado</a></li>
		   <li><a href="' . $id . '.php?lin=505 P. Maldonado&s=vuelta">Maldonado-Charlone</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">506</a>
   <ul>
      <li><a href="' . $id . '.php?lin=506&s=ida">Rosendo Lopez - 17 de mayo</a></li>
      <li><a href="' . $id . '.php?lin=506&s=vuelta">17 de mayo - Rosendo Lopez</a></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=506 P. Cementerio&s=ida">Rosendo L. - 17 de Mayo (pasa por Cementerio)</a></li>
		   <li><a href="' . $id . '.php?lin=506 P. Cementerio&s=vuelta">17 de M. - Rosendo L. (pasa por Cementerio)</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">507</a>
   <ul>
      <li><a href="' . $id . '.php?lin=507&s=ida">V. Harding Green - Hospital Municipal</a></li>
      <li><a href="' . $id . '.php?lin=507&s=vuelta">H. Municipal - V. Hardin Green</a></li>
	  <li><a href="' . $id . '.php">DIRECTO</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=507 DIRECTO&s=ida">V. Harding Green-H. Municipal</a></li>
		   <li><a href="' . $id . '.php?lin=507 DIRECTO&s=vuelta">H. Municipal-V.Harding Green</a></li>
		 </ul></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=507 P. Espora&s=ida">V. Harding Green - Espora</a></li>
		   <li><a href="' . $id . '.php?lin=507 P. Espora&s=vuelta">Espora - V. Harding Green</a></li>
		 </ul></li>

    </ul>
  </li>
  <li><a href="' . $id . '.php">509</a>
  <ul>
      <li><a href="' . $id . '.php?lin=509&s=ida">P. de la Ciudad - Bella Vista</a></li>
      <li><a href="' . $id . '.php?lin=509&s=vuelta">Bella Vista - P. de la Ciudad</a></li>
	   <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=509 P. Cementerio&s=ida">Hacia Cementerio</a></li>
		   <li><a href="' . $id . '.php?lin=509 P. Cementerio&s=vuelta">Desde Cementerio</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">512</a>
   <ul>
      <li><a href="' . $id . '.php?lin=512&s=ida">P. de la Ciudad - B. 5 de Abril</a></li>
      <li><a href="' . $id . '.php?lin=512&s=vuelta">B. 5 de Abril - P. de la Ciudad</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">513</a>
   <ul>
      <li><a href="' . $id . '.php?lin=513&s=ida">P. de la Ciudad - V. Don Bosco</a></li>
      <li><a href="' . $id . '.php?lin=513&s=vuelta">V. Don Bosco - P. de la Ciudad</a></li>
	  <li><a href="' . $id . '.php">DIRECTO</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=513 DIRECTO&s=ida">Kloosterman - H. Italiano</a></li>
		   <li><a href="' . $id . '.php?lin=513 DIRECTO&s=vuelta">H. Italiano - Kloosterman</a></li>
		 </ul></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=513 P. Viajantes del Sur&s=ida">V. del Sur - H.Penna</a></li>
		   <li><a href="' . $id . '.php?lin=513 P. Viajantes del Sur&s=vuelta">H. Penna - V. del Sur</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">514</a>
   <ul>
      <li><a href="' . $id . '.php?lin=514&s=ida">Coca Cola - Maldonado</a></li>
      <li><a href="' . $id . '.php?lin=514&s=vuelta">Maldonado - Coca Cola</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">516</a>
   <ul>
      <li><a href="' . $id . '.php?lin=516&s=ida">Newton- Panama al 3500</a></li>
      <li><a href="' . $id . '.php?lin=516&s=vuelta">Panama al 3500 - Newton</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">517</a>
   <ul>
      <li><a href="' . $id . '.php?lin=517&s=ida">P. de la Ciudad - Espora</a></li>
      <li><a href="' . $id . '.php?lin=517&s=vuelta">Espora - P. de la Ciudad</a></li>
	  <li><a href="' . $id . '.php">Prolongacion</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=517pa&s=total">B. Polo</a></li>
		   <li><a href="' . $id . '.php?lin=517pb&s=total">Grumbein</a></li>
		   <li><a href="' . $id . '.php?lin=517pc&s=total">17 de Mayo</a></li>
		   <li><a href="' . $id . '.php?lin=517pd&s=total">V. Harding Green</a></li>
		 </ul></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">518</a>
   <ul>
      <li><a href="' . $id . '.php?lin=518&s=ida">SPURR - H. Municipal</a></li>
      <li><a href="' . $id . '.php?lin=518&s=vuelta">H. Municipal - SPURR</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">519</a>
   <ul>
      <li><a href="' . $id . '.php?lin=519&s=ida">Bahia Blanca - Cerri(Ingreso Directo)</a></li>
	  <li><a href="' . $id . '.php?lin=519 Escuela N7&s=ida">Bahia Blanca - Cerri(Ingreso por escuela 7)</a></li>
      <li><a href="' . $id . '.php?lin=519&s=vuelta">Cerri(Egreso Directo) - Bahia Blanca</a></li>
	  <li><a href="' . $id . '.php?lin=519 Escuela N7&s=vuelta">Cerri(Egreso por escuela 7) - Bahia Blanca</a></li>
    </ul>
  </li>
  <li><a href="' . $id . '.php">519 A</a>
   <ul>
      <li><a href="' . $id . '.php?lin=519A&s=ida">P.Plaza - A.Romana</a></li>
	  <li><a href="' . $id . '.php?lin=519A Por Patagonia&s=ida">P.Plaza - A.Romana (Por Patagonia)</a></li>
      <li><a href="' . $id . '.php?lin=519A&s=vuelta">A.Romana - P.Plaza (Por Patagonia)</a></li>
      <li><a href="' . $id . '.php?lin=519A Por Patagonia&s=vuelta">A.Romana - P.Plaza</a></li>
	   <li><a href="' . $id . '.php">Prolongacion RONDIN</a>
	      <ul>
           <li><a href="' . $id . '.php?lin=519A P. Bordeu&s=ida">P.Plaza - Bordeu</a></li>
		   <li><a href="' . $id . '.php?lin=519A P. Bordeu&s=vuelta">Bordeu - P.Plaza</a></li>
		 </ul></li>
    </ul>
  </li>
</ul>
</div><!--suckerdiv-->';
return $datos;
}

function menues($id)
{ $datos = '<script type="text/javascript">

var menuids=["suckertree1"]; 

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
	
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
		if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
			ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
		else //else if this is a sub level submenu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }

    }
		for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
		ultags[t].style.visibility="visible"
		ultags[t].style.display="none"
		}
  }
}

var Url = location.href;
Url = Url.replace(/.*\?(.*?)/,"$1");
Variables = Url.split ("&");
for (i = 0; i < Variables.length; i++) {
       Separ = Variables[i].split("=");
       eval (\'var \'+Separ[0]+\'="\'+Separ[1]+\'"\');
}';

if ($id=='recorridos') { $datos .= 'MostrarRecorrido(lin,s);</script>';}
              else     { $datos .= 'mostrar(lin,s);</script>';}

return $datos;
}

function inicio()
{$datos = '<script type="text/javascript">
           if (window.addEventListener)
             window.addEventListener("load", buildsubmenus, false)
          else if (window.attachEvent)
             window.attachEvent("onload", buildsubmenus);
			 </script>';
return $datos;


}


function cuerpo1($nombre)
{   
	$datos  = '';
    $datos .= encabezado();
    $datos .= menues($nombre);
	$datos .= inicio();
	$datos .= '<body><div id="contenedor">';
	$datos .= Pub($nombre);
	$datos .= '<div id="centro">';
	$datos .= cabecera();
	$datos .= Menu();
	$datos .= '<div id="medio">';
	$datos .= '<div id="lateral">';
	$datos .= Lateral($nombre);
	$datos .= '</div>';
	$datos .= '<div id="mapa"></div><!--mapa--></div>';
	$datos .= pie();

	return $datos;
}

function FormularioConsulta()
{
	$datos = '<form action="contacto.php" method=post>
<table style="WIDTH: 500px; HEIGHT: 400px; font-family: 408; font-size: 10px; cellspacing=0 cellpadding=5 width=649 align=center border=0">
  <tr>
   <td width="0">
     <table width="827" style="WIDTH: 500px; font-family: 408; font-size: 10px; color: #000000;  cellspacing=0 cellpadding=5 width=649 align=center border=0">
       <tbody>
	     <tr>
		   <td colspan="3" align=left>Nombre:</td>
           <td width=520 height=25><input name=nombre size=32 /></td> 
		 </tr>
		 <tr>
		    <td colspan="3" align=left>Apellido:</td>
			<td width=520 height=31><input name=apellido size=32 /></td>
		 </tr>
		 <tr>
		    <td colspan="3" align=left>Email: </td>
			<td width=520 height=25><input name=email size=32 /></td>
		 </tr>
		 <tr>
		    <td colspan="3" align=left>Asunto: </td>
			<td width=520 height=25><input name=titulo size=32 /></td>
		 </tr>
		 <tr>
            <td colspan="3" rowspan="2" align=left valign=top>Consulta: </td>
			<td height=54 colspan=3 align="left"><textarea name="consulta" cols="50" rows="6" height= 100px></textarea></td>
		 </tr>
		 <tr>
		     <td colspan="3" rowspan="2" align=left valign=top>
			   <input name="Submit" type="submit" value="Enviar Consulta" />
			   <input name="Reset" type="reset" value="Blanquear" />
			 </td>
		 </tr>
	   </tbody>
	  </table>
	 </td>
   </tr>
 </table>
</form>
';

return $datos;
}

function ContactoInic()
{   
	$datos  = '';
    $datos .= encabezado();
   	$datos .= '<body><div id="contenedor">';
	$datos .= '<div id="centro">';
	$datos .= cabecera();
	$datos .= Menu();
	$datos .= '<div id="contac">';

 return $datos;

}

function ContactoFinal(){

    $datos .= '</div><!--Contac-->';
	$datos .= pie();
    $datos .= '</div><!--centro--></div><!--contenedor--></body></html>';
	return $datos;
}


function finalizar()
{
  $datos = '</div><!--centro--></div><!--contenedor--></body></html>';

  return $datos;
 }
?>