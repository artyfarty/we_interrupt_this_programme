<?php

namespace App\Http\Controllers;

use App\Models\ProgramEvent;
use Illuminate\Http\Request;

/**
 * Class ProgramEventController
 * @package App\Http\Controllers
 */
class ProgramEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programEvents = ProgramEvent::paginate();

        return view('program-event.index', compact('programEvents'))
            ->with('i', (request()->input('page', 1) - 1) * $programEvents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programEvent = new ProgramEvent();
        return view('program-event.create', compact('programEvent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProgramEvent::$rules);

        $programEvent = ProgramEvent::create($request->all());

        return redirect()->route('program-events.index')
            ->with('success', 'ProgramEvent created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programEvent = ProgramEvent::find($id);

        return view('program-event.show', compact('programEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programEvent = ProgramEvent::find($id);

        return view('program-event.edit', compact('programEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProgramEvent $programEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramEvent $programEvent)
    {
        request()->validate(ProgramEvent::$rules);

        $programEvent->update($request->all());

        return redirect()->route('program-events.index')
            ->with('success', 'ProgramEvent updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programEvent = ProgramEvent::find($id)->delete();

        return redirect()->route('program-events.index')
            ->with('success', 'ProgramEvent deleted successfully');
    }
}
