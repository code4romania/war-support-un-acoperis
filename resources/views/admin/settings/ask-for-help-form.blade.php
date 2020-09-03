@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Specialist warning info',
        'name' => 'ask_for_help_form_specialist_warning_info',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])

    @formField('wysiwyg', [
        'label' => 'Specialist submit error message',
        'name' => 'ask_for_help_form_specialist_submit_error',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true,
        'toolbarOptions' => [
            'link',
        ],
        'editSource' => true
    ])

    @formField('input', [
        'label' => 'Successful submit message',
        'name' => 'ask_for_help_form_success_message',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
@stop
