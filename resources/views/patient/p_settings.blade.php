@extends('layouts.app')

@push('pcss')
<link rel="stylesheet" href="{{asset('css/dstyle.css')}}">
@endpush


@section('content')

<!--? Hero Start -->
<div class="slider-area2">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>Your Personal Information</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="col-lg">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="col-lg-8 col-md-8 py-5 m-auto">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('post_p_settings', Auth::user()->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="change-avatar">
                                <div class="profile-img">
                                    <!-- Display existing image, if available -->
                                    <img id="profileImage" class="rounded-circle" style="width: 100px; padding: 10px"
                                        src="{{Auth::user()->image }}" alt="User Image">
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

                    <div class="mt-10">
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input name="name" value="{{Auth::user()->name}}" type="text" class="form-control">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-10">
                        <div class="form-group">
                            <label> Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" value="{{Auth::user()->date_of_birth}}" name="date_of_birth"
                                class="form-control" id="dateOfBirth" required>
                            @error('date_of_birth')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-10">
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

                    <div class="mt-10">
                        <div class="form-group">
                            <label>specialty</label>
                            <input type="text" value="{{Auth::user()->specialty}}" name="specialty"
                                value="{{Auth::user()->specialty}}" class="form-control">
                            @error('specialty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-10">
                        <div class="form-group">
                            <label class="control-label">Country</label>
                            <input type="text" value="{{Auth::user()->address}}" name="address" class="form-control">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group-icon mt-10">
                        <div class="icon"><i class="fa fa-male"></i></div>
                        <div class="form-select">
                            <select name="gender">
                                <option disabled selected>Gender</option>
                                <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : ''
                                    }}>Male
                                </option>
                                <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected'
                                    : ''
                                    }}>Female</option>
                                <option value="Other" {{ Auth::user()->gender == 'Other' ? 'selected' : ''
                                    }}>Other</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="submit-section submit-btn-bottom pt-5">
                            <button type="submit" class="btn w-100 btn-primary bg-primary submit-btn">Save
                                Changes</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

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


@endsection