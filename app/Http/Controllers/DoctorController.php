<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    protected $middleware = [];

    public function __construct()
    {
        $this->middleware = ['role:doctor|admin'];
    }

    public function index()
    {

        $totalPatients = User::where('role', '=', 'patient')->count();

        $appointmentsCount = appointment::where('doctor_id', '=', Auth::id())->count();


        $latestAppointment = Appointment::where('status', '=', 'pending')->latest()->first();

        $appointmentDate = $latestAppointment ? $latestAppointment->created_at->format('d, M Y') : 'N/A';


        $appointments = Appointment::with('patient', 'doctor')
            ->where('doctor_id', Auth::id())
            ->where('status', '=', 'pending')
            ->get();


        return view('doctor.doctorhome', compact('appointments', 'totalPatients', 'appointmentsCount', 'appointmentDate'));
    }



    public function settings()
    {
        return view('doctor.doctor-settings');
    }

    public function post_settings(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string',
            'fees' => 'nullable|numeric',
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

    public function appointment()
    {
        $appointments = Appointment::with('patient', 'doctor')
        ->where('doctor_id', '=', Auth::id())
        ->where('status', '=', 'approved')
        ->orderBy('patient_id', 'asc')
        ->get();
    
        $patientIds = $appointments->pluck('patient_id');
        $patients = User::with('appointmentsAsPatient')
            ->whereIn('id', $patientIds) 
            ->get();
        
        return view('doctor.appointments', compact( 'patients'));
    }
}
