<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterData\Consultation;

use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Http\Requests\Consultation\UpdateConsultationRequest;

class ConsultationController extends Controller
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
        $consultation = Consultation::all();


        return view('pages.backsite.master-data.consultation.index', compact('consultation'));
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
    public function store(StoreConsultationRequest $request)
    {
        $consultation = Consultation::create($request->all());

        return redirect(route('consultation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.show', compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.edit', compact('consultation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, $id)
    {
        $consultation = Consultation::find($id)->update($request->all());

        return redirect(route('consultation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        // dd($id);
        $consultation->delete();

        return back();
    }
}
