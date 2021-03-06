
//google maps api

jQuery(document).ready(function(){

var map;
var reclamacoes;


function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(-18.8595948, -41.9529012),
    maxWidth: 500
  };
  map = new google.maps.Map(document.getElementById('mapagv'),
      mapOptions);
  map.setOptions(mapOptions);

 put_markers_on_map(map);


}

google.maps.event.addDomListener(window, 'load', initialize);


function initialize2() {

var animation = google.maps.Animation.BOUNCE;
var position = new google.maps.LatLng(-18.8595948, -41.9529012);
  var mapOptions = {
    zoom: 13,
    center: position,
    scrollwheel: false,

  };
  map = new google.maps.Map(document.getElementById('mapagv-register'),
      mapOptions);

  marker = new google.maps.Marker({
      map:map,
      draggable: true,
      animation: animation,
      position: position
  });

    var $addressInput = jQuery('.search-adress')[0];
  var searchOptions = {
    componentRestrictions: {country: 'br'}
  };

  var autoComplete = new google.maps.places.Autocomplete($addressInput, searchOptions);
  autoComplete.bindTo('br', map);

  google.maps.event.addListener(autoComplete, 'place_changed', function() {
    geocodePosition(autoComplete.getPlace().geometry.location);
    if(marker) {
      map.setCenter(autoComplete.getPlace().geometry.location);
      map.setZoom(14);
      marker.setPosition(autoComplete.getPlace().geometry.location);
    }
  });

  google.maps.event.addListener(marker, 'dragend', function(){
    geocodePosition(marker.position);
    marker.setAnimation(null);
  });

}

google.maps.event.addDomListener(window, 'load', initialize2);

function initialize3() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(-18.8595948, -41.9529012),
    scrollwheel: false,
  };
  map = new google.maps.Map(document.getElementById('map-single'),
      mapOptions);
  map.setOptions(mapOptions);

put_marker_single(map);


}

google.maps.event.addDomListener(window, 'load', initialize3);

var geocodePosition = function(pos){
  var city;
  var bairro = null;
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({
      latLng: pos
  },function(results, status) {
    if (status == google.maps.GeocoderStatus.OK){
      if(map){
        jQuery('#lat').val(results[0].geometry.location.lat());
        jQuery('#lng').val(results[0].geometry.location.lng());
        jQuery('#addressField').val(results[0].formatted_address);
        jQuery('.active-adress').addClass('active').html('<span class="icon map-marker"></span> &nbsp;'+results[0].formatted_address);
      }

      var arrAddress = results[0].address_components;
      jQuery.each(arrAddress, function (i, address_component) {
        if (address_component.types[0] == "locality")  //"route", "country", "postal_code_prefix", "street_number"
            city = address_component.long_name;
            jQuery('#city').val(city);
      });

      bairro = results[0].address_components[2].long_name;
      if(bairro == city)
        bairro = results[0].address_components[3].long_name;

      var estado = jQuery('#state-name').val();
      if(bairro == estado)
        bairro = null;

      if(bairro)
        jQuery('#reclamacao_bairro').val(bairro);
    }else
      jQuery("#dragMap").append('Não foi possível determinar sua localização'+status);
  });
}



var reclamacao_completa = [];
var response;

var put_markers_on_map = function(map){


  jQuery.ajax({
    type: 'POST',
    url: myAjax.ajaxurl,
    data: 'action=get_reclamacoes',
    success: function(response) {

    response = JSON.parse(response);
    reclamacao_completa = response;
    add_markers(response, map);

    }


});

}


var put_marker_single = function(map){


  jQuery.ajax({
    type: 'POST',
    url: myAjax.ajaxurl,
    data: 'action=get_reclamacao',
    success: function(response) {

    response = JSON.parse(response);
    reclamacao_completa = response;

    add_markers(response, map);

    }


});

}




var markers = [];

function add_markers(response, map)
{

  var infoWindowList = [];
  var j;
   markers = [];
 var markersList = jQuery('#reclamacao_list');
 markersList.html('');

  for (var i=0,len=response.length; i < len; i++) {
    var current = response[i];
    var pin = ((current.situacao_reclamacao == "resolvida") ? "pin_2" : "pin_1") ;
    var situacao = ((current.situacao_reclamacao == "resolvida") ? "Resolvida" : "Não Resolvida") ;
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(current.latitude, current.longitude),
      map: map,
      icon: templateDir+'/assets/img/'+pin+'.png',
    });


    var date = current.data.split('/'),
        orderedDate = [date[1], date[0], date[2]],
        infowindow = new google.maps.InfoWindow({maxWidth: 300}),
        htmlContent = '<div class="hc-info-window">'
        +  '<h4 class="hc-info-title"><a  href="'+current.permalink+'">'+current.titulo+'</a></h4>'
        +  '<a  href="'+current.permalink+'"><span class="flaticon-pin56 local-reclamacao">&nbsp;'+current.local_reclamacao+'</span></a>'
        + '<a  href="'+current.permalink+'" class="image-reclam-link"><img src="'+current.link_imagem+'" alt="'+current.titulo+'" class="imagem-reclamacao"></a>'
        +  '<div class="hc-info-box">'
        +  '<label for="data-reclamacao">Data da Reclamação:</label>'
        +  '<h6 class="flaticon-calendar146 data-reclamacao">&nbsp;'+orderedDate.join('/')+'</h6>'
        +  '<label for="situacao_reclamacao" class="situacao-label">Situação:</label>'
        + '<input type="text" name="situacao_reclamacao" value="'+situacao+'" id="situacao_reclamacao" disabled>'
        + '<a  href="'+current.permalink+'" class="qtd-comments-reclamacao" ><div class="flaticon-comments16 ">'+current.qtd_comments_reclamacao+'</div></a>'
        +  '<a href="'+current.permalink+'" class="button-info-reclamacao">+ Ver Comentários</a></div>'
        +  '</div>';

    markers.push(marker);
    infowindow.setContent(htmlContent);
    infoWindowList.push(infowindow);

    google.maps.event.addListener(marker, 'click', (function(marker, j) {

      return function () {

        infoWindowList.map(function(el,id,arr){ el.close(); });
        infoWindowList[markers.indexOf(marker)].open(map, marker);
      }
    })(marker, j));

  var lastReport = buildLastReportContent(current, date, i);
    markersList.append(lastReport);
    jQuery('.list_lines').on('click', function(e) {
      var $anchor = jQuery(this),
          index = $anchor.data('index');
      console.log(index);
      google.maps.event.trigger(markers[index], 'click');
    });

   }





}

var buildLastReportContent = function(report, date, index) {

  orderedDate = [date[1], date[0], date[2]]
  var htmlContent = '<li><a class="list_lines" data-index="'+index+'">'
    + '<div class="">'
    + '<h4>'+report.titulo+'</h4>'
    + '<h5>'+report.local_reclamacao+'</h5>'
    + '<h5><i class="icon-calendar"></i>'+orderedDate.join('/')+'</h5>'
    + '</div>'
    + '</a></li>';

  return htmlContent;
}






var reclamacoes_por_bairros = [];

function filter_bairros(bairro)
{

reclamacoes_por_bairros = [];

  for (var i=0,len=reclamacao_completa.length; i < len; i++) {
  var current = reclamacao_completa[i];
    if (current.bairro_reclamacao == bairro )
    {

      reclamacoes_por_bairros.push(current);

    }



 }


setAllMap(null);

add_markers(reclamacoes_por_bairros, map)
// alert(reclamacoes_por_bairros);




}


function setAllMap(map) {



  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

function setmarkers()
{
  setAllMap(null);
  markers = reclamacao_completa;

  add_markers(markers, map);

}


jQuery("#bairro_reclamacao").change(function(){

if (this.value == '') {
setmarkers()

}
else
{

  filter_bairros(this.value);
}



});

jQuery("#show_all").click(function(){  setmarkers()  });
















});