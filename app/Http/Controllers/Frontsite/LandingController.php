<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

// use library
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// model
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\MasterData\Specialist;

class LandingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialist = Specialist::limit(5)->get();
        $doctor = Doctor::limit(4)->get();

        return view('pages.frontsite.landing-page.index', compact('doctor', 'specialist'));
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

    public function listDoctor(Doctor $doctor)
    {
        $list = Doctor::all();

        return view('pages.frontsite.landing-page.doctor', compact('list'));
    }

    public function getDoctor(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('doctor')
                    ->where('doctor.name', 'like', '%' . $query . '%')
                    ->join('specialist', 'doctor.specialist_id', '=', 'specialist.id')
                    ->orderBy('doctor.name', 'asc')
                    ->select('doctor.id', 'doctor.name', 'doctor.photo', 'specialist.name AS specialist')
                    ->get();
            } else {

                $data = DB::table('doctor')
                    ->join('specialist', 'doctor.specialist_id', '=', 'specialist.id')
                    ->orderBy('doctor.name', 'asc')
                    ->select('doctor.id', 'doctor.name', 'doctor.photo', 'specialist.name AS specialist')
                    ->get();
            }


            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $doctor) {
                    $output .= '
                        <a href=' . route('appointment.doctor', $doctor->id) . ' class="group">
                            <div class="relative z-10 w-full h-[350px] rounded-2xl overflow-hidden">
                                <img src=' . asset($doctor->photo) . ' class="w-full h-full bg-center bg-no-repeat object-cover object-center" alt="Doctor 1">
                                <div class="opacity-0 group-hover:opacity-100 transition-all ease-in absolute inset-0 bg-[#0D63F3] bg-opacity-70 flex justify-center items-center">
                                    <span class="text-[#0D63F3] font-medium bg-white rounded-full px-8 py-3">Book Now</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-5">
                                <div>
                                    <div class="text-[#1E2B4F] text-lg font-semibold">' . $doctor->name . '</div>
                                    <div class="text-[#AFAEC3] mt-1">' . $doctor->specialist . '</div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <img src=' . asset('assets/frontsite/images/star.svg') . ' alt="Star">
                                    <span class="block text-[#1E2B4F] font-medium">4.5</span>
                                </div>
                            </div>
                        </a>
                    ';
                }
            } else {
                $output = '
                 <p class="text-[#A7B0B5] mt-16 text-center">Oppss...<br>Doctor Not Found</p>
                ';
            }
            $data = array(
                'doctor'  => $output,
                'total_row' => $total_row,
            );
            echo json_encode($data);
        }
    }
}
