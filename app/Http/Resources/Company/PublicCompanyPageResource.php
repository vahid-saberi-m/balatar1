<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\EventResource;
use App\Http\Resources\JobPostResource;
use App\Models\Company\Event;
use App\Models\JobPost\JobPost;
use App\Repositories\FileRepository;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicCompanyPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->is_live) {
            $jobPosts = JobPost::where('company_id', $this->id)->where('publish_date', '<=', Carbon::now())
                ->where('expiration_date', '>=', Carbon::now())->get();
            $events = Event::where('company_id', $this->id)->get();
            return [
                'is_live'=>$this->is_live,
                'id' => $this->id,
                'name' => $this->name,
                'company_size' => $this->company_size,
                'slogan' => $this->slogan,
                'website' => $this->website,
                'logo' => FileRepository::getUrl($this->logo),
                'message_title' => $this->message_title,
                'message_content' => $this->message_content,
                'main_photo' => FileRepository::getUrl($this->main_photo),
                'about_us' => $this->about_us,
                'why_us' => $this->why_us,
                'recruiting_steps' => $this->recruiting_steps,
                'address' => $this->address,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'location' => $this->location,
                'jobPosts' => JobPostResource::collection($jobPosts),
                'events' => EventResource::collection($events),
            ];
        }else{
            return[
                'is_live'=>$this->is_live
            ];
        }
    }
}
