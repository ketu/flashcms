<?php
return [
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

    ]
];