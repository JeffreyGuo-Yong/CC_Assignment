// Create the script tag, set the appropriate attributes
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA3VcPkjXzHFDNM7iXyt0bw5xGtVtGM6Js&callback=initMap';
script.defer = true;
script.async = true;

// Append the 'script' element to 'head'
document.head.appendChild(script);

var map, marker;

function initMap(){
    /*
       create map
       use 'new google.maps.Map' and set first parameter is the 'div' which you want to show the map
       the second parameter is an array, which includes set initial position and map zoom
    */
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom:8
    });
    // create marker
    marker = new google.maps.Marker();
}

function getLocation(){
    /*
        judge the browser whether support get location
     */
    if(navigator.geolocation){
        // get current position
        navigator.geolocation.getCurrentPosition(function(position){

            // get latitude and longitude
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // set latlng array, follow the rules, set lat first, then set lng
            var latlng = {
                lat: latitude,
                lng: longitude
            }

            // create a marker
            // set marker position and set marker on which map
            marker.setPosition(latlng);
            marker.setMap(map);

            // set map position
            map.setCenter(latlng);
            map.setZoom(18);

            // use latitude and longitude to get address
            var geocoder = new google.maps.Geocoder();
            var address;

            geocoder.geocode({'location' : latlng}, function(result, state){
                if(state == 'OK'){
                    address = result[0].formatted_address;
                    document.getElementById('inputAddress').value = address;
                    document.getElementById('address').setAttribute('value', address);

                }else{
                    address = 'get address failed.';
                    document.getElementById('inputAddress').value = address;
                    document.getElementById('address').setAttribute('value', address);
                }
            });

            // set value on input
            document.getElementById('latitude').setAttribute('value', latitude);
            document.getElementById('longitude').setAttribute('value', longitude);
        });

    }else{
        alert("The browser cannot get location.")
    }
}

function searchAddress(){
    var address = document.getElementById('inputAddress').value;
    // create geocoder for get location by address which can enter by user
    var geocoder = new google.maps.Geocoder();
    // use geocode method, set first parameter is address
    geocoder.geocode({'address' : address}, function(result, state){
        // if get the location by address
        if(state == 'OK'){

            // get latitude and longitude and address
            var latitude = result[0].geometry.location.lat();
            var longitude = result[0].geometry.location.lng();
            var address = result[0].formatted_address;

            // set value on input
            document.getElementById('latitude').setAttribute('value', latitude);
            document.getElementById('longitude').setAttribute('value', longitude);
            document.getElementById('address').setAttribute('value', address);

            // create a marker
            // set marker position and set marker on which map
            marker.setPosition(result[0].geometry.location);
            marker.setMap(map);

            // set map position
            map.setCenter(result[0].geometry.location);
            map.setZoom(18);

        }else{
            alert("Get location failed");
        }
    })
}