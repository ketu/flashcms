<?php
return [
    'frontend'=> [
        'view'=> 'frontend'
    ],
    'installed' => env('FLASHCMS_INSTALLED', false),
    'role'=> [
        'default'=> 'ROLE_USER',
        'super'=> 'ROLE_SUPER_ADMIN',
    ],
    'backend'=> [
        'prefix'=> 'backend',
        'view'=> 'backend'
    ],

    'attribute'=> [
        'type'=> [
            'text'=> 'Text',
            'textarea'=> 'Textarea',
            'select'=> 'Select',
            'checkbox'=> 'Checkbox'
        ],
        'hasOption'=> [
            'select',
            'checkbox'
        ]
    ],
    'uploader'=> [
        'folder'=> [
            'product'=>  'upload/product',
            'blog'=> 'upload/blog',
            'gallery'=>  'upload/gallery',
            'link'=> 'upload/link'
        ]
    ],
    'image'=> [
        'default'=> [
            'width'=> 150,
            'height'=> 150,
            'watermark'=> false,
        ],
        'product'=> [
            'width'=> 150,
            'height'=> 150,
            'watermark'=> false,
        ],
         'gallery'=> [
            'width'=> 150,
            'height'=> 150,
            'watermark'=> false,
        ],
    ]
];