@extends('layouts.app')
@section('title', 'Gallary')
@section('content')

<style>
.gallery-img {
    height: 250px; /* fixed height */
    object-fit: cover; /* ensures all images cover the area uniformly */
    border-radius: 8px;
    transition: transform 0.3s;
}

.img-hover:hover .gallery-img {
    transform: scale(1.05);
}

.img-hover:hover .icon {
    opacity: 1;
}
</style>

<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h2 class="heading">Our Gallery</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row g-3">
      @foreach ($gallary as $gal)
      <div class="col-md-4">
        <a href="{{ asset('assets/images/img_1.jpg') }}" class="img-hover d-block position-relative" data-fancybox="gallery">
          <span class="icon icon-search position-absolute top-50 start-50 translate-middle text-white fs-3" style="opacity:0; transition:0.3s;">&#128269;</span>
          <img src="{{ $gal->image }}" alt="Image placeholder" class="img-fluid gallery-img w-100">
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="featured-section overlay-color-2" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}')">
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