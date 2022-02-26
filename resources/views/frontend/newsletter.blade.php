@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Newsletter') }}</h1>
    </div>
    <section class="bg-light-green py-5">
        <div class="container">
            <div id="mc_embed_signup">
                {{-- TODO: replace the subscribe form URL --}}
                <form class="mc-nl-subscribe" action="https://redecs.us8.list-manage.com/subscribe/post?u=ff2e2b20f5fa00ec343969c94&amp;id=98675ea750" method="post" target="_blank">
                    <div class="card shadow mb-4 ps">
                        <div class="card-header bg-primary">
                            <h6 class="mb-0 text-white font-weight-600">{{ __('Subscribe to newsletter') }}</h6>
                        </div>
                        <div class="card-body py-5">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required font-weight-600" for="mce-FNAME">{{ __('First Name') }}</label>
                                        <input id="mce-FNAME" class="form-control" name="FNAME" type="text" placeholder="{{ __('First Name Placeholder') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required font-weight-600" for="mce-LNAME">{{ __('Last Name') }}</label>
                                        <input id="mce-LNAME" class="form-control" name="LNAME" type="text" placeholder="{{ __('Last Name Placeholder') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required font-weight-600" for="mce-EMAIL">{{ __('Email') }}</label>
                                        <input id="mce-EMAIL" class="form-control" name="EMAIL" type="email" placeholder="{{ __('Email Placeholder') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-600 mb-3 mt-3 d-block required">{{ __('Language') }}</label>
                                        <div class="form-check form-check-inline mb-3 flex-column flex-sm-row align-items-start">
                                            <div class="custom-control custom-radio mr-4 mb-3">
                                                <input class="custom-control-input" type="radio" value="Română" name="LANG" id="mce-LANG-0" required>
                                                <label class="custom-control-label" for="mce-LANG-0">Română</label>
                                            </div>
                                            <div class="custom-control custom-radio mr-4 mb-3">
                                                <input class="custom-control-input" type="radio" value="Український" name="LANG" id="mce-LANG-1" required>
                                                <label class="custom-control-label" for="mce-LANG-1">Український</label>
                                            </div>
                                            <div class="custom-control custom-radio mr-4 mb-3">
                                                <input class="custom-control-input" type="radio" value="English" name="LANG" id="mce-LANG-2" required>
                                                <label class="custom-control-label" for="mce-LANG-2">English</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline mb-1 flex-column flex-sm-row align-items-start">
                                            <div class="custom-control custom-checkbox mr-4 mb-1">
                                                <input class="custom-control-input" type="checkbox" value="1" name="AGREE_TC" id="mce-AGREE_TC">
                                                <label class="custom-control-label" for="mce-AGREE_TC">{!!  __('I agree with <a href=":url">GDPR</a> terms.', ['url' => '#']) !!}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ff2e2b20f5fa00ec343969c94_98675ea750" tabindex="-1" value=""></div>
                            <div class="border-top pt-5 mt-3 clearfix">
                                <button class="btn btn-secondary btn-lg px-6" type="submit">{{ __('Subscribe') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
@endsection
