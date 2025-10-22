@extends('layouts.admin.admin')

@section('title', 'Doners')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">Doners List</h1>
        <div style="margin-bottom: 60px;">

        </div>
        <div class="container mt-3">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            </div>
            @endif
        </div>

        <!-- Bootstrap Table -->
        <div class="container mt-4">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped align-middle shadow-sm rounded">
    <thead class="table-dark text-center">
        <tr>
            <th scope="col">SR</th>
            <th scope="col">Doner Name</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Amount Sent</th>
            <th scope="col">Goal Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doners as $key => $doner)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $doner->donor_name }}</td>
                <td class="text-center">{{ $doner->campaign->campaign_name ?? 'N/A' }}</td>
                <td class="text-center">{{ $doner->amount }}</td>
                <td class="text-center">{{ $doner->campaign->goal_amount ?? '0' }}</td>
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-primary">View</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>


    </div>

    <!-- add nav model -->



</main>


@endsection