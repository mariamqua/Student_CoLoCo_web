@extends('layouts.layout')

@section('content')
<!-- bradcam_area  -->
 <div class="property_details_banner" style="margin-left: auto; margin-right: auto; display: block;"> 
     <div class="container">
         <div class="row">
             <div class="col-xl-6 col-md-8 col-lg-6">
                 <div class="comfortable_apartment">
                     <h4>{{ $offre->titre }}</h4>
                      <img src="{{$offre->image}}" style="width:300px;height:300px;" alt="" > 
                     <div class="quality_quantity d-flex">
                         <div class="single_quantity">
                             <img src="img/svg_icon/color_box.svg" alt="">
                             <span>Superficié : {{ $offre->superficie}} Sqft</span>
                         </div>
                         <div class="single_quantity">
                             <img src="img/svg_icon/color_bed.svg" alt="">
                             <span>{{ $offre->capacite}} personnes</span>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-6 col-md-4 col-lg-6">
                 <div class="prise_quantity">
                     <h4>{{ $offre->prix}} MAD</h4>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--/ bradcam_area  -->

 <!-- details  -->
 <div class="property_details">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="property_banner">
                     <div class="property_banner_active owl-carousel">
                         <div class="single_property">
                             <img src="img/banner/property_details.png" alt="">
                         </div>
                         <div class="single_property">
                             <img src="img/banner/property_details.png" alt="">
                         </div>
                         <div class="single_property">
                         <img src="{{url('/public/storage/uploads/offres_images/'.$offre->image)}}">
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                 <div class="details_info">
                     <br><hr><br>
                     <h4>Description:</h4>
                     <p>
                     {{ $offre->description}}
                     </p>
                     <div  id='map' style='width: 1000px; height: 500px;'></div>
                 </div>


        </div>

    </div>
</div>


            <script>
                var offre = {!! json_encode($offre->toArray(), JSON_HEX_TAG) !!};
                console.log(offre.titre);
            </script>


@section('custum-js') @stack ('before-scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
<script>
    var offer = {!! json_encode($offre->toArray(), JSON_HEX_TAG) !!};
    console.log(offre.data);
    var user_location = [offre.longitude, offre.latitude];
    mapboxgl.accessToken = 'pk.eyJ1IjoibWVyeWFtcXVhIiwiYSI6ImNrY3FkcXU3bTA5NWQycnA3dzMwenQ1b3kifQ.9PHHGJxC16OchqhxSQ5CLg';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: user_location,
        zoom: 15
    });
    //for(var i=0;i<offer.data.le)
    var marker = new mapboxgl.Marker().setLngLat(user_location).addTo(map);
</script>
@stack ('after-scripts') @endsection @endsection