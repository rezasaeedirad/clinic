<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class DoctorProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            return redirect()->back()->with('error', 'اجازه دسترسی ندارید.');
        }

        $doctor = $user->doctor;

        return view('doctor.profile', compact('doctor'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            return redirect()->back()->with('error', 'اجازه دسترسی ندارید.');
        }

        $request->validate([
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $doctor = $user->doctor;

        $doctor->update([
            'specialty' => $request->specialty,
            'bio'       => $request->bio,
            'address'   => $request->address,
            'phone'     => $request->phone,
        ]);

        return redirect()->route('doctor.profile.edit')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    }
}
