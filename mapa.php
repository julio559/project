
<script
sc_lookup(data_coord,“SELECT propriedade,latitude,longitude FROM geolocalizacao ORDER BY id DESC LIMIT 0,47”);
$wpt = {data_coord[0][0]};
$latitude = {data_coord[0][1]};
$longitude = {data_coord[0][2]};

$_head = "

Simple Map html, body, #map-canvas { margin: 0; padding: 0; height: 100%; } //// E aqui começa o problema... function initialize() { " for($x=0;$x<$contador;$x++) { $latitude = {ds[$x][0]}; $longitude = {ds[$x][1]};" var myLatlng = new google.maps.LatLng(".$latitude.",".$longitude."); "}"
var mapOptions = {
zoom: 15,
center: myLatlng
}
var map = new google.maps.Map(document.getElementById(‘map-canvas’), mapOptions);

var marker = new google.maps.Marker({
position: myLatlng,
map: map,
title: ‘Hello World!’
});
}

google.maps.event.addDomListener(window, ‘load’, initialize);


?>


