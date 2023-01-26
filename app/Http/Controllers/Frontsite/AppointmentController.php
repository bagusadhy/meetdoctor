<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

// use library
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// model
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\MasterData\Consultation;
use App\Models\Operational\Appointment;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        // this code, for security
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.frontsite.appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $appointment = new Appointment;
        $appointment->doctor_id = $data['doctor_id'];
        $appointment->user_id = Auth::user()->id;
        $appointment->consultation_id = $data['consultation_id'];
        $appointment->level = $data['level'];
        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->status = 2; // set to waiting payment
        $appointment->save();

        return redirect(route('payment.appointment', $appointment->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function appointment($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);

        $consultation = Consultation::all();
        $appointment = Appointment::where('doctor_id', $doctor_id)->pluck('date')->toArray();


        $date = array_count_values($appointment);

        $tanggal = [];
        foreach ($date as $key => $value) {
            if ($value == 3) {
                array_push($tanggal, $key);
            }
        }


        return view('pages.frontsite.appointment.index', compact('doctor', 'consultation', 'tanggal'));
    }
}
