<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['patient_id', 'doctor_id', 'appointment_date', 'appointment_time', 'status', 'notes', 'name'];

    // Define the relationship with the patient
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // Define the relationship with the doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function scopeDailyAppointments($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId)
            ->whereDate('appointment_date', now()->toDateString());
    }

    public function scopeMonthlyAppointments($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId)
            ->whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year);
    }
}
