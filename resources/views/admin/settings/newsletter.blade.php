@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Title',
        'name' => 'newsletter_title',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
    @formField('input', [
        'label' => 'Body',
        'name' => 'newsletter_body',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
@stop
