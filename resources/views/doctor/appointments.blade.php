@extends('layouts.main')

@section('content')

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
									<a href="{{route('appointments')}}">
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
										<span>All Patients</span>
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ route('all_doctors') }}">
										<i class="fas fa-user-md"></i>
										<span>All Doctors</span>
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
				<h2 class="text-center my-3">Accepted Appoinments</h2>
				<div class="appointments">

					<!-- Appointment List -->
					@foreach ($patients as $patient)
					<div class="appointment-list">
						<div class="profile-info-widget">
							<a href="patient-profile.html" class="booking-doc-img">
								<img src="{{ $patient->image }}" alt="User Image">
							</a>
							<div class="profile-det-info">
								<h3><a href="patient-profile.html">{{ $patient->name }}</a></h3>
								<div class="patient-details">
									@foreach ($patient->appointmentsAsPatient as $appointment)
									<h5><i class="far fa-clock"></i> {{ $appointment->appointment_date }} / {{ $appointment->appointment_time }}</h5>
									@endforeach
									<h5><i class="fas fa-map-marker-alt"></i>{{$patient->address}}</h5>
									<h5><i class="fas fa-envelope"></i> {{$patient->email}}</h5>
									<h5 class="mb-0"><i class="fas fa-phone"></i> {{$patient->phone}}</h5>
								</div>
							</div>
						</div>

					</div>
					<!-- /Appointment List -->
					@endforeach
				</div>
			</div>
		</div>

	</div>

</div>
<!-- /Page Content -->


</div>
<!-- /Main Wrapper -->

<!-- Appointment Details Modal -->
<div class="modal fade custom-modal" id="appt_details">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Appointment Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul class="info-details">
					<li>
						<div class="details-header">
							<div class="row">
								<div class="col-md-6">
									<span class="title">#APT0001</span>
									<span class="text">21 Oct 2019 10:00 AM</span>
								</div>
								<div class="col-md-6">
									<div class="text-right">
										<button type="button" class="btn bg-success-light btn-sm"
											id="topup_status">Completed</button>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<span class="title">Status:</span>
						<span class="text">Completed</span>
					</li>
					<li>
						<span class="title">Confirm Date:</span>
						<span class="text">29 Jun 2019</span>
					</li>
					<li>
						<span class="title">Paid Amount</span>
						<span class="text">$450</span>
					</li>
				</ul>
			</div>
		</div>
	</div>

	@endsection