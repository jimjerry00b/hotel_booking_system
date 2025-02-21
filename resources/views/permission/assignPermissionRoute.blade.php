@extends('layouts.admin')
@section('title', 'Assign Permission Route')
@section('content')

<div class="pagetitle">
    <h1>Permission To Route</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permission To Route</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Permission To Route</h5>

                    <a href="{{ route('assignNewPermissionRoute') }}"><button type="button" class="btn btn-outline-primary btn-sm">Assign Permission to Route</button></a>

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
                            <tr>
                                <td>d</td>
                                <td>a</td>
                                <td>
                                    <a class="btn btn-outline-primary" href="">Edit</a>
                                    <form class="d-inline" action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>


@endsection
