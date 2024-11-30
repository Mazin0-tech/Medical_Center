<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{

    public function index()
    {
        return view('patient.home'); // Your patient dashboard view
    }

    public function doctor()
    {
        $doctor = User::whereIn('role', ['doctor', 'admin'])->get();


        return view('patient.doctor', compact('doctor'));

    }
    public function p_settings()
    {
        return view('patient.p_settings');
    }

    public function p_post_settings(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string',
            'specialty' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/created'), $imageName);
            $path = "/img/created/$imageName";
            $data['image'] = $path;
        }

        $user = User::find($id);

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function booking(Request $request, $id)
    {
        $doctor = User::find($id);
        return view('patient.booking', compact('doctor'));
    }
    public function appointment_detail($id)
    {
        // Get the logged-in user
        $user = Auth::user();

        // Get all appointments for the logged-in user (either as a patient or doctor)
        $appointments = Appointment::where(function ($query) use ($user) {
            $query->where('patient_id', $user->id)
                ->orWhere('doctor_id', $user->id);
        })
            ->get();  // Fetch all appointments for the user

        // Get the doctor associated with each appointment
        foreach ($appointments as $appointment) {
            $appointment->doctor = User::find($appointment->doctor_id); // Attach the doctor to the appointment
        }

        // Pass the appointments, and user data to the view
        return view('patient.appointment', compact('appointments', 'user'));
    }


    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        $appointment->status = 'canceled';
        $appointment->save();  // Save the changes to the database

        return redirect()->back()->with('success', 'Appointment canceled.');
    }

    public function about()
    {
        return view('patient.about');
    }
}
