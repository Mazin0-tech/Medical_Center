<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $middleware = [];

    public function __construct()
    {
        $this->middleware = ['role:admin'];  // Ensures only doctors can access
    }
    public function index()
    {
        $admin = Auth::user()->role === 'admin' ? 'admin' : '';

        $totalPatients = User::where('role', '=', 'patient')->count();

        $appointmentsCount = appointment::where('doctor_id', '=', Auth::id())->count();

        $cancelledAppointments = appointment::where('doctor_id', '=', Auth::id())->where('status', '=', 'canceled')->count();

        $totalAppointments = appointment::where('doctor_id', '=', Auth::id())->count();

        $latestAppointment = Appointment::where('status', '=', 'pending')->latest()->first();

        $appointmentDate = $latestAppointment ? $latestAppointment->created_at->format('d, M Y') : 'N/A';


        $appointments = Appointment::with('patient', 'doctor')
            ->where('doctor_id', Auth::id())
            ->where('status', '=', 'pending')
            ->get();


        return view('doctor.doctorhome', compact('admin', 'appointments', 'totalAppointments', 'cancelledAppointments', 'totalPatients', 'appointmentsCount', 'appointmentDate'));
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

    public function all_doctors()
    {
        $users = User::whereIn('role', ['admin', 'doctor'])->get();


        

        foreach ($users as $user) {
            $user->daily_appointments = Appointment::dailyAppointments($user->id)->count();
            $user->monthly_appointments = Appointment::monthlyAppointments($user->id)->count();
        }
        
        

        return view('doctor.admin', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {

        $request->validate([
            'role' => 'required|in:patient,doctor,admin',
        ]);


        $user->role = $request->role;
        $user->save();


        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function blockUser(Request $request, User $user)
    {
        $user->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function all_patients(Request $request, User $user)
    {

        $users = User::where('role', '=', 'patient')->get();
        return view('doctor.user', compact('users'));
    }
}
