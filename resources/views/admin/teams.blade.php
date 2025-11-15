@extends('layouts.admin.admin')

@section('title', 'Campaign')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">Team List</h1>
        <div style="margin-bottom: 60px;">
            <button class="btn btn-success  float-end shadow-sm " data-bs-toggle="modal" data-bs-target="#addNavModal">
                <i class="bi bi-plus-circle"></i> Add Team Member
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
                            <th scope="col"> Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Desciption</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team )
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$team->name}}</td>
                            <td class="text-center">{{$team->role}}</td>
                            <td class="text-center">{{$team->description}}</td>
                            <td class="text-center"> <img src="{{asset('upload/teams/'.$team->image)}}" alt="" class="rounded-circle" width="80px" height="80px">
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <img src="{{ asset('assets/images/user-pen.svg') }}"
                                        alt="action"
                                        width="20"
                                        height="20"
                                        role="button"
                                        id="dropdownMenuButton{{$team->id}}"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="cursor: pointer;">

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$team->id}}">
                                        <li>
                                            <button type="button" class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{$team->id}}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{route('team.destroy',$team->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="confirm('are you sure to delete??')">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- edit team  -->
                        <!-- Modal Popup -->
                        <div class="modal fade" id="editModal{{$team->id}}" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg rounded-4">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="addNavModalLabel">Edit Member</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <form action="{{route('team.update',$team->id)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label"> Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$team->name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label"> Role</label>
                                                <input type="text" name="role" class="form-control" id="rol" placeholder="Enter Role" value="{{$team->role}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label"> Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description">{{$team->description}}</textarea>
                                            </div>
                                            <div class=" text-center mb-3">
                                                <label for="image" class="form-label">Old Image</label>
                                                <div class="text-center">
                                                    <img src="{{asset('upload/teams/'.$team->image)}}" alt="" class="rounded-circle" width="80px" height="80px">
                                                </div>

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
                    <h5 class="modal-title" id="addNavModalLabel">Add New Member</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{route('team.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"> Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter  name" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"> Role</label>
                            <input type="text" name="role" class="form-control" id="rol" placeholder="Enter Role" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"> Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
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



</main>


@endsection