    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCW37ewW5LQuc5wT3HUFarLuut0B7iouk&callback=initMap" defer ></script>
    <style type="text/css">
        #map {
              width: 100%;
              height: 100vw; 
        }
    </style>
    <script type="">
        //Set up some of our variables.
        var map; //Will contain map object.
        var marker = false; ////Has the user plotted their location marker? 
        var geocoder;
                
        function initMap() {
            /*const dubai_BOUNDS = {
              north: 56.3834,
              south: 51.4980,
              west: 26.2822,
              east: 22.6444,
            };*/
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 25.083792, lng: 55.2290769 },
                zoom: 10,
                /*restriction: {
                  latLngBounds: dubai_BOUNDS,
                  strictBounds: false,
                },*/
            });

            geocoder = new google.maps.Geocoder();

            // Configure the click listener.
            map.addListener('click', function(mapsMouseEvent) {

                //Get the location that the user clicked.
                var clickedLocation = mapsMouseEvent.latLng;

                //If the marker hasn't been added.
                if(marker === false){
                    //Create the marker.
                    marker = new google.maps.Marker({
                        position: clickedLocation,
                        map: map,
                        draggable: true //make it draggable
                    });
                    //Listen for drag events!
                    google.maps.event.addListener(marker, 'dragend', function(event){
                        markerLocation();
                    });
                } else{
                    //Marker has already been added, so just change its location.
                    marker.setPosition(clickedLocation);
                }

                //Get the marker's location.
                markerLocation();
            });
        }

        //This function will get the marker's current location and then add the lat/long
        //values to our textfields so that we can save the location.
        function markerLocation(){
            //Get location.
            var currentLocation = marker.getPosition();

            const latlng = {
                lat: parseFloat(currentLocation.lat()),
                lng: parseFloat(currentLocation.lng()),
            };

            geocoder.geocode({ location: latlng }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        setCookie("user_address", results[0].formatted_address, 365);
                    } else {
                        window.alert("No results found");
                    }
                } 
                else {
                    window.alert("Geocoder failed due to: " + status);
                }
            });

            //Add lat and lng values to a field that we can save.
            setCookie("user_lat", currentLocation.lat(), 365);
            setCookie("user_lng", currentLocation.lng(), 365);
        }              
                
        //
    </script>

<section class="bg-home">

        <div class="card text-center">
            <div class="card-header p-3 bg-dark border-0">
                <h2 class="text-white">Selct Your Location</h2>
                <p class="m-0">Click on a location on the map to select it. Drag the marker to change location.</p>
            </div>
            <div class="card-body p-0 h-100vh">
                <!-- <h1>Select a location!</h1> -->
                <!--map div-->
                <div id="map"></div>
            </div>
            <div class="card-footer text-muted p-3 bg-dark fixed-bottom border-0">
                <a href="<?php echo base_url() ?>service" class="btn btn-primary btn-lg">Confirm your location</a>
            </div>
        </div>

    </section>