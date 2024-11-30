@extends('layouts.main')

@section('content')
<!-- /Header -->

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="d-flex justify-content-between">

			<a href="#" class="menu-logo">
				<img src="{{asset ('img\logo\logo2_footer.png')}}" class="img-fluid" alt="Logo">
			</a>

			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Dashboard</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

				<!-- Profile Sidebar -->
				<div class="profile-sidebar">
					<div class="widget-profile pro-widget-content">
						<div class="profile-info-widget">
							<a href="#" class="booking-doc-img">
								<img src="{{ Auth::user()->image }}" alt="User Image">
							</a>
							<div class="profile-det-info">
								<h3>Dr.{{ Auth::user()->name }} </h3>

								<div class="patient-details">
									<h5 class="mb-0">{{Auth::user()->specialty}}</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="dashboard-widget">
						<nav class="dashboard-menu">
							<ul>
								<li>
									<a href="{{route('doctor')}}">
										<i class="fas fa-columns"></i>
										<span>Dashboard</span>
									</a>
								</li>
								<li>
									<a href="{{ route('appointments') }}">
										<i class="fas fa-calendar-check"></i>
										<span>Appointments</span>
									</a>
								</li>
							
										<li>
											<a class="dropdown-item" href="{{ route('settings') }}">
												<i class="fas fa-user-cog"></i>
												<span>Profile Settings</span>
											</a>
										</li>

										@if(Auth::check() && Auth::user()->role === 'admin')
										<li>
											<a class="dropdown-item" href="{{ route('all_patients') }}">
												<i class="fas fa-user"></i>
												<span>Patients</span>
											</a>
										</li>
										<li>
											<a class="dropdown-item" href="{{ route('all_doctors') }}">
												<i class="fas fa-user-md"></i>
												<span>Doctors</span>
											</a>
										</li>
										@endif
								
								</li>

								<li>
									<form class="" action="{{route('logout')}}" method="POST">
										@csrf

										<button onclick="return confirm('Are you sure you want to logout?')"
											type='supmit' class="btn btn-danger w-100">
											<i class="fas fa-sign-out-alt"></i> Logout
										</button>
									</form>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /Profile Sidebar -->

			</div>
			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="row">
					<div class="col-md-12">
						<div class="card dash-card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-6">
										<div class="dash-widget dct-border-rht">
											<div class="circle-bar circle-bar1">
												<div class="circle-graph1" data-percent="75">
													<img src="{{ asset('img/icon-01.png') }}" class="img-fluid"
														alt="patient">
												</div>
											</div>
											<div class="dash-widget-info">
												<h6>Total Patient In Hospital</h6>
												<h3>{{ $totalPatients }}</h3>
												<p class="text-muted">Till Now</p>
											</div>
										</div>
									</div>

									<div class="col-md-12 col-lg-6">
										<div class="dash-widget">
											<div class="circle-bar circle-bar3">
												<div class="circle-graph3" data-percent="50">
													<img src="{{ asset('img/icon-03.png') }}" class="img-fluid"
														alt="Patient">
												</div>
											</div>
											<div class="dash-widget-info">
												<h6>Appointments</h6>
												<h3>{{ $appointmentsCount }}</h3>
												<p class="text-muted">{{ $appointmentDate }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<h4 class="mb-4">Patient Appointments</h4>
						<div class="appointments">
							@foreach($appointments as $appointment)
							<div class="appointment-list">
								<div class="profile-info-widget">
									<a href="#" class="booking-doc-img">
										<img src="{{ $appointment->patient->image ?? asset('img/default-user.png') }}"
											alt="User Image">
									</a>
									<div class="profile-det-info">
										<h3><a href="#">{{ $appointment->patient->name ?? 'Unknown Patient' }}</a></h3>
										<div class="patient-details">
											<h5><i class="far fa-clock"></i> {{
												\Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y,
												h:i
												A') }}</h5>
											<h5><i class="fas fa-envelope"></i> {{ $appointment->patient->email ?? 'N/A'
												}}
											</h5>
											<h5 class="mb-0"><i class="fas fa-phone"></i> {{
												$appointment->patient->phone ??
												'N/A' }}</h5>
										</div>
									</div>
								</div>
								<div class="appointment-action ">
									<!-- Accept Button -->
									<form action="{{ route('appointments.approve', $appointment->id) }}" class="px-2"
										method="POST" style="display: inline;">
										@csrf
										<button
											onclick="return confirm('Are you sure you want to Accept this appointment?')"
											type="submit" class="btn btn-sm bg-success-light">
											<i class="fas fa-check"></i> Accept
										</button>
									</form>

									<!-- Cancel Button -->
									<form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST"
										style="display: inline;">
										@csrf
										<button
											onclick="return confirm('Are you sure you want to cancel this appointment?')"
											type="submit" class="btn btn-sm bg-danger-light">
											<i class="fas fa-times"></i> Cancel
										</button>
									</form>
								</div>

							</div>
							@endforeach

						</div>
					</div>
				</div>
				<!-- /Appointment List -->

			</div>
		</div>
	</div>

</div>
</div>

</div>

</div>



@endsection