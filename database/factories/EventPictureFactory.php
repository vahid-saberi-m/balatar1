<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\EventPicture::class, function (Faker $faker) {
    $eventId= $faker->randomElement(\App\Models\Event::all()->pluck('id')->toArray());
    $event= App\Models\Event::find($eventId);
    return [
        'company_id'=>$event->company_id,
        'event_id'=>$eventId,
        'path'=>'/public/images/events/pics',
    ];
});
