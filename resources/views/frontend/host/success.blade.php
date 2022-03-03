@extends('layouts.app')

@section('content')
    <section class="bg-h4h-form py-5">
        <div class="container">
            <h1>{{ __('Te-ai înregistrat cu succes') }}!</h1>
            <p>{{ __('Vei fi contactat fie telefonic, fie în persoană, de un reprezentant al autorităților pentru a verifica informația pe care ne-ai furnizat-o. Între timp ți-am trimis pe email o copie a formularului pe care l-ai completat și un link pentru a putea să îți accesezi contul creat în platformă pentru a vedea statusul ofertei tale.') }}</p>
            <p>{{__('Îți mulțumim pentru generozitate!')}}</p>
        </div>
    </section>
@endsection
