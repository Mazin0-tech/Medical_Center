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
                            <h2>Booking</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Make an Appointment</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('appointments.request', $doctor->id) }}"
                        method="POST" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="notes" id="notes" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                                        placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="appointment_date" class="form-label">Appointment Date</label>
                                    <input class="form-control" name="appointment_date" id="appointment_date"
                                        type="date" required placeholder="Select a Date">
                                    <div id="date_error" class="invalid-feedback" style="display:none;">Please select a
                                        valid date (Mon-Fri).</div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="appointment_time" class="form-label">Appointment Time</label>
                                    <input class="form-control" name="appointment_time" id="appointment_time"
                                        type="time" required disabled placeholder="Select a Time">
                                    <div id="time_error" class="invalid-feedback" style="display:none;">Please select a
                                        time between 9 AM and 6 PM.</div>
                                </div>
                            </div>

                            <!-- Tooltip for time input -->
                            <div id="time_tooltip" class="tooltip" role="tooltip" style="display:none;">
                                <div class="arrow"></div>
                                <div class="tooltip-inner">
                                    Available between 9 AM and 6 PM (Mon-Fri)
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                        placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn" id="submitBtn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Buttonwood, California.</h3>
                            <p>Rosemead, CA 91770</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+1 253 565 2365</h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{$doctor->email}}</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
</main>

<script>
    // Initialize time tooltip
    const timeTooltip = document.getElementById('time_tooltip');
    const appointmentDateInput = document.getElementById('appointment_date');
    const appointmentTimeInput = document.getElementById('appointment_time');
    const dateError = document.getElementById('date_error');
    const timeError = document.getElementById('time_error');
    const submitButton = document.getElementById('submitBtn');

    // Set current date and one-week from now date
    const currentDate = new Date();
    const maxDate = new Date();
    maxDate.setDate(currentDate.getDate() + 7); // Set to one week later

    // Format date to yyyy-mm-dd
    function formatDate(date) {
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        return `${year}-${month}-${day}`;
    }

    // Set the min and max date values for the date input
    appointmentDateInput.min = formatDate(currentDate); // Set min date to today
    appointmentDateInput.max = formatDate(maxDate); // Set max date to one week from today

    // Handle date change event
    appointmentDateInput.addEventListener('change', function () {
        const selectedDate = new Date(this.value);
        const dayOfWeek = selectedDate.getDay();

        if (dayOfWeek >= 1 && dayOfWeek <= 5) { // Monday to Friday
            appointmentTimeInput.disabled = false;
            setTimeRange(selectedDate);
            clearErrors(); // Clear errors when the date is valid
        } else {
            appointmentTimeInput.disabled = true;
            appointmentTimeInput.value = ''; // Clear the time input
            displayError(dateError, "Please select a valid date (Mon-Fri).");
        }
    });

    // Set time range based on the selected date
    function setTimeRange(date) {
        const currentTime = new Date();
        const minTime = "09:00"; // 9 AM
        const maxTime = "18:00"; // 6 PM

        // For today, limit the time range based on current time
        if (date.toDateString() === currentTime.toDateString()) {
            if (currentTime.getHours() >= 18) {
                appointmentTimeInput.value = '';
                appointmentTimeInput.disabled = true;
                timeTooltip.style.display = "none";
                timeError.style.display = "block";
                timeError.innerHTML = "You can only select a time before 6 PM today.";
            } else {
                const minAvailableTime = currentTime.getHours() + ":" + (currentTime.getMinutes() < 10 ? "0" + currentTime.getMinutes() : currentTime.getMinutes());
                appointmentTimeInput.min = minAvailableTime;
                appointmentTimeInput.max = maxTime;
                timeTooltip.style.display = "block";
                timeError.style.display = "none";
            }
        } else {
            appointmentTimeInput.min = minTime;
            appointmentTimeInput.max = maxTime;
            timeTooltip.style.display = "block";
            timeError.style.display = "none";
        }
    }

    // Function to display error messages
    function displayError(element, message) {
        element.style.display = 'block';
        element.innerHTML = message;
    }

    // Function to clear all errors
    function clearErrors() {
        dateError.style.display = 'none';
        timeError.style.display = 'none';
    }

    // Ensure the time input is within the valid range when the user selects a time
    appointmentTimeInput.addEventListener('input', function () {
        const selectedTime = this.value;
        const minTime = appointmentTimeInput.min;
        const maxTime = appointmentTimeInput.max;

        if (selectedTime < minTime || selectedTime > maxTime) {
            displayError(timeError, `Please select a time between ${minTime} and ${maxTime}.`);
        } else {
            clearErrors();
        }
    });

    // Form validation before submission
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Check if the time is valid before submitting
        if (!appointmentTimeInput.disabled && (appointmentTimeInput.value < appointmentTimeInput.min || appointmentTimeInput.value > appointmentTimeInput.max)) {
            displayError(timeError, `Please select a time between ${appointmentTimeInput.min} and ${appointmentTimeInput.max}.`);
            return; // Stop the form from submitting
        }

        // Submit the form if everything is valid
        this.submit();
    });
</script>

@endsection
