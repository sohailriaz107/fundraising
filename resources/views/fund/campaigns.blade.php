@extends('layouts.app')
@section('title', $funds->campaign_name)
@section('content')
<!-- END nav -->

<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-12">
            <span class="text-white text-uppercase">July 30, 2018 &mdash; by Admin</span>
            <h2 class="heading mb-5">Water Is Life. We Successfuly Provide Clean Water in South East Asia</h2>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="blog" class="site-section">
  <div class="container">

    <div class="row g-5">
      <!-- Campaign Details -->
      <div class="col-lg-8">
      
        <div class="card shadow-sm border-0 rounded-4">
          <img src="{{ asset($funds->image) }}"
            class="card-img-top rounded-top-4"
            alt="Campaign Image">

          <div class="card-body">
            <h2 class="fw-bold text-primary mb-3">{{$funds->campaign_name}}</h2>
            <h5 class="text-muted mb-3">{{$funds->description}}</h5>
            <p class="text-secondary" style="line-height: 1.8;">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem saepe quas amet blanditiis quam, ipsam nisi, voluptas in ad ipsa similique eius omnis, delectus eligendi natus tempora doloremque vel dolor.
            </p>
          </div>
        </div>
      
      </div>

      <!-- Donation Form -->
      <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 p-4">
          <h3 class="text-center fw-bold text-success mb-4">Make a Donation</h3>

          @if(session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
          @endif

          <form action="{{route('donations')}}" method="POST" id="payment-form">
            @csrf
            <div class="mb-3">
              <label class="form-label">Amount (pkr)</label>
              <input type="number" name="amount" class="form-control rounded-3" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 mt-3">
              <i class="bi bi-heart-fill me-1"></i> Donate Now
            </button>            
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection