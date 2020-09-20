@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'homepage_title',
        'label' => 'Homepage title',
        'translated' => true,
        'maxlength' => 155
    ])

    @formField('input', [
        'name' => 'description',
        'label' => 'Description',
        'translated' => true,
        'maxlength' => 155
    ])

    @formField('medias', [
        'name' => 'logo',
        'label' => 'Logo',
        'note' => 'Also used in listings',
        'fieldNote' => 'Minimum image width: 1500px'
    ])

    @formField('input', [
        'name' => 'url',
        'label' => 'URL',
    ])
@stop
