@component('mail::message')

<p>
    {{ __("Hello!") }}
    <br/>
    {{ __("A new contact request was submitted.") }}
</p>

<hr>
<br/>

<p>
    {{ __("Institution/Organisation name") }}: <b>{!! $data['institution'] !!}</b> <br/>
    {{ __("Type: Institution / NGO") }}:  <b>{!! $institutionTypes[$data['institution_type']] !!}</b> <br/>
    {{ __("Contact person") }}: <b>{!! $data['contact_person_name'] !!} </b> <br/>
    {{ __("E-Mail Address") }}: <b>{!! $data['email'] !!} </b> <br/>
    {{ __("Phone Number") }}: <b>{!! $data['phone'] !!} </b> <br/>
    {{ __("Legal representative name") }}: <b>{!! $data['legally_represented'] !!} </b> <br/>
    {{ __("Identification no") }}: <b>{!! $data['company_identifier'] !!} </b> <br/>
    {{ __("Physical address") }}: <b>{!! $data['address'] !!} </b> <br/>
    {{ __("Type of support: Offer housing / Request housing for refugees") }}:
    <b>{!! $supportTypes[$data['support_type']] !!}</b> <br/>
</p>

{{--@component('mail::table')--}}
{{--    | Laravel       | Table         | Example  |--}}
{{--    | ------------- |:-------------:| --------:|--}}
{{--    | Col 2 is      | Centered      | $10      |--}}
{{--    | Col 3 is      | Right-Aligned | $20      |--}}
{{--@endcomponent--}}

{{--@component('mail::panel')--}}
{{--    {!! $error !!}--}}
{{--@endcomponent--}}

{{--@if($site)--}}
{{--<a href="{{config('app.url').'/dashboard/'.$site->id}}">{!! $site->name !!}--}}
{{--@endif--}}

{{--@component('mail::button', ['url' => route('logs') ])--}}
{{--    View logs--}}
{{--@endcomponent--}}

{{--{{ __("Regards") }}--}}
@endcomponent
