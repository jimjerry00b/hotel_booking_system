@extends('layouts.admin')
@section('title', 'Dashboard | Hotels')
@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Hotels</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Hotels</h5>

                        <a href="{{ route('hotel.create') }}"><button type="button" class="btn btn-outline-primary btn-sm">Add</button></a>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotels as $hotel)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->description }}</td>
                                    <td>{{ $hotel->location }}</td>
                                    <td>
                                        <img style="max-width: 80px; height: auto;" src="{{ asset('storage/' . $hotel->image) }}" alt="Uploaded Image">
                                    </td>
                                    <td>{{ $hotel->rating }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-primary">View</button>
                                            <a class="btn btn-outline-primary" href="{{ route('edit', $hotel->id) }}">Edit</a>
                                            @if($hotel->is_deletable == 1)
                                                <button type="button" class="btn btn-outline-primary">Delete</button>
                                            @endif
                                          </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
