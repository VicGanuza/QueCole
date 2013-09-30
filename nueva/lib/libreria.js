var marcaOrig, marcaDest;
var coordI,LatLng,radio;
var geocoder;
var ParadasOrigen=[];
var ParadasDest=[];
var RecoCole=[];
var RecoPie=[];
var cart='';
var directionsService;
var stepDisplay;
var linea;
var inicio,fin;
var opc="";
var pri=0;

function BorrarSuperposiciones()
{
  for (i=0;i<ParadasOrigen.length ;i++ )
	{ ParadasOrigen[i].setMap(null);}
	
  for (i=0;i<ParadasDest.length ;i++ )
	{ ParadasDest[i].setMap(null);}

  for (i=0;i<RecoCole.length ;i++ )
	{ RecoCole[i].setMap(null);}
 
  for (i=0;i<RecoPie.length ;i++ )
	{ RecoPie[i].setMap(null);}

}// BorrarSuperposiciones

function BorrarArreglos()
{
  for (var i = 0; i < ParadasOrigen.length; i++)
	{delete ParadasOrigen[i];}
  ParadasOrigen.length = 0;

  for (var i = 0; i < ParadasDest.length; i++)
	{delete ParadasDest[i];}
  ParadasDest.length = 0;

  for (var i = 0; i < RecoCole.length; i++)
	{delete RecoCole[i];}
  RecoCole.length = 0;

  for (var i = 0; i < RecoPie.length; i++)
	{delete RecoPie[i];}
  RecoPie.length = 0;

 
}//borrarArreglos

function Limpiar(lin)
{
	BorrarSuperposiciones();
    BorrarArreglos();
	
	cart = '';
	

}//Limpiar


function DefinirIcono(linea)
{
var image = new google.maps.MarkerImage("http://chart.apis.google.com//chart?chst=d_tr&chld=r|bus|" + linea + "|ffffff|0000ff|0000ff|2",
      // This marker is 20 pixels wide by 32 pixels tall.
      new google.maps.Size(68, 28),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole at 0,32.
      new google.maps.Point(0, 28));
	
return image;
}//DefinirIcono()


function DefinirLlegada()
{
var image = new google.maps.MarkerImage('../images/chart.png',
      // This marker is 20 pixels wide by 32 pixels tall.
      new google.maps.Size(30, 30),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole at 0,32.
      new google.maps.Point(0, 30));
	
return image;
}//DefinirLlegada()


function initialize() 
{	
	counter = 0;
	document.getElementById('cantCuad').value=4; 
    directionsService = new google.maps.DirectionsService();
	stepDisplay = new google.maps.InfoWindow();
	geocoder = new google.maps.Geocoder();
	
	google.maps.event.addListener(map, 'click', function(event)
	{opc="";
	 pri=0;

     if (counter==0)
      {coordI=event.latLng; 
	   
	    geocoder.geocode({'latLng': coordI}, function(results, status) {
         if (status == google.maps.GeocoderStatus.OK) { var dire  = results[0].formatted_address.split (",");
			                                            document.getElementById("direOrigen").value = dire[0];} });

	   if (marcaOrig) {marcaOrig.setMap(null);}
	   marcaOrig = new google.maps.Marker({
                                           position: coordI, 
                                           icon: '../images/Desde.png',
										   map: map
		                                 });
	   counter=1;
       }
	 else{
         LatLng=event.latLng;

		  geocoder.geocode({'latLng': LatLng}, function(results, status) {
         if (status == google.maps.GeocoderStatus.OK) { var dire  = results[0].formatted_address.split (",");
			                                            document.getElementById("direDest").value = dire[0];} });

		 if (marcaDest) {marcaDest.setMap(null);}
	     marcaDest = new google.maps.Marker({
                                           position: LatLng, 
										   icon: '../images/Hasta.png',
                                           map: map
		                                 });
	    counter=0;
	    radio = 4;
        
		PasanCerca(coordI,LatLng,radio,0);
		
	    }//else
	      
	});//event
	
	}//initialize()

function BuscarLocaciones()
  {  
	var DOrig = document.getElementById("direOrigen").value + ", Bahia Blanca, Buenos Aires, Argentina";
	var DDest = document.getElementById("direDest").value + ", Bahia Blanca, Buenos Aires, Argentina";
	    radio = document.getElementById('cantCuad').value; 
		opc="";
		pri=0;

	geocoder.geocode( { 'address': DOrig},function(origen, status) {
      if (status == google.maps.GeocoderStatus.OK) 
		  {
		     geocoder.geocode( { 'address': DDest},function(destino,status2){
             if (status2 == google.maps.GeocoderStatus.OK) 
		        { 
                   if (marcaOrig) { marcaOrig.setMap(null);}
				
				   marcaOrig = new google.maps.Marker({
                                                       position: origen[0].geometry.location, 
                                                       icon: '../images/Desde.png',
                                                       map: map
													   });//marcaOrig
				
		           if (marcaDest) { marcaDest.setMap(null);}

				   marcaDest = new google.maps.Marker({
                                                       position: destino[0].geometry.location, 
                                                       icon: '../images/Hasta.png',
                                                       map: map
													   });//marcadest

				

					coordI = origen[0].geometry.location;
					LatLng = destino[0].geometry.location;
					
					PasanCerca(coordI,LatLng,radio,0);
					}//if status2
					});//geocode destino
				}//if status		   
	});//geocode origen
 }//BuscarLocaciones

 
function MostrarCombinacion(linea, parO, parD, parOrig,parDest, sent, desde, hasta)
{
	var icono = DefinirIcono(linea);
	var paradaOrig = new google.maps.Marker({
                                           position: parOrig,
										   icon: icono,
                                           map: map
		                                 });

   ParadasOrigen.push(paradaOrig); 
           
	var sUrl = 'xml/xmlRecoDesdeHasta.php?lin=' + linea + '&ParO=' + parO + '&ParD=' + parD + '&s=' + sent;

	downloadUrl(sUrl, function(data1)
	 {  var p=[];
	    var xml1 = parseXml(data1);
        var reco = xml1.documentElement.getElementsByTagName("recorrido");
		for (l=0;l<reco.length;l++)
	     { var latitud=reco[l].getAttribute("Lat");
	       var longitud=reco[l].getAttribute("Long");
	       var punto = new google.maps.LatLng(latitud,longitud);
		   p.push(punto);
		  } //for

	    var linea = new google.maps.Polyline({
                                                 path: p,
												 map: map,
		 				                         strokeColor: "#AD51E6",
                                                 strokeOpacity: 1.0,
                                                 strokeWeight: 2
                                              }); //linea

     	RecoCole.push(linea);
		
		
      }); //download (sUrl)
	   
	 
}//MostrarCombinacion()


function BuscarCombinaciones(desde,hasta,dist,lor,ldet)
{
Limpiar(lor);
var latPlaz =  -38.71900114221921;
var lngPlaz = -62.26432800292969;
var Plaza = new google.maps.LatLng(latPlaz,lngPlaz);

var UrlOrigen = 'xml/xmlPasanLineas.php?latI=' + desde.lat() + '&lngI=' + desde.lng() + '&latD=' + latPlaz + '&lngD=' + lngPlaz + '&radius=' + dist + '&l=' + lor; 
var UrlDestino = 'xml/xmlPasanLineas.php?latI=' + latPlaz + '&lngI=' + lngPlaz + '&latD=' + hasta.lat() + '&lngD=' + hasta.lng() + '&radius=' + dist + '&l=' + ldet;

downloadUrl(UrlOrigen, function(datos)
	  { 
	     var xml = parseXml(datos);
         var origen = xml.documentElement.getElementsByTagName("pasa_por_ambas");

		 downloadUrl(UrlDestino, function(dato)
		  {
			 var xmlD = parseXml(dato);
			 var destino = xmlD.documentElement.getElementsByTagName("pasa_por_ambas");

			 var nro=0;

			 for (i=0; i<origen.length ;i++ )
			 {	
				 var lOrig = origen[i].getAttribute("Linea");
				 var parO = origen[i].getAttribute("PosO");
		         var parPla = origen[i].getAttribute("PosD");
		         var LatOr = origen[i].getAttribute("OriLat");
		         var LngOr = origen[i].getAttribute("OriLng");
		         var LatPlaz = origen[i].getAttribute("DestLat");
		         var LngPlaz = origen[i].getAttribute("DestLng");
		         var sent1= origen[i].getAttribute("Sent");

			     var parOrig = new google.maps.LatLng(LatOr,LngOr);
				 var parPlaza = new google.maps.LatLng(LatPlaz,LngPlaz);
					
				 Ir_Caminando(desde,parOrig,0);
				 MostrarCombinacion(lOrig,parO,parPla,parOrig,parPlaza,sent1,desde,Plaza);

				 for (j=0; j<destino.length ;j++)
				 {
					 var lDest = destino[j].getAttribute("Linea");
					 var parP = destino[j].getAttribute("PosO");
					 var parD = destino[j].getAttribute("PosD");
					 var LatP = destino[j].getAttribute("OriLat");
					 var LngP = destino[j].getAttribute("OriLng");
					 var LatD = destino[j].getAttribute("DestLat");
					 var LngD = destino[j].getAttribute("DestLng");
					 var sent2= destino[j].getAttribute("Sent");

					 var parPlaza2 = new google.maps.LatLng(LatP,LngP);
					 var parDest = new google.maps.LatLng(LatD,LngD);

					 Ir_Caminando(parPlaza,parPlaza2,1);

					 MostrarCombinacion(lDest,parP,parD,parPlaza2,parDest,sent2,Plaza,hasta);

					 Ir_Caminando(parDest,hasta,1);

					 c=lOrig + " - " + lDest;	
      				 GenerarHorarios(lOrig,parO,sent1,c);

				 }//for destino

			 }//for origen

		  });//download UrlDestino
	
	 });//download UrlOrigen

}//BuscarCombinaciones

 function PasanCerca(desde,hasta,distancia,l)
  { Limpiar(l);
    var radius=distancia/10000; 
    var c="";

	var searchUrl = 'xml/xmlPasanLineas.php?latI=' + desde.lat() + '&lngI=' + desde.lng() + '&latD=' + hasta.lat() + '&lngD=' + hasta.lng() + '&radius=' + radius + '&l=' + l + '&tip=1';
	
    downloadUrl(searchUrl, function(data)
	  {  var xml = parseXml(data);
         var pasa = xml.documentElement.getElementsByTagName("pasa_por_ambas");

		 if (pasa.length == 0) { alert("Debe hacer combinaciones de lineas");
		                         BuscarCombinaciones(desde,hasta,radius,0,0);}

		 for (v=0;v<pasa.length ;v++ )
		  {var linea = pasa[v].getAttribute("Linea");
		   var parO = pasa[v].getAttribute("PosO");
		   var parD = pasa[v].getAttribute("PosD");
		   var LatOr = pasa[v].getAttribute("OriLat");
		   var LngOr = pasa[v].getAttribute("OriLng");
		   var LatDe = pasa[v].getAttribute("DestLat");
		   var LngDe = pasa[v].getAttribute("DestLng");
		   var sent= pasa[v].getAttribute("Sent");

		   var nro = v+1;

		   var parOrig = new google.maps.LatLng(LatOr,LngOr);
		   var parDest = new google.maps.LatLng(LatDe,LngDe);

		   Mostrar(linea, parO, parD, parOrig,parDest, sent, desde, hasta);
			
		   GenerarHorarios(linea,parO,sent,c);


		  } //for
	  
	  }); //download (searchUrl)
	
      
  }  //PasanCerca()

function Mostrar (linea, parO, parD, parOrig,parDest, sent, desde, hasta)
{ 
	Ir_Caminando(desde,parOrig,0);
    Ir_Caminando(parDest,hasta,1);

	var icono = DefinirIcono(linea);
	var paradaOrig = new google.maps.Marker({
                                           position: parOrig,
										   icon: icono,
                                           map: map
		                                 });

   ParadasOrigen.push(paradaOrig); 
           
	var sUrl = 'xml/xmlRecoDesdeHasta.php?lin=' + linea + '&ParO=' + parO + '&ParD=' + parD + '&s=' + sent;

	downloadUrl(sUrl, function(data1)
	 {  var p=[];
	    var xml1 = parseXml(data1);
        var reco = xml1.documentElement.getElementsByTagName("recorrido");
		for (l=0;l<reco.length;l++)
	     { var latitud=reco[l].getAttribute("Lat");
	       var longitud=reco[l].getAttribute("Long");
	       var punto = new google.maps.LatLng(latitud,longitud);
		   p.push(punto);
		  } //for

	    var linea = new google.maps.Polyline({
                                                 path: p,
												 map: map,
		 				                         strokeColor: "#AD51E6",
                                                 strokeOpacity: 1.0,
                                                 strokeWeight: 2
                                              }); //linea

     	RecoCole.push(linea);
		
		
      }); //download (sUrl)
	   
	 
}//Mostrar()


function Ir_Caminando(Inicio,Fin,lleg)
{
 var pasos =[];

  var rendererOptions = {
                         map: map
                        }
  var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions)

  var request = {
                  origin: Inicio,
                  destination: Fin,
                  travelMode: google.maps.TravelMode.WALKING
                 };

  directionsService.route(request, function(response, status) {
   var ruta = response.routes[0].legs[0];
   if (status == google.maps.DirectionsStatus.OK) {  
	                                                var info = '';
                                                   
													for (var i = 0; i < ruta.steps.length; i++)
													 { for (var j = 0; j < ruta.steps[i].lat_lngs.length; j++)
														{ pasos.push(ruta.steps[i].lat_lngs[j]);
														} //for j
													   info = info + '<br>' + ruta.steps[i].instructions;
													 } //for i
													 if (lleg)
                                                     { var IcLleg = DefinirLlegada();
         
                                                       var paradaDest = new google.maps.Marker
															                       ({
                                                                                     position: Inicio,
	                                                                                 icon:  IcLleg,
											                                         map: map
		                                                                           }); //paradaDest
													
													   google.maps.event.addListener(paradaDest, 'click', function() { stepDisplay.setContent(info);
                                                                                                                        stepDisplay.open(map, paradaDest);
                                                                                        }); //Event

													   ParadasDest.push(paradaDest);
														
                                                       }//if
                                                    }//Status OK
    var cami = new google.maps.Polyline(
        {
            path: pasos,
			map:map,
            strokeColor: "black",
            strokeOpacity: 0.5,
            strokeWeight: 2    
        }
    );//Polyline
 
   RecoPie.push(cami);                                                														
  });//directionsService.route

}//Ir_Caminando()


function GenerarHorarios(linea,pO,sent,c)
{	
	var searchUrl = 'xml/xmlpar.php?lin=' + linea + '&s=' + sent + '&id=' + pO;
	
	downloadUrl(searchUrl, function(datas)
	  {
		var xml = parseXml(datas);
        var capturas = xml.documentElement.getElementsByTagName("parada");
		var distan=capturas[0].getAttribute("Distancia");
		var D=Math.floor(distan);
        var tiempo=D*3/1000;
        var t=Math.floor(tiempo); 
		
		Generarcartel(linea,sent,t,c);
		
	  });  //downloadUrl(searchUrl)

}//GenerarHorarios()

function Generarcartel(Linea,Sent,tiempo,c)
  {
  var horaActual= new Date();
  var dia=horaActual.getDay();
  var hora=horaActual.getHours();
  var minutos=horaActual.getMinutes();
  var dias="";
  var cartel="";
  if ((dia>=1)&(dia<=5)){dias="Dias Habiles";}
    else {if (dia==6) {dias="Sabado";}
        else {dias="Domingo";}
	  }
    
 var h=Math.floor(tiempo/60);
 var m=tiempo%60;
 var cambio=24-hora;
 var minuinicial=minutos-m;
 if (minuinicial<0){var horainicial=hora-1;
                        minuinicial=60+minuinicial;
                        horainicial=horainicial-h;
 if(horainicial<0){horainicial=24+horainicial;}
						}
             else { var horainicial=hora-h;
 if(horainicial<0){horainicial=24+horainicial;}
		       }

 var sUrls = 'xml/xmlhorarios.php?lin=' + Linea + '&s=' + Sent + '&hora=' + horainicial + '&min=' + minuinicial + '&dia=' + dias;
 
 downloadUrl(sUrls, function(data2) 
   {
      var xml2=parseXml(data2);
	  var arreglohoras=xml2.documentElement.getElementsByTagName("horario");
		
	  if (arreglohoras.length != 0){
	   for (x=0;x<arreglohoras.length;x++)
		    { 
			 var opcion=x+1;
			 var DH=parseInt(arreglohoras[x].getAttribute("DifHora"),10);
			 var DM=parseInt(arreglohoras[x].getAttribute("DifMinu"),10);
			 var DifMin=(DH*60)+DM;
			 var NuevaHora=hora+DH;
			 var NuevoMinuto=minutos+DM;
			 if (NuevoMinuto>=60){NuevoMinuto=NuevoMinuto-60;
			                     NuevaHora=NuevaHora+1;
								}
			 if (NuevaHora>=24){NuevaHora=NuevaHora-24;}
		     if (NuevaHora<10) {NuevaHora="0"+NuevaHora;}
			 if (NuevoMinuto<10) {NuevoMinuto="0"+NuevoMinuto;}
			 if (x == 0){ if (c == ""){cartel = cartel + "<tr> <td>"+Linea+"</td>";
									   opc= opc + "<tr><td>"+Linea+"</td>";}
			                     else {cartel = cartel + "<tr> <td>"+c+"</td>";
									   opc= opc + "<tr><td>"+c+"</td>";
								        }
			             }
			       else {cartel = cartel + "<tr> <td></td>";}

			 cartel = cartel + "<td>" + opcion + ") "+ NuevaHora +":"+ NuevoMinuto +" </td> <td>(en "+ DifMin + " min) aprox.</td></th>";

			 if (x == 0) { if (c == ""){opc = opc + "<td><img src='img/ver-recorrido.png' alt='Ver Recorrido' title='Vea el recorrido en el mapa' onclick='VerRecorrido(\""+Linea+"\")'/></td></tr>"; }
			               else { opc = opc + "<td><img src='img/ver-recorrido.png' alt='Ver Recorrido' title='Vea el recorrido en el mapa' onclick='VerRecorrido(\""+c+"\")'/></td></tr>";} 
			              }
			       
			
			 }//for
 			cartel = cartel + "<tr><td></td><td></td><td></td></tr>";
		  }//else
  

		cart = cart + cartel;
	
		document.getElementById('HorariosParadas').innerHTML=cart;
		if (pri == 0) {document.getElementById('VerHorarios').innerHTML=opc;}
		
	});//downloadUrl
 
}//GenerarCartel

function VerRecorrido(l)
{  pri=1;
 
   var variables = l.split ("-");
   var tipo = variables.length;
 
   if (tipo == 1 )
    { var lin = variables[0];
	  BorrarSuperposiciones();
      PasanCerca(coordI,LatLng,radio,lin);
    }
   else 
	{
	    BorrarSuperposiciones();
	      var lin1 = variables[0];
	      var lin2 = variables[1];  
		  var l2 = lin2.split(" ");
		  lin2 = l2[1];
	      var dist = radio/10000;
		  BuscarCombinaciones(coordI,LatLng,dist,lin1,lin2);
	      }
}

function downloadUrl(url, callback) 
 {  var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;
 
    request.onreadystatechange = function() { if (request.readyState == 4) { request.onreadystatechange = doNothing;
                                                                             callback(request.responseText, request.status);
                                                                             }
                                              };
 
    request.open('GET', url, true);
    request.send(null);
 }
 
 function parseXml(str) 
 { if (window.ActiveXObject) 
     { var doc = new ActiveXObject('Microsoft.XMLDOM');
       doc.loadXML(str);
       return doc;
      }
  else if (window.DOMParser) { return (new DOMParser).parseFromString(str, 'text/xml'); }
  }
  
 
  function doNothing() {}

  function MostrarRecorrido(Lin,Sent)
{
	
  if (Sent=="ida")
     {var color = "#AD51E6"}
  else {var color = "#FF0000";}

  
  var p=[];

  var searchUrl = 'xml/xmlrecor.php?lin=' + Lin + '&s=' + Sent;

    downloadUrl(searchUrl, function(data)
	  {  var xml = parseXml(data);
         var puntos = xml.documentElement.getElementsByTagName("recorrido");
		 for (l=0;l<puntos.length;l++)
		  { var latitud=puntos[l].getAttribute("Lat");
		    var longitud=puntos[l].getAttribute("Long");
			var punto = new google.maps.LatLng(latitud,longitud);
			p.push( punto );
			if (l==0)
			{ var pI=punto;
			}
		     }
		  var pF=punto;
		 
		 inicio = new google.maps.Marker({ position: pI,
										   icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
										  }); 

		 fin = new google.maps.Marker({ position: pF,
										icon: 'http://labs.google.com/ridefinder/images/mm_20_yellow.png'
										}); 

         linea = new google.maps.Polyline({
                            path: p,
                            strokeColor: color,
                            strokeOpacity: 1.0,
                            strokeWeight: 2
                          });
         linea.setMap(map);
		 inicio.setMap(map);
		 fin.setMap(map);
		   }); 
		   
}

function mostrar(Linea,Sent)
{
 // document.getElementById('Cartel_Paradas').innerHTML = 'HOla';
//document.getElementById("").innerHTML="Linea: "+Linea+" Sentido: "+Sent;
	var searchUrl = 'xml/xmlpar.php?lin=' + Linea + '&s=' + Sent;

    downloadUrl(searchUrl, function(data)
	  {  var xml = parseXml(data);
          var capturas = xml.documentElement.getElementsByTagName("parada");
		  for (var i = 0; i < capturas.length; i++)
	        { var latitud=capturas[i].getAttribute("Lat");
		      var longitud=capturas[i].getAttribute("Long");
			  var distan=capturas[i].getAttribute("Distancia");
			  var pto=new google.maps.LatLng(latitud,longitud); 
			  
			  var D=Math.floor(distan);
              var tiempo=D*3/1000;
              var t=Math.floor(tiempo); 
			 
			  GenerarcartelParada(Linea,Sent,i,pto,t);
			 }
        
		  }); 
	  
 }

 function GenerarcartelParada(Linea,Sent,i,pto,tiempo)
  {
  var horaActual= new Date();
  var dia=horaActual.getDay();
  var hora=horaActual.getHours();
  var minutos=horaActual.getMinutes();
  var dias="";
  

  var cartel="Parada Nro: " + i+"\n";
  
  if ((dia>=1)&(dia<=5)){dias="Dias Habiles";}
    else {if (dia==6) {dias="Sabado";}
        else {dias="Domingo";}
	  }

 var h=Math.floor(tiempo/60);
 var m=tiempo%60;
 var cambio=24-hora;
 var minuinicial=minutos-m;
 if (minuinicial<0){var horainicial=hora-1;
                        minuinicial=60+minuinicial;
                        horainicial=horainicial-h;
 if(horainicial<0){horainicial=24+horainicial;}
						}
             else { var horainicial=hora-h;
 if(horainicial<0){horainicial=24+horainicial;}
		       }

 var sUrls = 'xml/xmlhorarios.php?lin=' + Linea + '&s=' + Sent + '&hora=' + horainicial + '&min=' + minuinicial + '&dia=' + dias;
 
 downloadUrl(sUrls, function(data2) 
   {
      var xml2=parseXml(data2);
	  var arreglohoras=xml2.documentElement.getElementsByTagName("horario");
		
	   if (arreglohoras.length==0){ cartel=cartel+"Finaliz\u00f3 con los recorridos por el d\u00eda de hoy. \n";
	                               }
	  else							
	   {
	    cartel=cartel+"Pr\u00f3ximos Arribos: \n";
	
	   for (x=0;x<arreglohoras.length;x++)
		    { 
			 var opcion=x+1;
			 var DH=parseInt(arreglohoras[x].getAttribute("DifHora"),10);
			 var DM=parseInt(arreglohoras[x].getAttribute("DifMinu"),10);
			 var DifMin=(DH*60)+DM;
			 var NuevaHora=hora+DH;
			 var NuevoMinuto=minutos+DM;
			 if (NuevoMinuto>=60){NuevoMinuto=NuevoMinuto-60;
			                     NuevaHora=NuevaHora+1;
								}
			 if (NuevaHora>=24){NuevaHora=NuevaHora-24;}
		     if (NuevaHora<10) {NuevaHora="0"+NuevaHora;}
			 if (NuevoMinuto<10) {NuevoMinuto="0"+NuevoMinuto;}
			 cartel=cartel+ opcion + ") "+ NuevaHora +":"+ NuevoMinuto +" (en "+ DifMin + " minutos) aprox.\n";
		
			 }
 			 cartel=cartel+"----------------------\n";
		  }  
  
      var  marker = new google.maps.Marker({
                                            position: pto,
                                            map:map,
			                                icon: 'http://maps.gstatic.com/mapfiles/transit/iw/3/bus.gif',
										    title: cartel
										     });
	});

}