@extends('layouts.app')

@section('content')
    <div class="upload-banner"></div>
    <div class="upload-form-container pb-lg">
        <div class="container pb-300">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body text-center">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <i class="ni ni-like-2 d-inline-block rounded-circle shadow-sm text-white bg-primary p-3 my-4"></i>
                            <h4 class="text-center mb-4">
                                {{ __('Your request was successfully sent.') }}
                                <br>
                                {{ __('Thank you!') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
