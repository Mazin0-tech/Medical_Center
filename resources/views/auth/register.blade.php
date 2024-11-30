<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Medical Center - Register</title>
    <meta name="description" content="Sign up to access the full features of Medical Center.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Slider Area Start -->
    <div class="slider-area position-relative">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <form class="form auth-form" method="POST" action="{{ route('post.register') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <p class="title">Create an Account</p>
                        <p class="message">Sign up now for full access to our medical center services</p>

                        <!-- Name Input -->
                        <div class="flex">
                            <label>
                                <input class="input" name="name" type="text" placeholder="Enter your full name"
                                    required>
                                <span>Full Name</span>
                            </label>

                            <label>
                                <input class="input date-input" id="dob" name="date_of_birth" type="date"
                                    placeholder="Enter your date of birth" required>
                                <span>Date of Birth</span>
                            </label>
                        </div>

                        <!-- Email Input -->
                        <label>
                            <input class="input" name="email" type="email" placeholder="Enter your email" required>
                            <span>Email</span>
                        </label>

                        <label>
                            <input class="input" name="phone" type="tel" placeholder="Enter your phone number" required>
                            <span>Phone</span>
                        </label>
                        <div class="flex">

                            <label>
                                <input type="radio" class="input" name="gender" value="male" required>
                                <span>Male</span>
                            </label>

                            <label>
                                <input type="radio" class="input" name="gender" value="female" required>
                                <span>Female</span>
                            </label>

                            <label>
                                <input type="radio" class="input" name="gender" value="other" required>
                                <span>Other</span>
                            </label>

                        </div>

                        <div class="flex">
                            <!-- Password Input -->
                            <label>
                                <input class="input" name="password" type="password" placeholder="Enter your password"
                                    required>
                                <span>Password</span>
                            </label>

                            <!-- Password Confirmation Input -->
                            <label>
                                <input class="input" name="password_confirmation" type="password"
                                    placeholder="Confirm your password" required>
                                <span>Confirm Password</span>
                            </label>
                        </div>

                        <!-- Image Upload -->
                        <label class="image-upload  ">
                            <input class="file-input " name="image" type="file" required>
                            <span>Upload Image</span>
                        </label>

                        <!-- Submit Button -->
                        <button class="submit" type="submit">Sign Up</button>

                        <!-- Redirect to Login -->
                        <p class="signin">Already have an account? <a href="{{ route('login') }}">Log In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End -->

    <!-- JS Files -->
    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/animated.headline.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Custom Validation Script -->
    <script>
        // Set the max date to 18 years ago without affecting the styling
document.addEventListener('DOMContentLoaded', function () {
    const today = new Date();
    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()).toISOString().split('T')[0];
    const dobInput = document.getElementById('dob');
    dobInput.setAttribute('max', eighteenYearsAgo);
});

function validateForm() {
    const dob = document.querySelector('input[name="date_of_birth"]').value;
    const today = new Date();
    const age = new Date(today - new Date(dob)).getFullYear() - 1970;
    if (age < 18) {
        alert("You must be at least 18 years old to register.");
        return false;
    }
    return true;
}

    </script>



</body>

</html>