@extends('layouts.admin.admin')

@section('title', 'Campaign')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">Campaign List</h1>
        <div style="margin-bottom: 60px;">
            <button class="btn btn-success  float-end shadow-sm " data-bs-toggle="modal" data-bs-target="#addNavModal">
                <i class="bi bi-plus-circle"></i> Add Compaign
            </button>
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
                            <th scope="col">Compaign Name</th>
                            <th scope="col">About Campaign</th>
                            <th scope="col">Goal Amount</th>
                            <th scope="col">Raised Amount</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaigns as $campaign )
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$campaign->campaign_name}}</td>
                            <td class="text-center">{{$campaign->description}}</td>
                            <td class="text-center">{{$campaign->goal_amount}}</td>
                            <td class="text-center">{{number_format($campaign->donations->sum('amount'),2)}}</td>
                            <td class="text-center">{{$campaign->start_date}}</td>
                            <td class="text-center">{{$campaign->end_date}}</td>
                            <td class="text-center">{{$campaign->status}}</td>
                            <td class="text-center"> <img src="{{$campaign->image}}" alt="" class="rounded-circle" width="80px" height="80px">
                            </td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <img src="{{ asset('assets/images/user-pen.svg') }}"
                                        alt="action"
                                        width="20"
                                        height="20"
                                        role="button"
                                        id="dropdownMenuButton{{ $campaign->id }}"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="cursor: pointer;">

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $campaign->id }}">
                                        <li>
                                            <button type="button" class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $campaign->id }}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('campaign.destroy', $campaign->id) }}" method="POST" onsubmit="return alert('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>


                        </tr>
                        <!-- edit campgin  -->
                        <div class="modal fade" id="editModal{{ $campaign->id }}" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg rounded-4">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="addNavModalLabel">Add New Campaign</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <form action="{{ route('campaign.update',$campaign->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Campaign Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Campaign name" value="{{$campaign->campaign_name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Campaign Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description">{{$campaign->description}}</textarea>
                                            </div>


                                            <div class="mb-3">
                                                <label for="gamount" class="form-label">Goal Amount</label>
                                                <input type="number" name="gamount" class="form-control" id="gamount" placeholder="Goal Amount" value="{{$campaign->goal_amount}}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ramount" class="form-label">Raised Amount</label>
                                                <input type="number" name="ramount" class="form-control" id="ramount" value="{{$campaign->raised_amount}}" placeholder="Raised Amount" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sdate" class="form-label">Start Date</label>
                                                <input type="date" name="sdate" class="form-control" id="sdate" value="{{$campaign->start_date}}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edate" class="form-label">End Date</label>
                                                <input type="date" name="edate" class="form-control" id="edate" value="{{$campaign->end_date}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="img" class="form-label">Old Image</label>
                                                <br>

                                                <img src="{{$campaign->image}}" alt="img" class="rounded-circle text-center" width="100px" height="100px">
                                                <br>
                                                <label for="edate" class="form-label">Select New Image</label>
                                                <input type="file" name="image" class="form-control" id="image">

                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>

                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- add nav model -->
    <!-- Modal Popup -->
    <div class="modal fade" id="addNavModal" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNavModalLabel">Add New Campaign</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Campaign Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Campaign name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Campaign Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="gamount" class="form-label">Goal Amount</label>
                            <input type="number" name="gamount" class="form-control" id="gamount" placeholder="Goal Amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="ramount" class="form-label">Raised Amount</label>
                            <input type="number" name="ramount" class="form-control" id="ramount" placeholder="Raised Amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="sdate" class="form-label">Start Date</label>
                            <input type="date" name="sdate" class="form-control" id="sdate" required>
                        </div>

                        <div class="mb-3">
                            <label for="edate" class="form-label">End Date</label>
                            <input type="date" name="edate" class="form-control" id="edate" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <!-- Edit Modal -->


</main>


@endsection