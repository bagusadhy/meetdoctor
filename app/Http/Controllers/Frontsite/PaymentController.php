<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

// use library
use App\Mail\appointment as afterPayment;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// model
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\Operational\Transaction;
use App\Models\Operational\Appointment;
use App\Models\MasterData\Specialist;
use App\Models\MasterData\Consultation;
use App\Models\MasterData\ConfigPayment;

class PaymentController extends Controller
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
        return view('pages.frontsite.payment.index');
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
        return abort(404);
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

    public function payment($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        $config_payment  = ConfigPayment::first();

        $specialist_fee = $appointment->doctor->specialist->fee;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        return view('pages.frontsite.payment.index', compact('appointment', 'config_payment', 'total_with_vat', 'grand_total', 'appointment_id'));
    }

    public function transaction($appointment_id)
    {
        $appointment = Appointment::where('id', $appointment_id)->first();
        $config_payment = ConfigPayment::first();

        // set transaction
        $specialist_fee = $appointment->doctor->specialist->price;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        // total
        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        // total with vat and grand total
        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        // save to database
        $transaction = new Transaction;
        $transaction->appointment_id = $appointment['id'];
        $transaction->fee_doctor = $doctor_fee;
        $transaction->fee_specialist = $specialist_fee;
        $transaction->fee_hospital = $hospital_fee;
        $transaction->sub_total = $total;
        $transaction->vat = $total_with_vat;
        $transaction->total = $grand_total;
        $transaction->save();

        $this->email($appointment_id);
        return view('pages.frontsite.success.payment-success');
    }

    public function email($appointment_id)
    {
        $appointment = Appointment::find($appointment_id)->with('doctor')->with('consultation')->get();

        $transaction = Transaction::where('appointment_id', $appointment_id)->pluck('total');

        $data = [];
        foreach ($appointment as $key => $value) {
            # code...

            $data = [
                'user' => Auth::user()->name,
                'doctor' => $value->doctor->name,
                'consultation' => $value->consultation->name,
                'date' => date('d M Y', strtotime($value->date)),
                'time' => date('H:i', strtotime($value->time)),
                'status' => $value->payment_status,
                'total' => 'Rp' . number_format($transaction[0])
            ];
        }

        Mail::to(Auth::user()->email)->send(new afterPayment($data));
    }
}
