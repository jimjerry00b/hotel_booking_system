@extends('layouts.admin')
@section('title', 'Edit Permission Role')
@section('content')

<div class="pagetitle">
    <h1>Edit Assign Permission to Role</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Assign Permission to Role</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Assign Permission to Role</h5>
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="row g-3" action="{{ route('editAssignPermissionRolePost') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                          <label for="" class="form-label">Role</label>
                           <select name="role[]" class="form-select" multiple aria-label="multiple select example">

                                @foreach ($roles as $role)
                                    <option {{(in_array($role->id, $selected_roles))? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach

                          </select>


                          @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Permission</label>
                            <input name="permission" type="hidden" value="{{ $id }}">
                            <select id="" class="form-select" disabled>
                                @foreach ($permissions as $permission)
                                <option {{ ($id == $permission->id)? 'selected' : '' }} value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
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
