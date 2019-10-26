@component('mail::message')
     **{{$name}}**,  {{-- use double space for line break --}}عزیز سلام.
    از اینکه شرکت {{$company}} را برای کار انختاب کردید متشکریم.

    ما رزومه شما را دریافت کردیم و پس از بررسی با شما تماس خواهیم گرفت.

    با تشکر,
    {{$company}}.
@endcomponent