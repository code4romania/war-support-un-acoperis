@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'First section title',
        'name' => 'hb_section_1_title',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'required' => true,
        'translated' => true
    ])
    @formField('wysiwyg', [
        'label' => 'First section body',
        'name' => 'hb_section_1_body',
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
        'label' => 'Body',
        'textLimit' => 200,
        'note' => 'Limited to 200 characters',
    ])

    @formField('input', [
        'label' => 'Second section title',
        'name' => 'hb_section_2_title',
        'textLimit' => '135',
        'required' => true,
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
    @formField('wysiwyg', [
        'label' => 'Second section body',
        'name' => 'hb_section_2_body',
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
        'label' => 'Body',
        'textLimit' => 200,
        'note' => 'Limited to 200 characters',
    ])

    @formField('input', [
        'label' => 'Third section title',
        'name' => 'hb_section_3_title',
        'required' => true,
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])
    @formField('wysiwyg', [
        'label' => 'Third section body',
        'name' => 'hb_section_3_body',
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
        'label' => 'Body',
        'textLimit' => 200,
        'note' => 'Limited to 200 characters',
    ])
@stop

