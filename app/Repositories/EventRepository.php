<?php

namespace App\Repositories;

use App\Http\Requests\EventRequest;
use App\Http\Requests\JobPostRequest;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Company;
use App\Models\Event;
use App\Models\JobPost;
use Illuminate\Http\Request;

class EventRepository
{
    public function indexPubic(Company $company)
    {
//        $events=Event::where('company_id',$company->id)->orderByDesc('id')->take(10);

        $events = $company->Events()->orderByDesc('id')->paginate(10);
        return EventResource::collection($events);
    }

    public function store(EventRequest $request)
    {
        /** @var Event $event */
       $event= Event::query()->create( [
            'company_id'=>auth()->user()->company_id ,
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'main_photo'=>$request->file('main_photo')->store('/companies/events/'),
            'tags'=>$request->tags,
            ]);
       return new EventResource($event);
    }

    public function update(EventRequest $request,Event $event)
    {
        if ($request->file('main_photo')){
            $mainPhoto=$request->file('main_photo')->store('/companies/events/');
        }else{
            $mainPhoto=$event->main_photo;
        }
         $event->update( [
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'main_photo'=>$mainPhoto,
            'tags'=>$request->tags,
        ]);
        return new EventResource($event);
    }

    public function delete(Event $event){
        $event->delete();
        return 'deleted';
    }
}