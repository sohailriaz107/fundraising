@extends('layouts.admin.admin')

@section('title', 'navbar')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">Naviagtion</h1>
        <div style="margin-bottom: 60px;">
            <button class="btn btn-success  float-end shadow-sm " data-bs-toggle="modal" data-bs-target="#addNavModal">
                <i class="bi bi-plus-circle"></i> Add Navigation
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
                            <th scope="col">Nav Name</th>
                            <th scope="col">Route</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($navs as $nav)

                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$nav->nav}}</td>
                            <td class="text-center">{{$nav->route}}</td>
                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $nav->id }}">
                                    Edit
                                </button>
                                <a href="{{url('/nav/delete',$nav->id)}}"> <button class="btn btn-sm btn-danger">Delete</button></a>
                            </td>
                        </tr>

                        <!-- edit nav -->
                        <div class="modal fade" id="editModal{{ $nav->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $nav->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $nav->id }}">Edit Navigation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('nav.update', $nav->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nav{{ $nav->id }}" class="form-label">Navigation Name</label>
                                                <input type="text" name="nav" id="nav{{ $nav->id }}" class="form-control" value="{{ $nav->nav }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="route{{ $nav->id }}" class="form-label">Navigation Route</label>
                                                <input type="text" name="route" id="route{{ $nav->id }}" class="form-control" value="{{ $nav->route }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

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
                    <h5 class="modal-title" id="addNavModalLabel">Add New Navigation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{ route('nav.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nav" class="form-label">Navigation Name</label>
                            <input type="text" name="nav" class="form-control" id="nav" placeholder="Enter navigation name" required>
                        </div>
                        <div class="mb-3">
                            <label for="route" class="form-label">Route</label>
                            <input type="text" name="route" class="form-control" id="route" placeholder="/example-route" required>
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