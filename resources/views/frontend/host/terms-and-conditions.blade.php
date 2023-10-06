@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="display-3 title mb-4 text-secondary">{{ __('Offer accommodation') }}</h1>
        <div>
            {!! $description !!}
        </div>
    </div>

    <section class="bg-h4h-form py-5">
        <div class="container">

            <div class="card shadow mb-4">
                <div class="card-header bg-primary">
                    <h6 class="mb-0 text-white font-weight-600">
                        1. {{ __('Terms and conditions') }}
                    </h6>
                </div>
                <div class="card-body py-5">
                    {!! $termsAndConditionsForHosts !!}
                    <button class="btn btn-secondary" data-target="#userSignature" data-toggle="modal"> semneaza
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="userSignature" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{__('Signature') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="signature-pad">
                        <div class="signature-pad--body">
                            <div class="invalid-feedback"></div>
                            <canvas></canvas>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('store-hosts-terms-agreed') }}" id="sendGetInvolved">
                        @csrf
                        {{ Form::hidden('invisible', 'secret',array('id' => 'hidden-signature')) }}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning clear">{{ __('Clear') }}</button>
                    {!! NoCaptcha::displaySubmit('', '' . __('I agree') . " <i class=\"fa fa-arrow-right\"></i>", ['type' => 'submit', 'id' => 'submit-button-2', 'class' => 'btn btn-secondary btn-h4h-offer-help-submit pull-right btn-lg px-6', 'onClick'=>'onAgreeOnTermsAndConditions()']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        /**
         * Customer Signature
         * */
        let signaturePad;
        $('#userSignature').on('shown.bs.modal', function(e) {
            let canvas = $("#signature-pad canvas");
            let parentWidth = $(canvas).parent().outerWidth();
            let parentHeight = $(canvas).parent().outerHeight();
            canvas.attr("width", parentWidth + 'px')
                .attr("height", parentHeight + 'px');
            signaturePad = new SignaturePad(canvas[0], {
                backgroundColor: 'rgb(255, 255, 255)'
            });
        })
        $('#userSignature').on('hidden.bs.modal', function(e) {
            signaturePad.clear();
        });
        $(document).on('click', '#userSignature .clear', function() {
            signaturePad.clear();
        });

        function onAgreeOnTermsAndConditions() {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                let dataURL = signaturePad.toDataURL();
                $('.signature').attr('src', dataURL);
                $('#hidden-signature').val(dataURL);
                $('#userSignature').modal('hide');

                document.getElementById("sendGetInvolved").submit();
            }
        }
    </script>
@endsection
