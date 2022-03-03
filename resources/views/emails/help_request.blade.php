@component('mail::message')

<p>
    {{ __("Hello!") }}
    <br/>
    {{ __("A new help request was submitted.") }}
</p>

<p>
{{--{{ __("User Id") }}: <b>{!! $user->id !!}</b> <br/>--}}
{{ __("Full Name") }}: <b>{!! $user->name !!}</b> <br/>
{{ __("Phone Number") }}: <b>{!! $user->phone_number !!}</b> <br/>
{{ __("E-Mail Address") }}: <b>{!! $user->email !!}</b> <br/>
{{ __("Current approximate location") }}: <b>{!! $request->current_location !!}</b> <br/>
{{ __("Known languages") }}: <b>{!! implode(',', $request->known_languages) !!}</b> <br/>
@if($request->special_needs)
{{ __("Special needs detailing") }}: <b>{{ $request->special_needs }}</b> <br/>
@endif
@if($request->guests_number)
{{ __("Guests number") }}: <b>{!! $request->guests_number !!}</b> <br/>
@endif
@if($request->more_details)
<br/>
<b>{{ __("Details") }}</b> <br/>
{{ $request->more_details }}<br/>
@endif
<br/>
<b>{{ __("Transport") }}</b><br/>
@if($request->need_car)
- {{ __("I need transport") }} <br/>
@endif
@if($request->need_car)
- {{ __("I need special transport (e.g. car with wheelchair space)") }} <br/>
@endif
</p>

{{--{{ __("Regards") }}--}}
@endcomponent
