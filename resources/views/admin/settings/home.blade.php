@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Homepage message',
        'name' => 'homepage_message',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
@stop
