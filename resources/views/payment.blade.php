<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stripe Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-5 w-100" style="max-width: 450px;">
            <h3 class="text-center mb-4 text-primary fw-bold">💳 Secure Stripe Payment</h3>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount (USD)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Card Details</label>
                    <div id="card-element"></div>
                </div>

                <button type="submit" class="btn btn-pay w-100 py-2 mt-3">Pay Now</button>
            </form>
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
            const {
                token,
                error
            } = await stripe.createToken(card);
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

</body>

</html>