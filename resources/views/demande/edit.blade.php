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
              <h3>Editer cette demande</h3>
              <form method="post" action="{{ route('demande.update', $demande->id ) }}">
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    @csrf
                    @method('PATCH')

                    <label for="titre">Titre:</label>
                    <input type="text" class="form-control" value="{{ $demande->titre }}" name="titre" />
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <label for="budjetmax">Budjet maximum :</label>
                    <input type="text" class="form-control" value="{{ $demande->budjetmax }}" name="budjetmax" />
                  </div>
    
                  <div class="col-xl-6 col-md-6">
                    <label for="tel">Téléphone :</label>
                    <input type="text" class="form-control" value="{{ $demande->tel }}" name="tel" />
                  </div>
                  <div class="col-xl-12">
                    <label for="description">Description :</label>
                    <textarea cols="30" rows="10" name="description">
                    {{ $demande->description }}
                    </textarea>
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
