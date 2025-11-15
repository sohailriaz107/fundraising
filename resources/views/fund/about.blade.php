@extends('layouts.app')
@section('title', 'About')
@section('content')

<style>
.card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 15px;
}
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
.card-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.card-text {
    font-size: 0.9rem;
}
</style>
<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        @foreach ($about as $abt)


        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="heading">{{$abt->title}}</h2>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="site-section mb-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12 mb-5">
        <h1>Our History</h1>
      </div>
      <div class="col-md-12">

        <p class="lead">{{$abt->history}}</p>


      </div>
      @endforeach

    </div>

    <div class="row mt-5">
      <div class="col-md-12 mb-5 text-center mt-5">
        <h2>Leadership</h2>
      </div>
         @foreach ($teams as $team)
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('upload/teams/' . $team->image) }}" class="card-img-top" alt="{{ $team->name }}">
            <div class="card-body text-center">
                <h5 class="card-title mb-1">{{$team->name}}</h5>
                <p class="text-primary mb-3">{{$team->role}}</p>
                <p class="card-text text-muted">{{$team->description}}</p>
            </div>
            <div class="card-footer bg-white border-0 text-center">
                <a href="#" class="btn btn-outline-primary btn-sm">Contact</a>
            </div>
        </div>
    </div>
    @endforeach
    
    </div>

  </div>
</div>


<div class="site-section border-top">
  <div class="container">
    <div class="row">

      <div class="col-md-4">
        <div class="media block-6">
          <div class="icon"><span class="ion-ios-bulb"></span></div>
          <div class="media-body">
            <h3 class="heading">Our Mission</h3>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p><a href="#" class="link-underline">Learn More</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="media block-6">
          <div class="icon"><span class="ion-ios-cash"></span></div>
          <div class="media-body">
            <h3 class="heading">Make Donations</h3>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p><a href="#" class="link-underline">Learn More</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="media block-6">
          <div class="icon"><span class="ion-ios-contacts"></span></div>
          <div class="media-body">
            <h3 class="heading">We Need Volunteers</h3>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p><a href="#" class="link-underline">Learn More</a></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- .site-section -->
@endsection