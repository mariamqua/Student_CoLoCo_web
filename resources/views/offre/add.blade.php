@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card-body">
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div><br />
  @endif
</div>
<section class="contact-section">

  <div class="property_details">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
          <div class="details_info">
            <div class="contact_field">
              <h3>Ajouter une nouvelle offre</h3>
              <form method="post" action="{{ route('offre.store') }}" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    @csrf

                    <label for="titre">Titre:</label>
                    <input type="text" class="form-control" name="titre" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="prix">Prix :</label>
                    <input type="text" class="form-control" name="prix" />
                  </div>
                  <div class="col-xl-12">
                    <label for="adresse">Adresse :</label>
                    <input type="text" class="form-control" name="adresse" /> </div>
                  
                
                  <div class="col-xl-12">
                    <label for="image">Image :</label>
                            <input type="file" class="hide" name="image" id="image">
                        </div>
                      
                    </div>
                  <div class="col-xl-12">
                    <label for="description">Description :</label>
                    <textarea cols="30" rows="10" name="description"></textarea>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="superficie">Superficié :</label>
                    <input type="text" class="form-control" name="superficie" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="capacite">Capacité :</label>
                    <input type="text" class="form-control" name="capacite" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="tel">Téléphone :</label>
                    <input type="text" class="form-control" name="tel" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="latitude">Latitude :</label>
                    <input type="text" id="latitude" class="form-control" name="latitude">
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="longitude">Longitude :</label>
                    <input type="text"  class="form-control"  name="longitude" id="longitude">
                  </div>

                  <div class="form-group geocoder">
                                <div id="geocoder"  ></div>
                            </div>
                            <div class="form-group col-md-12 required ">
                                <div id='map' style='width: 1070px; height: 500px;'></div>
                            </div>


                  <div class="col-xl-12">
                    <div class="send_btn">
                      <button type="submit" class="send_btn">Envoyer</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @section('custum-js') @stack ('before-scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css" type="text/css" />
<script>
    var user_location = [-6.353321573187401, 32.335456747816394];
    //Rextraction adress from cordinates
    var long = 32.335456747816394;
    var latd = -6.353321573187401;
    mapboxgl.accessToken = 'pk.eyJ1IjoibWVyeWFtcXVhIiwiYSI6ImNrY3FkcXU3bTA5NWQycnA3dzMwenQ1b3kifQ.9PHHGJxC16OchqhxSQ5CLg';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: user_location,
        zoom: 10
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
    });
    var marker;
    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    map.on('load', function() {
        addMarker(user_location, 'load');
        //add_markers(saved_markers);
        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            alert("We will redirect!");
            console.log(ev.result.center);
        });
    });
    map.on('click', function(e) {
        marker.remove();
        addMarker(e.lngLat, 'click');
        //console.log(e.lngLat.lat);
        document.getElementById("latitude").value = e.lngLat.lat;
        document.getElementById("longitude").value = e.lngLat.lng;
        //Extracting Adress
        long = e.lngLat.lng;
        latd = e.lngLat.lat;
        getGeocoder(long, latd);
    });
    function addMarker(ltlng, event) {
        if (event === 'click') {
            user_location = ltlng;
        }
        marker = new mapboxgl.Marker({
                draggable: true,
                color: "#d02922"
            })
            .setLngLat(user_location)
            .addTo(map)
            .on('dragend', onDragEnd);
    }
    function add_markers(coordinates) {
        var geojson = (saved_markers == coordinates ? saved_markers : '');
        console.log(geojson);
        // add markers to map
        geojson.forEach(function(marker) {
            console.log(marker);
            // make a marker for each feature and add to the map
            new mapboxgl.Marker()
                .setLngLat(marker)
                .addTo(map);
        });
    }
    function onDragEnd() {
        var lngLat = marker.getLngLat();
        document.getElementById("latitude").value = lngLat.lat;
        document.getElementById("longitude").value = lngLat.lng;
        console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
    }
    function getGeocoder(lat, long){
        let url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + lat + ',' + long + '.json?access_token=pk.eyJ1IjoiaXRzYWJkZXNsYW0iLCJhIjoiY2tjbXQ1bzloMDRuNjJ0bGYwejNmbTNpdSJ9.bVIJw-u4FRKEi6ksBGSpSg';
        fetch(url)
        .then(res => res.json())
        .then((out) => {
            document.getElementById("adress").value = out.features[1].place_name;
            console.log('Checkout this JSON! ', out.features[1].place_name);
        })
        .catch(err => { throw err });
    }
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
</script>

<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

@stack ('after-scripts') @endsection 
</section>@endsection