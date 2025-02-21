@extends('layouts.admin')
@section('title', 'Dashboard | Assign Permission To Role')
@section('content')


<div class="pagetitle">
    <h1>Permission To Role</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permission To Role</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Permission To Role</h5>

                    <a href="{{ route('assignNewPermissionRole') }}"><button type="button" class="btn btn-outline-primary btn-sm">Assign</button></a>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Permission</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($permissionsWithRoles as $permissionsWithRole)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permissionsWithRole->name }}</td>
                                <td>
                                    @foreach ($permissionsWithRole->roles as $role)
                                        {{ $role->name }},
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary" href="{{ route('editPermissionRole', $permissionsWithRole->id ) }}">Edit</a>
                                    <form class="d-inline" action="{{ route('deletePermissionToRole', $permissionsWithRole->id) }}" method="POST">
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
