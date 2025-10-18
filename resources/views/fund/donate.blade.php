@extends('layouts.app')
@section('title', 'donate')
@section('content')

<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h2 class="heading">Better To Give Than To Receive</h2>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="site-section fund-raisers">
  <div class="container">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-8 text-center">
        <h2>Donate Here</h2>
        <p class="lead">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

      </div>
    </div>

    <div class="row">



    </div>
  </div>
</div> <!-- .section -->

<div class="featured-section overlay-color-2" style="background-image: url('images/bg_2.jpg');">

  <div class="container">
    <div class="row">

      <div class="col-md-6 mb-5 mb-md-0">
        <img src="images/bg_2.jpg" alt="Image placeholder" class="img-fluid">
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