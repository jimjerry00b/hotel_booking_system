@extends('layouts.admin')
@section('title', 'Dashboard | Add Room')
@section('content')

    <div class="pagetitle">
        <h1>Add Room</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Room</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Room</h5>
                        <!-- No Labels Form -->
                        <form class="row g-3" action="{{ route('room.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <select name="hotel_id" class="form-select" aria-label="Default select example">
                                    <option selected value="">Please Select Hotel</option>
                                    @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="room_number" value="{{ old('room_number') }}" class="form-control" placeholder="Room Number" autocomplete="off">
                                @error('room_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <select name="type" class="form-select" aria-label="Default select example">
                                    <option selected value="">Please Select Type</option>
                                    <option value="single">Single</option>
                                    <option value="double">Double</option>
                                    <option value="suite">Suite</option>
                                    <option value="deluxe">Deluxe</option>
                                </select>

                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="number" name="price" value="{{ old('price') }}" class="form-control" placeholder="Price" autocomplete="off">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="number" name="capacity" value="{{ old('capacity') }}" class="form-control" placeholder="Capacity" autocomplete="off">
                                @error('capacity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End No Labels Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
