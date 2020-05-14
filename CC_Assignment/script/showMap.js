// Create the script tag, set the appropriate attributes
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA3VcPkjXzHFDNM7iXyt0bw5xGtVtGM6Js&callback=initMap';
script.defer = true;
script.async = true;

// Append the 'script' element to 'head'
document.head.appendChild(script);

function initMap(){
    // get latitude and longitude and change to float
    var latitude = parseFloat(document.getElementById('latitude').value);
    var longitude = parseFloat(document.getElementById('longitude').value);

    /*
       create map
       use 'new google.maps.Map' and set first parameter is the 'div' which you want to show the map
       the second parameter is an array, which includes set initial position and map zoom
    */
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: latitude, lng: longitude},
        zoom:18
    });

    // create marker
    var marker = new google.maps.Marker();

    // set latlng array, follow the rules, set lat first, then set lng
    var latlng = {
        lat: latitude,
        lng: longitude
    }

    // create a marker
    // set marker position and set marker on which map
    marker.setPosition(latlng);
    marker.setMap(map);
}