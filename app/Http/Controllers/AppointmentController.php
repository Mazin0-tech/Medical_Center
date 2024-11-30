<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    // Method to request an appointment
    public function requestAppointment(Request $request, $doctorId)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i|before:18:00', // Validate the time
            'notes' => 'required|string|max:1000',
        ]);
    
        $doctor = User::findOrFail($doctorId);
    
        // Check if there's an existing appointment at the same time
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();
    
        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'This time is already taken, please choose another time.']);
        }
    
        // Check if the doctor has reached the max number of appointments for the day
        $appointmentsToday = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $request->appointment_date)
            ->count();
    
        if ($appointmentsToday >= 15) {
            return back()->withErrors(['appointment_date' => 'The doctor already has the maximum number of appointments for this day.']);
        }
    
        // If everything is valid, create the appointment
        Appointment::create([
            'doctor_id' => $doctorId,
            'patient_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);
    
        return redirect()->route('patient_doctor')->with('success', 'Your appointment request has been submitted.');
    }
    


    // Method to approve an appointment
    public function approveAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Ensure the doctor owns the appointment
        if ($appointment->doctor_id !== Auth::user()->id) {
            return redirect()->route('doctor')->withErrors('You do not have permission to approve this appointment.');
        }

        $appointment->status = 'approved';
        $appointment->save();

        return redirect()->route('doctor')->with('success', 'Appointment approved.');
    }

    // Method to cancel an appointment
    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
    
        // Ensure the doctor owns the appointment
        if ($appointment->doctor_id !== Auth::user()->id) {
            return redirect()->route('doctor')->withErrors('You do not have permission to cancel this appointment.');
        }
    
        // Update the status to 'canceled' instead of deleting
        $appointment->status = 'canceled';
        $appointment->save();  // Save the changes to the database
    
        return redirect()->route('doctor')->with('success', 'Appointment canceled.');
    }
    
}
