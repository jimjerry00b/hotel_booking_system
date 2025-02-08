@extends('layouts.frontend')
@section('title', 'User informations')
@section('content')

<section class="container">
    <div class="row">
        <div class="col-lg-3">Sitebar</div>
        <div class="col-lg-9">
            <form action="{{ route('frontend.registration') }}" method="POST">
                @csrf
            <div class="row">
                <div class="col-lg-6 pb-4">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Your Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 pb-4">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autocomplete="off">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 pb-4">
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 pb-4">
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 pb-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>

@endsection
