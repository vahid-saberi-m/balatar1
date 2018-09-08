<?php

namespace App\Repositories;

use App\Http\Requests\JobPostRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\JobPost;
use Illuminate\Http\Request;

class EventRepository
{
    public function indexPubic(Company $company)
    {
//        $events=Event::where('company_id',$company->id)->orderByDesc('id')->take(10);

        $events = $company->Events()->orderByDesc('id')->take(10);
        return response()->json([$events]);
    }

    public function store(Request $request)
    {
       $event= Event::create( [
            'company_id'=>auth()->user()->company_id ,
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'main_photo'=>$request->file('main_photo')->store('/companies/events/'),
            'tags'=>$request->tags,
            ]);
       return $event->id;
    }

    public function update(Request $request,Event $event)
    {
         $event->update( [
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'main_photo'=>$request->file('main_photo')->store('/companies/events/'),
            'tags'=>$request->tags,
        ]);
        return $event;
    }

    public function delete(Event $event){
        $event->delete();
        return 'deleted';
    }
}