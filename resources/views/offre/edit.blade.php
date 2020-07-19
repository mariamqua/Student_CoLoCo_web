@extends('layouts.layout')

@section('content')


    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
     

<section class="contact-section">

  <div class="property_details">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
          <div class="details_info">
            <div class="contact_field"><br><br>
              <h3>Editer l'offre</h3>
              <form method="post" action="{{ route('offre.update', $offre->id ) }}">
                <div class="row">
                <div class="col-xl-6 col-md-6">
                  @csrf
              @method('PATCH')

                    <label for="titre">Titre:</label>
                    <input type="text" class="form-control" name="titre" value="{{ $offre->titre }}" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="prix">Prix :</label>
                    <input type="text" class="form-control" name="prix" value="{{ $offre->prix }}" />
                  </div>
                  <div class="col-xl-12">
                    <label for="adresse">Adresse :</label>
                    <input type="text" class="form-control" name="adresse" value="{{ $offre->adresse }}" /> </div>
                  
                  <div class="col-xl-12">
                    <label for="image">Image :</label>
                            <input type="file"  name="image" id="image">
                  </div>
                 
                  <div class="col-xl-12">
                    <label for="description">Description :</label>
                    <textarea cols="30" rows="10" name="description">{{$offre->description }}</textarea>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="superficie">Superficie :</label>
                    <input type="text" class="form-control" name="superficie" value="{{ $offre->superficie }}" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="capacite">Capacité :</label>
                    <input type="text" class="form-control" name="capacite" value="{{ $offre->capacite }}" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="tel">Téléphone :</label>
                    <input type="text" class="form-control" value="{{ $offre->tel }}" name="tel" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="latitude">Latitude :</label>
                    <input type="text" value="{{ $offre->latitude }}"  onchange="markerlat(this.value)" class="form-control" name="latitude" id="lat">
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="longitude">Longitude :</label>
                    <input type="text"  value="{{ $offre->longitude }}" onchange="markerlat(this.value)" class="form-control" 
                    name="longitude" id="long">
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
</section>
@endsection
