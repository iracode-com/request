<?php

return [
    'archive' => [
        'single' => [
            'label'         => 'بایگانی',
            'modal'         => [
                'heading' => 'بایگانی :label',
                'actions' => [
                    'archive' => [
                        'label' => 'بایگانی',
                    ],
                ],
            ],
            'notifications' => [
                'archived' => [
                    'title' => 'رکورد بایگانی شد',
                ],
            ],
        ],
    ],

    'unarchive' => [
        'single' => [
            'label'         => 'لغو بایگانی',
            'modal'         => [
                'heading' => 'لغو بایگانی :label',
                'actions' => [
                    'unarchive' => [
                        'label' => 'لغو بایگانی',
                    ],
                ],
            ],
            'notifications' => [
                'unarchived' => [
                    'title' => 'Record لغو بایگانی',
                ],
            ],
        ],
    ],
];
