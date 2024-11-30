@extends('layouts.app')
@section('content')
<!--? Hero Start -->
<div class="slider-area2">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>Your Appointment</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
@foreach ($appointments as $appointment)
<div class="card my-5 mx-4">
    <h5 class="card-header">{{ $appointment->doctor->specialty }}</h5> <!-- Display Doctor's Specialty -->
    <div class="card-body rounded-5">
        <div class="d-flex align-items-center justify-content-start">
            <!-- Display Doctor's Image -->
            <img src="{{ $appointment->doctor->image }}" alt="Doctor Image" class="img-fluid rounded-circle my-3"
                style="max-width: 50px; height: auto;">
            <!-- Display Doctor's Name -->
            <h5 class="card-title mx-3">{{ $appointment->doctor->name }}</h5>
            <!-- Added margin for spacing between the image and name -->
        </div>
        <!-- Display Appointment Date and Time -->
        <p class="card-text">{{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y, g:i A') }}</p>
        <!-- Display Appointment Status -->
        <p class="card-text">{{ ucfirst($appointment->status) }}</p>
        <div class="d-flex justify-content-end">
            <!-- Cancel Appointment Button -->
            @if ($appointment->status === 'pending , approved') 
            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn d-flex justify-content-center"
                        style="width: 10%; background-color: red;"
                        onclick="return confirm('Are you sure you want to cancel this appointment?')">
                    Cancel
                </button>
            </form>
            @endif
            
        </div>
    </div>
</div>
@endforeach

@endsection