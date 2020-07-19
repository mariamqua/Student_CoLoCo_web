@extends('layouts.layout')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="uper">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
  

    <!-- popular_property  -->
    <div class="popular_property">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-30 text-center">
                        <h3>Toutes Les Offres</h3>
                    </div>
                    <a href="{{ route('offre.create')}}" class="btn btn-primary">

Ajouter une offre</a>
                </div><br>
            </div>
            <div class="home_details_active owl-carousel">
       

            <div class="row">
                @foreach($offres as $offre)

                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <div class="property_tag">
                                For Sale
                            </div>

                            <a href="{{ route('offre.show', $offre->id)}}" class="w-20 w-sm-100">
                            <img src="{{url('/public/storage/uploads/offres_images/'.$offre->image)}}">
                            </a>
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                <h3><a  href="{{ route('offre.show', $offre->id)}}">{{$offre->titre}}</a></h3>
                                <div class="mark_pro">
                                    <span>{{$offre->adresse}}</span>
                                </div>
                                <span class="amount">{{$offre->prix}} MAD</span>
                            </div>
                        </div>
                        <div class="footer_pro">
                            <ul>
                                <li>
                                    <div class="single_info_doc">
                                        <img src="img/svg_icon/square.svg" alt="">
                                        <span>{{$offre->superficie}} Sqft</span>
                                    </div>
                                </li>
                               
                                <li>
                                    <div class="single_info_doc">
                                        <img src="img/svg_icon/bed.svg" alt="">
                                        <span>{{$offre->capacite}} personnes</span>
                                    </div>
                                </li>
                              
                            </ul><br>
                            <ul>
                                <li>
                                <a href="{{ route('offre.edit', $offre->id)}}" class="btn btn-primary">Edit</a></td>

                                </li>
                               
                                <li>
                                    
                    <form action="{{ route('offre.destroy', $offre->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                                </li>
                              
                            </ul>
                        </div>
               
                    </div>
                </div>

                @endforeach

            </div>
           
        </div>
    </div>
    <!-- /popular_property  -->
    <div>
        @endsection