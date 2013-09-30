<?php
include ('lib/lib.php');

$nom = "recorridos";
print cuerpo1($nom);

?>

<script type="text/javascript">


var latlong = new google.maps.LatLng(-38.71900114221921,-62.26432800292969);
var opciones = { zoom: 13,
	             center: latlong,
	             mapTypeId: google.maps.MapTypeId.ROADMAP
                 };
var map = new google.maps.Map(document.getElementById("mapa"), opciones);

</script>

<?php
print finalizar();
?>