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
				@if (session()->has('success'))
				<div class="alert alert-success">
					{{ session()->get('success') }}
				</div>
				@endif
				<form action="{{ route('post_settings', Auth::user()->id) }}" method="post"
					enctype="multipart/form-data">
					@csrf

					<!-- Basic Information -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Basic Information</h4>
							<div class="row form-row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="change-avatar">
											<div class="profile-img">
												<!-- Display existing image, if available -->
												<img id="profileImage" src="{{Auth::user()->image }}" alt="User Image">
											</div>
											<div class="upload-img">
												<div class="change-photo-btn">
													<span><i class="fa fa-upload"></i> Upload Photo</span>
													<input name="image" accept="image/*" type="file" class="upload"
														id="imageUpload">
												</div>
												@error('image')
												<div class="alert alert-danger">{{ $message }}</div>
												@enderror
												<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of
													2MB</small>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Username <span class="text-danger">*</span></label>
										<input name="name" value="{{Auth::user()->name}}" type="text"
											class="form-control">
										@error('name')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Date Of Birth <span class="text-danger">*</span></label>
										<input type="date" value="{{Auth::user()->date_of_birth}}" name="date_of_birth"
											class="form-control" id="dateOfBirth" required>
										@error('date_of_birth')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>phone_number<span class="text-danger">*</span></label>
										<input type="tel" value="{{Auth::user()->phone}}" name="phone"
											value="+20{{Auth::user()->phone}}" class="form-control">
										@error('phone')
										<span class="text-danger">{{$message}}</span>
										@enderror
										</span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Gender <span class="text-danger">*</span></label>
										<select name="gender" class="form-control">
											<option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : ''
												}}>Male
											</option>
											<option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected'
												: ''
												}}>Female</option>
										</select>
										@error('gender')
										<span class="text-danger">{{$message}}</span>
										@enderror
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>specialty</label>
										<input type="text" value="{{Auth::user()->specialty}}" name="specialty"
											value="{{Auth::user()->specialty}}" class="form-control">
										@error('specialty')
										<span class="text-danger">{{$message}}</span>
										@enderror
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Country</label>
										<input type="text" value="{{Auth::user()->address}}" name="address"
											class="form-control">
										@error('address')
										<span class="text-danger">{{$message}}</span>
										@enderror
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- /Basic Information -->

					<!-- About Me -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">About Me</h4>
							<div class="form-group mb-0">
								<label>Biography</label>
								<textarea class="form-control" name="bio" rows="5">{{Auth::user()->bio}}</textarea>
							</div>
							@error('bio')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
					</div>
					<!-- /About Me -->

					<!-- Pricing -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Range Pricing</h4>

							<div class="form-group mb-0">
								<div class="PB-range-slider-div">

									<p class="PB-range-slidervalue">$300</p>
									<input type="range" min="300" max="1000" name="fees" value="{{Auth::user()->fees}}"
										step="100" class="PB-range-slider" id="myRange">
									<p class="PB-range-slidervalue" id="rangeValue">${{Auth::user()->fees}}</p>
								</div>
								@error('fees')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
					</div>
					<!-- /Pricing -->

					<div class="submit-section submit-btn-bottom">
						<button type="submit" class="btn w-100 btn-primary submit-btn">Save Changes</button>
					</div>
				</form>
			</div>
		</div>

	</div>

</div>

<script>
	const slider = document.getElementById("myRange");
	const output = document.getElementById("rangeValue");
  
	// Display initial value
	output.textContent = `$${slider.value}`;
  

	slider.oninput = function() {
	  output.textContent = `$${this.value}`;
	}
</script>

<script>
	const imageUpload = document.getElementById('imageUpload');
	const profileImage = document.getElementById('profileImage');
  
	
	imageUpload.addEventListener('change', function(event) {
	  const file = event.target.files[0];
  
	  if (file) {
		
		const reader = new FileReader();
		
		reader.onload = function(e) {
		  profileImage.src = e.target.result; 
		}
  
		reader.readAsDataURL(file);
	  }
	});
</script>
<script>
	const today = new Date();
    const minDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()); 

    // Format the date in yyyy-mm-dd format
    const minDateFormatted = minDate.toISOString().split('T')[0];

    
    document.getElementById('dateOfBirth').setAttribute('max', minDateFormatted);
</script>

<!-- /Page Content -->
@endsection