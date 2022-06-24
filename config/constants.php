<?php

return [
    'SuperAdminRoleId' => 1,
    'SuperAdminUserId' => 1,
    'UserTypeIds' => [
        'SuperAdmin' => -10021,
        'Company' => -10022,
        'User' => -10023,
        'Admin' => -10024,
    ],
    'UserRoleIds' => [
        'SuperAdmin' => 1,
        'Admin' => 2,
        'Company' => 3,
        'User' => 4,
    ],
    'imagetypes' => [
        'jpeg' => 'jpeg',
        'jpg' => 'jpg',
        'png' => 'png',
    ],
    'docandimgetypes' => [
        'jpeg' => 'jpeg',
        'jpg' => 'jpg',
        'png' => 'png',
        'spreadsheetml' => 'xlsx',
        'powerpoint' => 'pptx',
        'ms-excel' => 'xls',
        'docx' => 'docx',
        'doc' => 'doc',
        'pdf' => 'pdf',
        'html' => 'html',

    ],
    'attachment_paths' => [
        'CompetitorAttachment' => "/uploads/competitor/",
        'OrganizationProfile' => "/uploads/organization/profile",
    ],

    'stripe'=>[
        'key' => 'pk_test_51IErxrHrhuVhzQ8TB8F402KsN7Unxkfgx3V247VhTNjVLqvN8QC0HX6o79gSS66RPJ43j5ZPM3lhlh7OjwxBZ9Z700QwX8Y72o',
        'secret' => 'sk_test_51IErxrHrhuVhzQ8TIbdE4f975xBopqJ10byr1jYlebjxeBwLS8vFd5kKhbLW44CLdhTCzHwFF6JqDoOUVbIMlQ1q00FFBfIc0v'
    ],

    'Oauth'=>[
        'google' => [
            'key' => '68628598894-d5ouqtnuie580vh5f7agsu0193e5bimv.apps.googleusercontent.com',
            'secret' => '-LMtE-9wE2p765g7f-eFWNAF'
        ]
    ],
    'Category'=>[
        'Normal' => -12220,
        'Important' => -12221,
        'Announcement' => -12222
    ]

];
