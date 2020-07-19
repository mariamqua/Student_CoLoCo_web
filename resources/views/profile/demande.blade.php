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

  <div class="home_details">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
                    <div class="modern_home_info_inner">
        <h2>
                       Toutes les Demandes de logement
</h2>
                  
        </div>
          <div class="home_details_active owl-carousel">
          <a align="right" href="{{ route('demande.create')}}" class="btn btn-primary">

                          Ajouter une demande</a>
          @foreach($demandes as $demande)

            <div class="single_details">
              <div class="row">
                <div class="col-xl-6 col-md-6">
                  <div class="modern_home_info">
                    <div class="modern_home_info_inner">
                      
                    <h2 style="color: #FDAE5C;">{{$demande->titre}}</h2>
                        <h5>Annonceur : {{ Auth::user()->name }}</h5>
                        <div class="popular_pro d-flex">
                        <p>
                          {{$demande->description}}
                        </p>
                        </div>
                        <div >
                         <div class="prise_view_details d-flex justify-content-between ">
                          <span> 
                          <i class="fas fa-dollar-sign"></i>

                          Budjet max : {{$demande->budjetmax}} MAD</span>
                        
                
                        </div><br>
                        <div class="prise_view_details d-flex justify-content-between ">
                        
                        <span><i class="fas fa-phone"></i>	  
                        {{$demande->tel}} </span>
                        
                     
                     
                        
                        <form action="{{ route('demande.destroy', $demande->id)}}" method="post">
                         
                        <a align="right" href="{{ route('demande.edit', $demande->id)}}" class="btn btn-primary">
                          Edit</a>
  
                        @csrf
                          @method('DELETE')
                          <button align="right" class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </div>
                        
                      </div>
                    
                       

                     
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
        

            @endforeach


          </div>


        </div>

      </div>
    </div>
  </div>

  <div>
    @endsection