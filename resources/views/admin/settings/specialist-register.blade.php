@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Info',
        'name' => 'specialist_register_info',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
    @formField('input', [
        'label' => 'Approval',
        'name' => 'specialist_register_approval',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
@stop
