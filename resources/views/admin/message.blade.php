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
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
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
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)

                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$message->name}}</td>
                            <td class="text-center">{{$message->email}}</td>
                                <td class="text-center">{{$message->message}}</td>
                            <td class="text-center">
                               
                                <a href="{{route('message.delete',$message->id)}}"> <button class="btn btn-sm btn-danger" onclick="confirm('are You want to delete')">Delete</button></a>
                            </td>
                        </tr>

                       
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>

   



</main>


@endsection