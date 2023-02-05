<?php

namespace App\Http\Controllers\Frontsite;

// use library
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterData\ConfigPayment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;

use Midtrans;


// model
use App\Models\User;
use App\Models\MasterData\Consultation;
use App\Models\Operational\Appointment;
use App\Models\Operational\Transaction;
use App\Models\Operational\Doctor;

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

        // midtrans
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
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
        $appointment->save();

        $this->getSnapRedirect($appointment);

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
        $doctor = Doctor::where('id', $doctor_id)->with('specialist')->first();

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

    public function getSnapRedirect(Appointment $appointment)
    {
        $order_id = $appointment->id . '-' . Str::random(5);
        $gross_amount = $this->getPaymentDetails($appointment);
        $appointment->midtrans_booking_code = $order_id;

        $appointment_details = [
            'order_id' => $order_id,
            'gross_amount' => $gross_amount
        ];

        $midtrans_params = [
            'transaction_details' => $appointment_details
        ];

        try {
            $paymentUrl = Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $appointment->midtrans_url = $paymentUrl;
            $appointment->save();

            return $paymentUrl;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function getPaymentDetails(Appointment $appointment)
    {
        $appointment = Appointment::find($appointment->id)->first();
        $config_payment  = ConfigPayment::first();

        $specialist_fee = $appointment->doctor->specialist->fee;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        return $grand_total;
    }

    public function midtransCallback(Request $request)
    {
        $notif = $request->getMethod() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request['order_id']);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $appointment_id = explode('-', $notif->order_id)[0];
        $appointment = Appointment::find($appointment_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $appointment->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $appointment->payment_status = 'paid';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $appointment->payment_status = 'failed';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $appointment->payment_status = 'failed';
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $appointment->payment_status = 'failed';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $appointment->payment_status = 'paid';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $appointment->payment_status = 'pending';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $appointment->payment_status = 'failed';
        }

        $appointment->save();

        if ($appointment->payment_status === 'paid') {
            return redirect(route('payment.transaction', $appointment->id));
        } else if ($appointment->payment_status === 'failed') {
            return view('pages.frontsite.error.payment-error');
        } else {
            return redirect(route('index'));
        }
    }
}
