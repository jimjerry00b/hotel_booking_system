@extends('layouts.frontend')
@section('title', 'Search Result')
@section('content')

<section class="container">
    <div class="row">
        <div class="col-lg-3">Sitebar</div>
        <div class="col-lg-9">
            <div class="row">

                @php
                    if(count($results) <= 0){
                        echo "No records found";
                    }
                @endphp

                @foreach ($results as $result)
                <div class="col-12 mb-3">
                    <div class="row border pt-3 pb-3">
                        <div class="col-lg-4">
                            <img class="card-img-top" src="{{ asset('assets/frontend/img/gallery/gallery-2.jpg') }}" alt="Hotel Image">
                        </div>
                        <div class="col-lg-7">
                            <form action="{{ route('bookings_before_confirm') }}" method="post">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $result->id }}">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h4>Hotel Name : {{ $result->hotel->name }}</h4>
                                    <p>Room type: {{ $result->type }}</p>
                                    <p>Capacity: {{ $result->capacity }}</p>
                                </div>
                                <div class="col-lg-5">
                                    <p>Rating : {{ $result->hotel->rating }}</p>
                                    <p>Price : {{ $result->price }}</p>

                                    @if(isset(Auth::user()->role_id) && Auth::user()->role_id != 1)
                                    <button type="submit" class="btn btn-primary">customer Reserve</button>
                                    @endif

                                    @if(!Auth::user())
                                    <a href="{{ route('user_registration') }}"><button class="btn btn-primary">Reserve</button></a>
                                    @endif
                                </div>

                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

@endsection
