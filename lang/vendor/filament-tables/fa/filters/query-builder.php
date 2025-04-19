<?php

return [

    'label' => 'سازنده پرس و جو',

    'form' => [

        'operator' => [
            'label' => 'عملگر',
        ],

        'or_groups' => [

            'label' => 'گروه ها',

            'block' => [
                'label' => 'تفکیک (OR)',
                'or' => 'OR',
            ],

        ],

        'rules' => [

            'label' => 'قوانین',

            'item' => [
                'and' => 'AND',
            ],

        ],

    ],

    'no_rules' => '(بدون قوانین)',

    'item_separators' => [
        'and' => 'AND',
        'or' => 'OR',
    ],

    'operators' => [

        'is_filled' => [

            'label' => [
                'direct' => 'نوشته است',
                'inverse' => 'نانوشته است',
            ],

            'summary' => [
                'direct' => ':attribute نوشته است',
                'inverse' => ':attribute خالی است',
            ],

        ],

        'boolean' => [

            'is_true' => [

                'label' => [
                    'direct' => 'True است',
                    'inverse' => 'False است',
                ],

                'summary' => [
                    'direct' => ':attribute True است',
                    'inverse' => ':attribute False است',
                ],

            ],

        ],

        'date' => [

            'is_after' => [

                'label' => [
                    'direct' => 'بعد از',
                    'inverse' => 'بعد نیست',
                ],

                'summary' => [
                    'direct' => ':attribute بعد از :date',
                    'inverse' => ':attribute بعد نیست :date',
                ],

            ],

            'is_before' => [

                'label' => [
                    'direct' => 'قبل از',
                    'inverse' => 'قبل نیست',
                ],

                'summary' => [
                    'direct' => ':attribute قبل از :date',
                    'inverse' => ':attribute قبل نیست :date',
                ],

            ],

            'is_date' => [

                'label' => [
                    'direct' => 'تاریخ است',
                    'inverse' => 'تاریخ نیست',
                ],

                'summary' => [
                    'direct' => ':attribute است :date',
                    'inverse' => ':attribute نیست :date',
                ],

            ],

            'is_month' => [

                'label' => [
                    'direct' => 'ماه است',
                    'inverse' => 'ماه نیست',
                ],

                'summary' => [
                    'direct' => ':attribute است :month',
                    'inverse' => ':attribute نیست :month',
                ],

            ],

            'is_year' => [

                'label' => [
                    'direct' => 'سال است',
                    'inverse' => 'نیست سال',
                ],

                'summary' => [
                    'direct' => ':attribute است :year',
                    'inverse' => ':attribute نیست :year',
                ],

            ],

            'form' => [

                'date' => [
                    'label' => 'تاریخ',
                ],

                'month' => [
                    'label' => 'ماه',
                ],

                'year' => [
                    'label' => 'سال',
                ],

            ],

        ],

        'number' => [

            'equals' => [

                'label' => [
                    'direct' => 'برابر',
                    'inverse' => 'برابر نیست',
                ],

                'summary' => [
                    'direct' => ':attribute برابر با :number',
                    'inverse' => ':attribute برابر نیست با :number',
                ],

            ],

            'is_max' => [

                'label' => [
                    'direct' => 'بزرگترین است',
                    'inverse' => 'بزرگتر است از',
                ],

                'summary' => [
                    'direct' => ':attribute بزرگترین است :number',
                    'inverse' => ':attribute بزرگتر است از :number',
                ],

            ],

            'is_min' => [

                'label' => [
                    'direct' => 'کمترین است',
                    'inverse' => 'کمتر است از',
                ],

                'summary' => [
                    'direct' => ':attribute کمترین است :number',
                    'inverse' => ':attribute کمتر است از :number',
                ],

            ],

            'aggregates' => [

                'average' => [
                    'label' => 'میانگین',
                    'summary' => 'میانگین :attribute',
                ],

                'max' => [
                    'label' => 'بیشترین',
                    'summary' => 'بیشترین :attribute',
                ],

                'min' => [
                    'label' => 'کمترین',
                    'summary' => 'کمترین :attribute',
                ],

                'sum' => [
                    'label' => 'مجموع',
                    'summary' => 'مجموع از :attribute',
                ],

            ],

            'form' => [

                'aggregate' => [
                    'label' => 'جمع',
                ],

                'number' => [
                    'label' => 'عدد',
                ],

            ],

        ],

        'relationship' => [

            'equals' => [

                'label' => [
                    'direct' => 'دارد',
                    'inverse' => 'ندارد',
                ],

                'summary' => [
                    'direct' => 'دارد :count :relationship',
                    'inverse' => 'ندارد :count :relationship',
                ],

            ],

            'has_max' => [

                'label' => [
                    'direct' => 'دارای حداکثر',
                    'inverse' => 'دارای بیشتر از',
                ],

                'summary' => [
                    'direct' => 'دارای حداکثر :count :relationship',
                    'inverse' => 'دارای بیشتر از :count :relationship',
                ],

            ],

            'has_min' => [

                'label' => [
                    'direct' => 'دارای حداقل',
                    'inverse' => 'دارای کمتر از',
                ],

                'summary' => [
                    'direct' => 'دارای حداقل :count :relationship',
                    'inverse' => 'دارای کمتر از :count :relationship',
                ],

            ],

            'is_empty' => [

                'label' => [
                    'direct' => 'خالی است',
                    'inverse' => 'نیست خالی',
                ],

                'summary' => [
                    'direct' => ':relationship خالی است',
                    'inverse' => ':relationship خالی نیست',
                ],

            ],

            'is_related_to' => [

                'label' => [

                    'single' => [
                        'direct' => 'است',
                        'inverse' => 'نیست',
                    ],

                    'multiple' => [
                        'direct' => 'شامل است',
                        'inverse' => 'شامل نیست',
                    ],

                ],

                'summary' => [

                    'single' => [
                        'direct' => ':relationship است :values',
                        'inverse' => ':relationship نیست :values',
                    ],

                    'multiple' => [
                        'direct' => ':relationship شامل :values',
                        'inverse' => ':relationship شامل نیست :values',
                    ],

                    'values_glue' => [
                        0 => ', ',
                        'final' => ' or ',
                    ],

                ],

                'form' => [

                    'value' => [
                        'label' => 'مقدار',
                    ],

                    'values' => [
                        'label' => 'مقادیر',
                    ],

                ],

            ],

            'form' => [

                'count' => [
                    'label' => 'تعداد',
                ],

            ],

        ],

        'select' => [

            'is' => [

                'label' => [
                    'direct' => 'است',
                    'inverse' => 'نیست',
                ],

                'summary' => [
                    'direct' => ':attribute است :values',
                    'inverse' => ':attribute نیست :values',
                    'values_glue' => [
                        ', ',
                        'final' => ' or ',
                    ],
                ],

                'form' => [

                    'value' => [
                        'label' => 'مقدار',
                    ],

                    'values' => [
                        'label' => 'مقادیر',
                    ],

                ],

            ],

        ],

        'text' => [

            'contains' => [

                'label' => [
                    'direct' => 'شامل است',
                    'inverse' => 'شامل نیست',
                ],

                'summary' => [
                    'direct' => ':attribute شامل :text',
                    'inverse' => ':attribute شامل نیست :text',
                ],

            ],

            'ends_with' => [

                'label' => [
                    'direct' => 'پایان میابد با',
                    'inverse' => 'پایان نمیابد با',
                ],

                'summary' => [
                    'direct' => ':attribute پایان میابد با :text',
                    'inverse' => ':attribute پایان نمیابد با :text',
                ],

            ],

            'equals' => [

                'label' => [
                    'direct' => 'برابر است با',
                    'inverse' => 'برابر نیست با',
                ],

                'summary' => [
                    'direct' => ':attribute برابر است با :text',
                    'inverse' => ':attribute برابر نیست با :text',
                ],

            ],

            'starts_with' => [

                'label' => [
                    'direct' => 'شروع میشود با',
                    'inverse' => 'شروع نمیشود با',
                ],

                'summary' => [
                    'direct' => ':attribute شروع میشود با :text',
                    'inverse' => ':attribute شروع نمیشود با :text',
                ],

            ],

            'form' => [

                'text' => [
                    'label' => 'متن',
                ],

            ],

        ],

    ],

    'actions' => [

        'add_rule' => [
            'label' => 'افزودن قانون',
        ],

        'add_rule_group' => [
            'label' => 'افزودن گروه قوانین',
        ],

    ],

];
