@extends('layouts.admin')
@section('title', 'Edit Permission Router')
@section('content')

<div class="pagetitle">
    <h1>Edit Permission to Route</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Permission to Route</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Permission to Route</h5>

                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="row g-3" action="{{ route('editAssignPermissionRoutePost') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                          <label for="" class="form-label">Permission</label>
                          <select id="" name="permission" class="form-select">
                              <option  value="{{ $permissionRouter['permission_id'] }}">{{ $permissionRouter->permission->name }}</option>
                          </select>
                          @error('permission')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Route</label>
                            <input type="hidden" name="id" value="{{ $id }}">
                            <select id="" name="route" class="form-select">
                                @foreach ($routeDetails as $routeDetail)
                                <option {{ ($permissionRouter['router'] == $routeDetail['name'])? 'selected' : '' }} value="{{ $routeDetail['name'] }}">{{ $routeDetail['name'] }}</option>
                                @endforeach
                            </select>
                            @error('route')
                             <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>

                        <div class="text-start">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
