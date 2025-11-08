@extends('layouts.app')
@section('title', 'Home')
<!-- END nav -->
@section('content')
<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h2 class="heading mb-5">Be Hope for Others</h2>
         
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="site-section section-counter">
  <div class="container">
    <div class="row">
      <div class="col-md-6 welcome-text">
        <h2 class="display-4 mb-3">Who Are We?</h2>
        <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
        <p class="mb-0"><a href="#" class="btn btn-primary px-3 py-2">Learn More</a></p>
      </div>
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

<div class="site-section fund-raisers bg-light">
  <div class="container">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-8 text-center">
        <h2>Latest Fundraisers</h2>
        <p class="lead">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <p><a href="#" class="link-underline">View All Fundraisers</a></p>
      </div>
    </div>
  </div>

  <div class="container-fluid">

    <!-- <div class="row"> -->

    <div class="col-md-12 block-11">
      <div class="nonloop-block-11 owl-carousel">
        @foreach ($funds as $fund)


        <div class="card fundraise-item">
          <a href="{{route('docomp',$fund->id)}}"><img class="card-img-top" src="{{ asset($fund->image) }}" alt="Image placeholder"></a>
          <div class="card-body">
            <h3 class="card-title"><a href="#">{{$fund->campaign_name}}</a></h3>
            <p class="card-text">{{$fund->description}}</p>
            <span class="donation-time mb-3 d-block">Last donation 1w ago</span>
            <div class="progress custom-progress-success">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span class="fund-raised d-block">${{$fund->goal_amount}} raised of {{ number_format($fund->donations->sum('amount'), 2) }}</span>
            <p>Progress:
              {{ number_format(($fund->donations->sum('amount') / $fund->goal_amount) * 100, 2) }}%
            </p>
          </div>
        </div>
        @endforeach

      </div>
    </div>
    <!-- </div> -->
  </div>
</div> <!-- .section -->


<!-- .section -->

<div class="featured-section overlay-color-2" style="background-image: url('{{ asset('assets/images/bg_3.jpg') }}');">

  <div class="container">
    <div class="row">

      <div class="col-md-6">
        <img src="{{ asset('assets/images/bg_2.jpg') }}" alt="Image placeholder" class="img-fluid">
      </div>

      <div class="col-md-6 pl-md-5">
        <span class="featured-text d-block mb-3">Success Stories</span>
        <h2>Water Is Life. We Successfuly Provide Clean Water in South East Asia</h2>
        <p class="mb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
        <span class="fund-raised d-block mb-5">We have raised $100,000</span>

        <p><a href="#" class="btn btn-success btn-hover-white py-3 px-5">Read The Full Story</a></p>
      </div>

    </div>
  </div>

</div> <!-- .featured-donate -->

<!-- .section -->

<div class="featured-section overlay-color-2" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');">

  <div class="container">
    <div class="row">

      <div class="col-md-6 mb-5 mb-md-0">
        <img src="{{ asset('assets/images/bg_2.jpg') }}" alt="Image placeholder" class="img-fluid">
      </div>

      <div class="col-md-6 pl-md-5">

        <div class="form-volunteer">

          <h2>Be A Volunteer Today</h2>
          <form action="#" method="post">
            <div class="form-group">
              <!-- <label for="name">Name</label> -->
              <input type="text" class="form-control py-2" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <!-- <label for="email">Email</label> -->
              <input type="text" class="form-control py-2" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
              <!-- <label for="v_message">Email</label> -->
              <textarea name="v_message" id="" cols="30" rows="3" class="form-control py-2" placeholder="Write your message"></textarea>
              <!-- <input type="text" class="form-control py-2" id="email"> -->
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-white px-5 py-2" value="Send">
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

</div> <!-- .featured-donate -->

@endsection