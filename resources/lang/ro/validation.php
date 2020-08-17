<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Cămpul :attribute trebuie acceptat.',
    'active_url' => ':attribute nu este un URL activ.',
    'after' => 'Câmpul :attribute trebuie sa fie o dată după :date.',
    'after_or_equal' => 'Câmpul :attribute trebuie să fie o dată după sau egală cu :date.',
    'alpha' => 'Câmpul :attribute trebuie să fie format doar din litere.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Câmpul :attribute trebuie să conțină valori între :min și :max.',
        'file' => ':attribute trebuie să aibă dimensiunea între :min și :max kilobytes.',
        'string' => 'Câmpul :attribute trebuie să conțină între :min și :max caractere.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => ':attribute nu a fost confirmată corect.',
    'date' => 'Câmpul :attribute nu este o dată validă.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'Câmpul :attribute nu respectă formatul :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Câmpul :attribute trebuie să fie o adresa de email validă.',
    'ends_with' => 'Câmpul :attribute trebuie sa se termine cu una dintre urmatoarele valori: :values',
    'exists' => 'Valoarea selectată pentru :attribute este invalidă.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'Câmpul :attribute trebuie să fie o imagine.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute trebuie să fie maxim :max.',
        'file' => ':attribute nu trebuie să fie mai mare de :max kilobytes.',
        'string' => 'Câmpul :attribute nu poate fi mai lung de :max caractere.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'Câmpul :attribute trebuie să fie un fișier de tipul: :values.',
    'mimetypes' => 'Câmpul :attribute trebuie să fie un fișier de tipul: :values.',
    'min' => [
        'numeric' => 'Câmpul :attribute trebuie să conțină minim :min caractere.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Câmpul :attribute trebuie să conțină minim :min caractere.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Câmpul :attribute trebuie să fie un număr.',
    'password' => 'Parola este incorectă.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'Formatul câmpului :attribute este invalid.',
    'required' => 'Câmpul :attribute este obligatoriu.',
    'required_if' => 'Câmpul :attribute este obligatoriu când :other este :value.',
    'required_unless' => 'Câmpul :attribute este obligatoriu exceptând atunci când :other are una dintre următoarele valori :values.',
    'required_with' => 'Câmpul :attribute este obligatoriu cand :values este prezent.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'Câmpul :attribute trebuie să conțină minim :size caractere.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'Câmpul :attribute trebuie să înceapă cu: :values',
    'string' => 'Câmpul :attribute trebuie sa fie alfanumeric.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Acest :attribute este deja folosit.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'Câmpul :attribute este invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'phone' => 'Numarul de telefon trebuie sa fie valid',
    'max_file_count' => 'Maxim :files fisiere sunt permise.',
    'max_file_size' => 'Fişierele nu pot depăși :size.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'g-recaptcha-response' => [
            'required' => 'Validează că nu ești robot..',
            'captcha' => 'Nu am putut valida că nu ești robot. Încearcă din nou mai târziu sau contactează administratorul siteului..',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'first_name' => 'prenume',
        'last_name' => 'nume',
        'name' => 'nume',
        'terms' => 'termeni și condiții',
        'phone' => 'telefon',
        'password' => 'parola',

        'patient-name' => 'nume pacient',
        'patient-phone' => 'telefon pacient',
        'patient-email' => 'email pacient',
        'patient-county' => 'județ',
        'patient-city' => 'localitate',
        'patient-diagnostic' => 'diagnostic',
        'caretaker-name' => 'numele persoanei ce completeaza formularul',
        'caretaker-phone' => 'telefonul persoanei ce completează formularul',
        'caretaker-email' => 'e-mailul persoanei ce completează formularul',

        'sms-estimated-amount' => 'suma estimativă',
        'sms-purpose' => 'destinația fondurilor',
        'sms-clinic-name' => 'denumirea clinicii',
        'sms-clinic-country' => 'țara',
        'sms-clinic-city' => 'localitatea',

        'accommodation-clinic-name' => 'denumirea clinicii',
        'accommodation-country' => 'țara',
        'accommodation-city' => 'localitatea',
        'accommodation-guests-number' => 'numărul de persoane',
        'accommodation-start-date' => 'data de început',
        'accommodation-end-date' => 'data de sfrârșit',

        'request-other-message' => 'mesaj',
        'help-type-8' => 'alte nevoi',

        'categories' => 'categorii',
        'country' => 'țara',
        'city' => 'localitate',
        'address' => 'adresă',
        'contact_name' => 'nume persoană de contact',
        'contact_phone' => 'telefon persoană de contact',
        'contact_email' => 'email persoană de contact',
        'description' => 'descriere',
        'extra_details' => 'informații suplimentare',
        'transport_details' => 'modalități de transport',

        'type' => 'tip',
        'ownership' => 'regim proprietate',
        'property_availability' => 'tip cazare',
        'max_guests' => 'numărul maxim de persoane',
        'available_rooms' => 'numărul de camere',
        'available_bathrooms' => 'numărul de băi',
        'allow_kitchen' => 'folosirea bucatariei',
        'allow_parking' => 'parcare',
        'street' => 'strada',
        'building' => 'bloc',
        'entrance' => 'scara',
        'apartment' => 'apartament',
        'floor' => 'etaj',
        'postal_code' => 'cod postal',
        'allow_smoking' => 'fumat',
        'allow_pets' => 'animale',
        'transport_subway_distance' => 'distanță metrou',
        'transport_bus_distance' => 'distanță autobuz',
        'transport_railway_distance' => 'distanță gară',
        'general_fee' => 'suma estimativă',
        'other_rules' => 'alte reguli',
        'accommodation_fee' => 'costuri de cazare',
        'paid' => 'contra-cost',
        'unavailable_from' => 'indisponibil de la data',
        'unavailable_to' => 'indisponibil pana la data'
    ],
    'dates' => [
        'today' => 'azi'
    ]
];
