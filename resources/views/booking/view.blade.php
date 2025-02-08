<?php
use Carbon\Carbon;
?>

@extends('layouts.admin')
@section('title', 'Dashboard | Bookings')
@section('content')
    <div class="pagetitle">
        <h1>Bookings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Bookings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Bookings</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User name</th>
                                    <th scope="col">Hotel</th>
                                    <th scope="col">Room Number</th>
                                    <th scope="col">Check in date</th>
                                    <th scope="col">Check out date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Per Day Cost</th>
                                    <th scope="col">Total day</th>
                                    <th scope="col">Total Cost</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)

                                <?php

                                $checkInDate = Carbon::parse($booking->check_in_date); // Replace with your check-in date
                                $checkOutDate = Carbon::parse($booking->check_out_date); // Replace with your check-out date

                                $daysDifference = $checkInDate->diffInDays($checkOutDate);


                                ?>

                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->room->hotel->name }}</td>
                                    <td>{{ $booking->room->room_number  }}</td>
                                    <td>{{ $booking->check_in_date }}</td>
                                    <td>{{ $booking->check_out_date }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    <td>{{ $daysDifference }}</td>
                                    <td>{{ $booking->total_price*$daysDifference }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="">Edit</a>
                                        <form class="d-inline" action="" method="POST">
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
