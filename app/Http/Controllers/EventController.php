<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Models\Company;
use App\Tools\ApiTrait;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    use ApiTrait;
    private $EventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->EventRepository=$eventRepository;
        $this->middleware('auth:api')->except(['indexPublic','show']);
    }

    public function indexPublic(Company $company)
    {
        return $this->EventRepository->indexPubic($company);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $request->validated();
        return $this->EventRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $request->validated();
        return $this->EventRepository->update($request,$event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorizeApi('delete',$event);
        return $this->EventRepository->delete($event);
    }
}
