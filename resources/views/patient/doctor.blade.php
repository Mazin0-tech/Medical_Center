@extends('layouts.app')

@section('content')
<main>
    <!--? Hero Start -->
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>Doctors</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!--? Team Start -->
    <div class="team-area section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-tittle text-center mb-100">
                        <span>Our Doctors</span>
                        <h2>Our Specialist</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($doctor as $dr)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <a href="{{ route('booking', $dr->id) }}" aria-details="Book Now"> <img src="{{$dr->image}}"
                                    alt="Book Now"></a>
                        </div>

                        <div class="team-caption text-center ">
                            <h3><a href="{{ route('booking', $dr->id) }}" aria-details="Book Now">{{$dr->name}}</a>
                            </h3>
                            <span>{{$dr->specialty}}</span>
                            <!-- Team social -->
                            <div class="team-social d-flex justify-content-center">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
</main>

@endsection