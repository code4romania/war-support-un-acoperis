<?php

return [
    'enabled' => [
        'users-oauth' => false,
        'twill-navigation' => false,
        'settings' => true,
    ],
    'users_table' => 'users',
//    'dev_mode' => true,
    'media_library' => [
        'disk' => 'twill_media_library',
        'endpoint_type' => env('MEDIA_LIBRARY_ENDPOINT_TYPE', 's3'),
        'cascade_delete' => env('MEDIA_LIBRARY_CASCADE_DELETE', false),
        'local_path' => env('MEDIA_LIBRARY_LOCAL_PATH', 'uploads'),
        'image_service' => env('MEDIA_LIBRARY_IMAGE_SERVICE', 'A17\Twill\Services\MediaLibrary\Local'),
        'acl' => env('MEDIA_LIBRARY_ACL', 'private'),
        'filesize_limit' => env('MEDIA_LIBRARY_FILESIZE_LIMIT', 50),
        'allowed_extensions' => ['svg', 'jpg', 'gif', 'png', 'jpeg'],
        'init_alt_text_from_filename' => true,
        'prefix_uuid_with_local_path' => config('twill.file_library.prefix_uuid_with_local_path', false),
        'translated_form_fields' => false,
    ],
    'block_editor' => [
        'blocks' => [
            'paragraph' => [
                'title' => 'Paragraph',
                'icon' => 'text',
                'component' => 'a17-block-paragraph'
            ],
            'subtitle' => [
                'title' => 'Subtitle',
                'icon' => 'text',
                'component' => 'a17-block-subtitle'
            ],
            'image' => [
                'title' => 'Image',
                'icon' => 'image',
                'component' => 'a17-block-image'
            ],
            'partners' => [
                'title' => 'Partners',
                'icon' => 'image',
                'component' => 'a17-block-partners'
            ],
            'homepage-partners' => [
                'title' => 'Homepage partners',
                'icon' => 'image',
                'component' => 'a17-block-homepage-partners'
            ],
            'wordwall-embed' => [
                'title' => 'Wordwall embed',
                'icon' => 'text',
                'component' => 'a17-block-wordwall-embed',
            ],
        ],
    ],
    'navigations' => [
        'header' => [
            'about' => 1,
        ],
        'footer' => [
            'partners' => 2,
            'about' => 1,
            'media' => 3,
            'news' => 6,
            'gdpr' => 4,
            'terms-and-conditions' => 5,
        ]
    ]
];
