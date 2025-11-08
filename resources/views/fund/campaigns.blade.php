@extends('layouts.app')
@section('title', $funds->campaign_name)
@section('content')
<!-- END nav -->
<script src="https://js.stripe.com/v3/"></script>

<style>
  body {
    background: #f5f7fa;
    font-family: 'Poppins', sans-serif;
  }

  .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  }

  .btn-pay {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: white;
    border-radius: 10px;
    transition: 0.3s;
  }

  .btn-pay:hover {
    background: linear-gradient(135deg, #224abe, #4e73df);
    color: white;
  }

  #card-element {
    padding: 12px;
    border: 1px solid #d1d3e2;
    border-radius: 10px;
    background-color: white;
  }
</style>
<div class="block-31" style="position: relative;">
  <div class="owl-carousel loop-block-31 ">
    <div class="block-30 block-30-sm item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');"
 data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-12">
            <span class="text-white text-uppercase">July 30, 2025 &mdash; by Admin</span>
            <h2 class="heading mb-5">{{$funds->campaign_name}}</h2>
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

            <p>Goal: <strong>{{ number_format($funds->goal_amount, 2) }}</strong></p>
            <p>Raised: <strong>{{ number_format($totalDonated, 2) }}</strong></p>

            @if($funds->goal_amount > 0)
            <p>Progress:
              {{ number_format(($totalDonated / $funds->goal_amount) * 100, 2) }}%
            </p>
            @endif
          </div>
        </div>

      </div>

      <!-- Donation Form -->
      <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 p-4">
          <h3 class="text-center fw-bold text-success mb-4">💳 Secure Stripe Payment</h3>


          @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif


          <form action="{{ route('donations') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="campaign_id" value="{{ $funds->id }}">

            <div class="mb-3">
              <label for="amount" class="form-label">Amount (PKR)</label>
              <input type="number" name="amount" class="form-control rounded-3" min="1" placeholder="Enter amount" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Card Details</label>
              <div id="card-element"></div>
            </div>

            <button type="submit" class="btn btn-pay w-100 py-2 mt-3">
              <i class="bi bi-heart-fill me-1"></i> Donate Now
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
 <script>
  const stripe = Stripe("{{ config('services.stripe.key') }}");
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const {token, error} = await stripe.createToken(card);
      if (error) {
          alert(error.message);
      } else {
          const hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = 'stripeToken';
          hidden.value = token.id;
          form.appendChild(hidden);
          form.submit();
      }
  });
  </script>
@endsection