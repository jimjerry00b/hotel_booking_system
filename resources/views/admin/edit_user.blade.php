@extends('layouts.admin')
@section('title', 'Dashboard | Edit')
@section('content')

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- No Labels Form -->
                        <form class="row g-3" action="{{ route('add_new_post') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Your Name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email" autocomplete="off">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <select id="inputState" class="form-select">
                                    <option value="{{ ($user->role_id == 2)? 'selected' : '' }}">Admin</option>
                                    <option value="{{ ($user->role_id == 3)? 'selected' : '' }}">User</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Old Password" autocomplete="off">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="New Password" autocomplete="off">
                                @error('password')
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
