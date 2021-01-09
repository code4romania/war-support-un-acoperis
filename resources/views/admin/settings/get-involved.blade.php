@extends('twill::layouts.settings')

@section('contentFields')

    @formField('wysiwyg', [
        'label' => 'Description',
        'name' => 'get_involved_description',
        'type' => 'textarea',
        'required' => true,
        'translated' => true,
        'textLimit' => 200,
        'toolbarOptions' => [
        ['header' => [2, 3, 4, 5, 6, false]],
        'bold',
        'italic',
        'underline',
        'strike',
        ["script" => "super"],
        ["script" => "sub"],
        "blockquote",
        "code-block",
        ['list' => 'ordered'],
        ['list' => 'bullet'],
        ['indent' => '-1'],
        ['indent' => '+1'],
        ["align" => []],
        ["direction" => "rtl"],
        'link',
        "clean",
        ],
        'textLimit' => 200,
        'note' => 'Limited to 200 characters',
    ])
@stop
