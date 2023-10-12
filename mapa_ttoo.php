<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Capas</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container, iframe {
			height: 100%;
			width: 100%;
			max-width: 100%;
			max-height: 100%;
		}
	</style>
<style>
img.huechange { filter: hue-rotate(120deg); }
</style>
	
</head>
<body>
<?php
$fila = 1;
if (($gestor = fopen("coord.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
        $numero = count($datos);
       // echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
       $datos[$c] = str_replace(",", ".", $datos[$c]);
	   $coord[]=$datos[$c];
        }
    }
    fclose($gestor);
}

?>
<p>
    Distancia (km): <b><span id="distancias"></span></b>
</p>
<table style="width:100%;height:100%;"><tr>
<td id='map' style="width:50%;"></td><td>

<script>
var iconoBase = L.Icon.extend({
    options: {
       
	   iconSize:     [50, 50],
       shadowSize:   [50, 64],
		}
});
var justinia = new iconoBase({iconUrl: 'justinia.png'} );
var tirania = new iconoBase({iconUrl: 'tirania.png'} );
/*unidades._icon.classList.add("huechange");*/
const cities = L.layerGroup();
const bilbao = L.marker([43.29805556,-2.90638888888889],{icon: justinia}).bindPopup('LOCALIDAD: I Br. Ae. Bilbao<br>LATITUD: 43,3<br>LONGITUD: -3<br>ELEVACIÓN: 138FT').addTo(cities);
const compostela = L.marker([42.88805556,-8.41055555555556],{icon: justinia}).bindPopup('LOCALIDAD: II Br. Ae Santiago<br>LATITUD: 42,9<br>LONGITUD: -8,4<br>ELEVACIÓN: 1214FT').addTo(cities);
const torrejon = L.marker([40.48861111,-3.44361111111111],{icon: justinia}).bindPopup('LOCALIDAD: III Br. Ae. Torrejón<br>LATITUD: 40,5<br>LONGITUD: -3,4<br>ELEVACIÓN: 1991FT').addTo(cities);
const barcelona = L.marker([41.29277778,2.07],{icon: justinia}).bindPopup('LOCALIDAD: IV Br. Ae Barcelona<br>LATITUD: 41,3<br>LONGITUD: -2<br>ELEVACIÓN: 13FT').addTo(cities);
const zaragoza = L.marker([41.66055556,-1.00416666666667],{icon: justinia}).bindPopup('LOCALIDAD: V Br. Ae. Zaragoza<br>LATITUD: 41,2<br>LONGITUD: -1<br>ELEVACIÓN: 817FT').addTo(cities);
const asturias = L.marker([43.56694444,-6.04416666666667],{icon: justinia}).bindPopup('LOCALIDAD: BAM VI Asturias<br>LATITUD: 43,4<br>LONGITUD: -6<br>ELEVACIÓN: 417FT').addTo(cities);
const vittoria = L.marker([42.45222222,-2.33111111111111],{icon: justinia}).bindPopup('LOCALIDAD: BAM VIII Vitoria<br>LATITUD: 42,4<br>LONGITUD: -2,3<br>ELEVACIÓN: 1158FT').addTo(cities);
const vallaoid = L.marker([41.64083333,-4.75444444444444],{icon: justinia}).bindPopup('LOCALIDAD: BAM  VII Valladolid  <br>LATITUD: 41,6<br>LONGITUD: -4,8<br>ELEVACIÓN: 2411FT').addTo(cities);
const malaga = L.marker([36.66611111,-4.48222222222222],{icon: tirania}).bindPopup('LOCALIDAD: IV Br. Ae Málaga<br>LATITUD: 37<br>LONGITUD: -4,5<br>ELEVACIÓN: 16FT').addTo(cities);
const sevilla = L.marker([37.41666667,-5,87916666666667],{icon: tirania}).bindPopup('LOCALIDAD: II Br. Ae Morón<br>LATITUD: 37,4<br>LONGITUD: -5,9<br>ELEVACIÓN: 111FT').addTo(cities);
const mallorca = L.marker([39.55333333,2.625277778],{icon: tirania}).bindPopup('LOCALIDAD: III Br. Ae Mallorca<br>LATITUD: 39,5<br>LONGITUD: 2,6<br>ELEVACIÓN: 10FT').addTo(cities);
const albacete = L.marker([38.95416667,-1.85638888888889],{icon: tirania}).bindPopup('LOCALIDAD: BAM Albacete<br>LATITUD: 38,9<br>LONGITUD: -1,9<br>ELEVACIÓN: 2303FT').addTo(cities);
const granada = L.marker([37.18972222,-3.78944444444444],{icon: tirania}).bindPopup('LOCALIDAD: BAM Granada<br>LATITUD: 37,2<br>LONGITUD: -3,8<br>ELEVACIÓN: 1860FT').addTo(cities);
const alicante = L.marker([38.28277778,-0.570833333333333],{icon: tirania}).bindPopup('LOCALIDAD: V Br. Ae Alicante<br>LATITUD: 38,3<br>LONGITUD: -0,6<br>ELEVACIÓN: 141FT').addTo(cities);
const badajoz = L.marker([38.88333333,-6.81388888888889],{icon: tirania}).bindPopup('LOCALIDAD: I Br. Ae Badajoz<br>LATITUD: 38,9<br>LONGITUD: -6,8<br>ELEVACIÓN: 607FT').addTo(cities);
/*const mDenver = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities);
const mAurora = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities);*/
const mGolden = L.marker([<?php echo($coord[1])?>,<?php echo($coord[2])?>]).bindPopup('LOCALIDAD: <?php echo($coord[0])?><br>LATITUD: <?php echo(round($coord[1],2))?><br>LONGITUD: <?php echo(round($coord[2],2))?><br>ELEVACIÓN: <?php echo(ROUND($coord[3]*3.28084,0))?>FT').addTo(cities);


const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	minZoom: 3,
        maxZoom: 18
	//attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

 


const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
	minZoom: 3,
        maxZoom: 18
	//attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
});

const map = L.map('map', {
	center: [40.41194444,-3.67805555555556],
	zoom: 6,
	layers: [osm, cities]
});

const baseLayers = {
	'OpenStreetMap': osm,
	'OpenStreetMap.HOT': osmHOT
	};

const overlays = {
	'Cities': cities
};

const layerControl = L.control.layers(baseLayers, overlays).addTo(map);



const openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
	minZoom: 3,
        maxZoom: 18
	//attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
});
layerControl.addBaseLayer(openTopoMap, 'OpenTopoMap');
const ign=L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        minZoom: 3,
        maxZoom: 18
		  //attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
           });
layerControl.addBaseLayer(ign, 'IGN');
var firstLatLng,
      secondLatLng;
   
  map.on('click', function(e) {
    if (!firstLatLng) {
      firstLatLng = e.latlng;
        L.marker(firstLatLng,{
    draggable: false,
    autoPan: true
}).bindPopup('Punto A<br/>' + e.latlng).openPopup().addTo(map);
    } else {
      secondLatLng = e.latlng;
        L.marker(secondLatLng,{
    draggable: false,
    autoPan: true
}).addTo(map).bindPopup('Punto B<br/>' + e.latlng).openPopup();
    }


    if (firstLatLng && secondLatLng) {
      // Dibujamos una línea entre los dos puntos
      L.polyline([firstLatLng, secondLatLng], {
        color: 'red'
      }).addTo(map);

      medirDistancia();
    }
  })

  function medirDistancia() {
  	var distance = map.distance(firstLatLng ,secondLatLng);
    document.getElementById('distancias').innerHTML = Math.round(distance/1000,1);
  }
/*var myIcon = L.icon({
    iconUrl: 'mont.png',
    iconSize: [38, 95],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    shadowUrl: 'my-icon-shadow.png',
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});

L.marker([50.505, 30.57], {icon: myIcon}).addTo(map);*/
/*layerControl.addOverlay(parks, 'Parks');*/
</script>

<iframe src="https://www.aemet.es/es/serviciosclimaticos/datosclimatologicos/valoresclimatologicos"></td></tr></table>

</body>
</html>