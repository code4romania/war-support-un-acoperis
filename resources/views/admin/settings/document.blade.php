@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Title',
        'name' => 'document_form_title',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
    @formField('input', [
        'label' => 'Duplicate info',
        'name' => 'document_form_info',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
@stop
