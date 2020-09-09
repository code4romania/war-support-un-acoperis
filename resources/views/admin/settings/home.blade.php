@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
        'label' => 'Welcome title',
        'name' => 'welcome_title',
        'textLimit' => '135',
        'note' => 'Limited to 135 characters',
        'translated' => true
    ])

    @formField('wysiwyg', [
        'label' => 'Welcome body',
        'name' => 'welcome_body',
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
    'label' => 'How can we help title',
    'name' => 'help_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('input', [
    'label' => 'Help block 1 title',
    'name' => 'help_block_1_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Help block 1 body',
    'name' => 'help_block_1_body',
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
    'label' => 'Help block 2 title',
    'name' => 'help_block_2_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Help block 2 body',
    'name' => 'help_block_2_body',
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
    'label' => 'Help block 3 title',
    'name' => 'help_block_3_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Help block 3 body',
    'name' => 'help_block_3_body',
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
    'label' => 'Help block 4 title',
    'name' => 'help_block_4_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Help block 4 body',
    'name' => 'help_block_4_body',
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
    'label' => 'About title',
    'name' => 'about_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'About body',
    'name' => 'about_body',
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
    'label' => 'Ask for services title',
    'name' => 'ask_services_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Ask for services body',
    'name' => 'ask_services_body',
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
    'label' => 'Become a host title',
    'name' => 'become_host_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Become a host body',
    'name' => 'become_host_body',
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
    'label' => 'Footer block 1 title',
    'name' => 'footer_block_1_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Footer block 1 body',
    'name' => 'footer_block_1_body',
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
    'label' => 'Footer block 2 title',
    'name' => 'footer_block_2_title',
    'textLimit' => '135',
    'note' => 'Limited to 135 characters',
    'translated' => true
    ])

    @formField('wysiwyg', [
    'label' => 'Footer block 2 body',
    'name' => 'footer_block_2_body',
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
