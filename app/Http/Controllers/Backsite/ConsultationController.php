<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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
        abort_if(Gate::denies('consultation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $consultation = Consultation::orderBy('name', 'ASC')->get();
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

        alert()->success('Success Message', 'Successfully added new Consultation');
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
        abort_if(Gate::denies('consultation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('consultation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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


        alert()->success('Success Message', 'Successfully updated Consultation');
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
        abort_if(Gate::denies('consultation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultation->forceDelete();

        alert()->success('Success Message', 'Successfully deleted Consultation');
        return back();
    }
}
