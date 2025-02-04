@extends('layouts.admin')
@section('title', 'Dashboard | Add Hotel')
@section('content')

    <div class="pagetitle">
        <h1>Edit Hotel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Hotel</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Hotel</h5>
                        <!-- No Labels Form -->
                        <form class="row g-3" action="{{ route('hotel.update', $hotel->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <input type="text" name="name" value="{{ $hotel->name }}" class="form-control" placeholder="Name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="description" placeholder="description">{{ $hotel->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="location" value="{{ $hotel->location }}" class="form-control" placeholder="Location" autocomplete="off">
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="image" value="{{ old('image') }}" class="form-control" placeholder="Image" autocomplete="off">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <img style="max-width: 80px; height: auto;" src="{{ asset($hotel->image)}}" alt="Uploaded Image">
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
