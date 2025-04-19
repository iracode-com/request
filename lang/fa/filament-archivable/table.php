<?php

return [
    'filters' => [
        'archived' => [
            'label'            => 'رکورد های بایگانی شده',
            'only_archived'    => 'فقط رکورد های بایگانی شده',
            'with_archived'    => 'همراه رکورد های بایگانی شده',
            'without_archived' => 'بدون رکورد های بایگانی شده',
        ],
    ],

    'actions' => [
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
                        'title' => 'رکورد لغو بایگانی شد',
                    ],
                ],
            ],
        ],
    ],
];
