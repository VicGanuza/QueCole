<html>
 
<head>

<title>Qtip content</title>
 
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>
 
// Create the first tooltip
 
<script type="text/javascript">
// Create the tooltips only on document load
/*$(document).ready(function() 
{
   // By suppling no content attribute, the library uses each elements title attribute by default
   $('#content h3').qtip({
      // Simply use an HTML img tag within the HTML string
      content: 'let´s see'
   });
});*/

$(document).ready(function() 
{

// A shared object containing all the values you want shared between your tooltips
var shared = {
	position: {
		my: 'top left', 
		at: 'bottom right',
	},
	show: 'click',
	hide: 'click',
	style: {
		tip: true
	}
};

 var shared1 = {
	position: {
		my: 'left', 
		at: 'right',
	},
	show: 'mouseover',
	hide: 'mouseout',
	style: {
		tip: true
	}
};
// Setup our first tooltip, adding some other options
$('#content .imagen1').qtip( $.extend({}, shared, { 
	content: 'An example tooltip (Imagen 1)',
	style: {
		classes: 'ui-tooltip-red'
	}
}));

$('#content .imagen1').qtip( $.extend({}, shared1, { 
	content: 'Imagen 1',
	style: {
		classes: 'ui-tooltip-red'
	}
}));
 
// Setup our second tooltip, again adding some new options
$('#content .imagen2').qtip( $.extend({}, shared, { 
	content: 'Another example tooltip (Imagen2)',
	style: {
		classes: 'ui-tooltip-dark'
	}
}));
$('#content .imagen2').qtip( $.extend({}, shared1, { 
	content: 'Imagen 2',
	style: {
		classes: 'ui-tooltip-red'
	}
}));
});


</script>
 
 
</head>
 
<body>
 
 
 
<div id="content">
 
 	<div class="imagen1"><img  src="img/icons/laptop.png" style="vertical-align: middle;margin-left: 18px;" border="0" alt="Smile" /></div>
	<div class="imagen2"><img  src="img/icons/globe.png" style="vertical-align: middle;margin-left: 18px;" border="0" alt="Smile" /></div>


</div>
 
 
 
 
 
   </body>
   </html>