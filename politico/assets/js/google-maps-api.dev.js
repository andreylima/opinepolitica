
//google maps api
var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };
  map = new google.maps.Map(document.getElementById('mapagv'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);