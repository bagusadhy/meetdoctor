<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// request
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Mail\doctor as MailDoctor;
// use Gate;
// use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

// models and models related to
use App\Models\Operational\Doctor;
use App\Models\MasterData\Specialist;
use App\Models\User;
use App\Models\ManagementAccess\DetailUser;


class DoctorController extends Controller
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
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor = Doctor::with('specialist')->get();
        $specialist = Specialist::all();

        return view('pages.backsite.operational.doctor.index', compact('doctor', 'specialist'));
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
    public function store(StoreDoctorRequest $request)
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::transaction(function () use ($request) {

            // re format before push to table
            $doctor = [];
            $doctor['name'] = $request->name;
            $doctor['specialist_id'] = $request->specialist_id;
            $doctor['fee'] = str_replace(',', '', $request->fee);
            $doctor['fee'] = str_replace('Rp.', '', $doctor['fee']);

            // upload process here
            $path = public_path('app/public/assets/file-doctor');
            if (!File::isDirectory($path)) {
                $response = Storage::makeDirectory('public/assets/file-doctor');
            }

            // change file locations
            if (isset($request['photo'])) {
                $doctor['photo'] = $request->file('photo')->store(
                    'assets/file-doctor',
                    'public'
                );
            } else {
                $doctor['photo'] = "";
            }


            // store to database (user)
            $user = [];
            $user['name'] = $doctor['name'];
            $user['email'] = $request->email;
            $user['password'] = Hash::make($user['email']);
            $users = User::create($user);

            // store to databse (doctor)
            $doctor['user_id'] = $users['id'];
            $doctors = Doctor::create($doctor);

            // sync role 
            $users->role()->sync(4);

            // save to detail user , to set type user
            $detail_user = new DetailUser;
            $detail_user->user_id = $users['id'];
            $detail_user->type_user_id = 2;
            $detail_user->save();
        });

        $maildata = [
            'email' => $request->email,
            'password' => $request->email
        ];

        Mail::to($request->email)->send(new MailDoctor($maildata));

        alert()->success('Success Message', 'Successfully added new doctor');
        return redirect(route('doctor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('pages.backsite.operational.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialist = Specialist::all();

        return view('pages.backsite.operational.doctor.edit', compact('doctor', 'specialist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $data = $request->all();

        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('Rp. ', '', $data['fee']);

        // upload process here
        // change format photo
        if (isset($data['photo'])) {

            // first checking old photo to delete from storage
            $get_item = $doctor['photo'];

            // change file locations
            $data['photo'] = $request->file('photo')->store(
                'assets/file-doctor',
                'public'
            );

            // delete old photo from storage
            $data_old = 'storage/' . $get_item;
            if (File::exists($data_old)) {
                File::delete($data_old);
            } else {
                File::delete('storage/app/public/' . $get_item);
            }
        }

        // update to database
        $doctor->update($data);

        alert()->success('Success Message', 'Successfully updated doctor');
        return redirect(route('doctor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        // dd($doctor->user()->forceDelete());
        // first checking old file to delete from storage
        try {
            DB::transaction(function () use ($doctor) {

                $get_item = $doctor['photo'];

                $data = 'storage/' . $get_item;
                if (File::exists($data)) {
                    File::delete($data);
                } else {
                    File::delete('storage/app/public/' . $get_item);
                }

                // dd($doctor);

                $doctor->forceDelete();
                $doctor->user()->forceDelete();
            });
        } catch (\Throwable $th) {
            alert()->error('Error Message', 'Error while deleting doctor');
            return redirect(route('doctor.index'));
        }


        alert()->success('Success Message', 'Successfully deleted doctor');
        return back();
    }
}
