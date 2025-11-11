@extends('layouts.admin.admin')

@section('title', 'Campaign')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 ">About List</h1>
        <div style="margin-bottom: 60px;">
            <button class="btn btn-success  float-end shadow-sm " data-bs-toggle="modal" data-bs-target="#aboutModal">
                <i class="bi bi-plus-circle"></i> Add About
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
                            <th scope="col">Title</th>
                            <th scope="col">History</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($about as $abt )
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$abt->title}}</td>
                            <td class="text-center">{{$abt->history}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <img src="{{ asset('assets/images/user-pen.svg') }}"
                                        alt="action"
                                        width="20"
                                        height="20"
                                        role="button"
                                        id="dropdownMenuButton{{ $abt->id }}"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="cursor: pointer;">

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="button" class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $abt->id }}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{route('admin.delete',$abt->id)}}" method="POST" onsubmit="return alert('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="alert('are you sure to delete??')" class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>


                        </tr>
                        <!-- edit About  -->
                        <div class="modal fade" id="editModal{{ $abt->id }}" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg rounded-4">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="addNavModalLabel">Edit New ABout</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <form action="{{route('admin.update',$abt->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Campaign name" value="{{$abt->title}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="history" class="form-label">Campaign Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description">{{$abt->history}}</textarea>
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
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="addNavModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNavModalLabel"> New ABout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{route('admin.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Title Name</label>
                            <input type="text" name="title" class="form-control" id="name" placeholder="Enter Campaign Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Campaign History</label>
                            <textarea name="history" id="description" class="form-control" rows="3" placeholder="Enter description" required></textarea>
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