@extends('layouts.admin')
@section('title', 'Dashboard | Rooms')
@section('content')
    <div class="pagetitle">
        <h1>Rooms</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Rooms</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Rooms</h5>

                        <a href="{{ route('room.create') }}"><button type="button" class="btn btn-outline-primary btn-sm">Add</button></a>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hotel</th>
                                    <th scope="col">Room Number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $room->hotel->name }}</td>
                                    <td>{{ $room->room_number }}</td>
                                    <td>{{ $room->type }}</td>
                                    <td>{{ $room->price }}</td>
                                    <td>{{ $room->capacity }}</td>
                                    <td>{{ $room->is_available }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ route('room.edit', $room->id) }}">Edit</a>
                                        <form class="d-inline" action="{{ route('room.destroy', $room->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                                        </form>
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
