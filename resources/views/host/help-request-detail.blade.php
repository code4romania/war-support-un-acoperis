<div class="card shadow">
    <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
        <h6 class="font-weight-600 text-white mb-0">
            {{ __('Request #') }}{{ $helpRequest->id }} - {{ $helpRequest->user->name }}
        </h6>
    </div>
    <div class="card-body pt-4">
        <h4 class="font-weight-600 text-primary mb-5">{{ $helpRequest->patient_full_name }}</h4>
        <div class="row">
            <div class="col-sm-6">
                <ul class="details-wrapper list-unstyled mb-4">
                    <li class="d-flex align-items-start">
                        <i class="fa fa-group"></i>
                        <span>
                             {{ __("Number of people") }}: {{ $helpRequest->guests_number }}
                             </span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="fa fa-map-marker"></i>
                        <span>
                             {{ __("Location") }}: {{ $helpRequest->current_location }}
                             </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                             {{ __("Phone") }} <b>{{ $helpRequest->user->phone_number }}</b>
                         </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-at"></i>
                        <span>
                             {{ __("Email")  }}:  <a href="mailto:{{ $helpRequest->user->email }}" target="_blank">{{ $helpRequest->user->email }}</a>
                         </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-language"></i>
                        <span>
                             {{ __("Known Languages") }}: <b>{{ implode(",", json_decode($helpRequest->known_languages) ?? []) }}</b>
                         </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-car"></i>
                        <span>
                             {{ __("Transportation") }}: <b> {{ $helpRequest->need_special_transport ? __("Special transport") :  ($helpRequest->need_car ? __("Need car") : __("No car needed")) }}</b>
                         </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-wheelchair-alt"></i>
                        <span>
                             {{ __("Special Needs") }}: <b> {{ $helpRequest->special_needs }}</b>
                         </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-top border-bottom py-4 mt-4">
            <h6 class="font-weight-600">{{ __('Other People') }}</h6>
            @if(count(json_decode($helpRequest->with_peoples)))
                <div class="row">
                    <div class="col-sm-3"><b>{{ __("Name") }}</b></div>
                    <div class="col-sm-2"><b>{{ __("Age") }}</b></div>
                    <div class="col-sm-6"><b>{{ __("Mentions") }}</b></div>
                </div>
            @endif
            @foreach(json_decode($helpRequest->with_peoples) ?? [] as $human)
                <div class="row">
                    <div class="col-sm-3">{{ $human->name }}</div>
                    <div class="col-sm-2">{{ $human->age }}</div>
                    <div class="col-sm-6">{{ $human->mentions }}</div>
                </div>
            @endforeach
        </div>
        <div class="border-bottom py-4">
            <h6 class="font-weight-600">{{ __('More details') }}:</h6>
            <p class="mb-0">
                <i>
                    {{ $helpRequest->more_details ?? 'N/A' }}
                </i>
            </p>
        </div>
    </div>
</div>
