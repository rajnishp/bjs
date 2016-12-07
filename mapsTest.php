<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 12/2/16
 * Time: 11:05 PM
 */
?>
<html>
<head>
    <style>
        body,
        html,
        #map {
            height: 100%;
            margin: 0;
        }

        #map .centerMarker {
            position: absolute;
            /*url of the marker*/
            background: url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
            /*center the marker*/
            top: 50%;
            left: 50%;
            z-index: 1;
            /*fix offset when needed*/
            margin-left: -10px;
            margin-top: -34px;
            /*size of the image*/
            height: 34px;
            width: 20px;
            cursor: pointer;
        }

    </style>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
            margin: 0;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        #target {
            width: 345px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>--><!--
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBVq_N_uJLaBm3pYRIZfz3gy-7A-iqFfTg&.js&libraries=places"></script>-->
</head>


<body>
<button id="map-button">Get My Location</button>
<input type="text" id="default_latitude" placeholder="Latitude"/>
<input type="text" id="default_longitude" placeholder="Longitude"/>
<input id="pac-input" class="controls" type="text" placeholder="Search Box">

<div id="map"></div>





<script>
    $(document).ready(function(){
        $("#map-button").click(function(){
            $("#map").toggle(1000);
        });
    });
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete1() {
        if (navigator.geolocation) {
            console.log("got location");
            navigator.geolocation.getCurrentPosition(initAutocomplete1);
        } else {
            console.log("failed to get coordinate");
            initAutocomplete1(position);
            //x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }



    function initAutocomplete() {


        var map = new google.maps.Map(document.getElementById('map'), {
            center:  {lat:28.4595,lng:77.0266},
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        google.maps.event.addListener(map,'center_changed', function() {
            $.get( "http://api.sp.blueteam.in/location/"+map.getCenter().lat()+","+map.getCenter().lng(), function( data ) {
                //alert( "Data Loaded: " + data );
            });
            document.getElementById('default_latitude').value = map.getCenter().lat();
            document.getElementById('default_longitude').value = map.getCenter().lng();
        });



        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                /*markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));*/

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);

        });
        $('<div/>').addClass('centerMarker').appendTo(map.getDiv())
            //do something onclick
            .click(function() {
                var that = $(this);
                if (!that.data('win')) {
                    that.data('win', new google.maps.InfoWindow({
                        content: 'So, you are at this location!'
                    }));
                    that.data('win').bindTo('position', map, 'center');
                }
                that.data('win').open(map);
            });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVq_N_uJLaBm3pYRIZfz3gy-7A-iqFfTg&libraries=places&callback=initAutocomplete"
        async defer></script>
<!--

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVq_N_uJLaBm3pYRIZfz3gy-7A-iqFfTg&libraries=places&callback=initAutocomplete"
        async defer></script>-->


</body>
</html>






<!--<!DOCTYPE html>
<html>
<head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
</head>
<body>
<div id="floating-panel">
    <input id="address" type="textbox" value="Sydney, NSW">
    <input id="submit" type="button" value="Geocode">
</div>
<div id="map"></div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVq_N_uJLaBm3pYRIZfz3gy-7A-iqFfTg&callback=initMap">
</script>
</body>
</html>-->