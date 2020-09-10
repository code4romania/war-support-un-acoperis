@extends('twill::layouts.form')

@section('contentFields')
    @formField('checkbox', [
        'name' => 'featured',
        'label' => 'Featured'
    ])

    @formField('medias', [
        'name' => 'cover',
        'label' => 'Cover image',
        'note' => 'Note',
        'fieldNote' => 'Works only when Featured is enabled'
    ])

    @formField('block_editor', [
        'label' => 'Blocks',
    ])
@stop
