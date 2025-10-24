@extends('layouts.admin.admin')

@section('title', 'Campaign')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">About List</h1>
        <div style="margin-bottom: 60px;">
            <button class="btn btn-success  float-end shadow-sm " data-bs-toggle="modal" data-bs-target="#galryModal">
                <i class="bi bi-plus-circle"></i> ADD gallary Image
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
                            <th scope="col">image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallary as $gal)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">
                                <img src="{{$gal->image}}" alt="" class="rounded-circle" width="80px" height="80px">
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <img src="{{ asset('assets/images/user-pen.svg') }}"
                                        alt="action"
                                        width="20"
                                        height="20"
                                        role="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="cursor: pointer;">

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="button" class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#galryModal{{$gal->id}}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{route('gallary.destroy',$gal->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="alert('are you sure to delete??')">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- edit About  -->
                        <div class="modal fade" id="galryModal{{$gal->id}}" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg rounded-4">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="addNavModalLabel">Add Image</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form action="{{ route('gallery.update',$gal->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3 text-center">
                                                <label for="name" class="form-label d-block mb-2 fw-semibold">Old Image</label>
                                                <img src="{{ asset($gal->image) }}"
                                                    alt="Old Image"
                                                    class="rounded-circle border border-2 shadow-sm"
                                                    width="100"
                                                    height="100">
                                            </div>

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Select New Image</label>
                                                <input type="file" name="image" class="form-control" id="name" placeholder="Enter Campaign Title" required>
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
    <div class="modal fade" id="galryModal" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNavModalLabel">Add Image</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{route('galary.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="name" placeholder="Enter Campaign Title" required>
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