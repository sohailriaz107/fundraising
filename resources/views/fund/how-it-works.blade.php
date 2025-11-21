@extends('layouts.app')
@section('title', 'working')
@section('content')


<!-- END nav -->

<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h2 class="heading mb-5">How It Works</h2>
            
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row align-items-center mb-5">

        <div class="col-md-7 order-md-2 mb-5 mb-md-0">
          <img src="{{ asset('assets/images/bg_1.jpg') }}" alt="" class="img-fluid">
        </div>

        <div class="col-md-5 pr-md-5 mb-5 order-md-1">
          <div class="block-41">
            <div class="block-41-subheading d-flex">
              <div class="block-41-number">Step 01</div>
            </div>
            <h2 class="block-41-heading mb-3">Create Your Fundraising Campaign</h2>
            <div class="block-41-text">
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>

      </div> <!-- .row -->

      <div class="row align-items-center mb-5">
        <div class="col-md-7 mb-5 mb-md-0">
          <img src="{{ asset('assets/images/bg_2.jpg') }}" alt="" class="img-fluid">
        </div>

        <div class="col-md-5 pl-md-5 mb-5">
          <div class="block-41">
            <div class="block-41-subheading d-flex">
              <div class="block-41-number">Step 02</div>
            </div>
            <h2 class="block-41-heading mb-3">Share with Family and Friends</h2>
            <div class="block-41-text">
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>

      </div> <!-- .row -->

    </div>
  </div>

  <!-- .section -->

  < <!-- .featured-donate -->

    @endsection