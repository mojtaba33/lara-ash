<?php

return [
    'default_super_admin' => [
        'name' => 'mojtaba',
        'email' => 'mojtaba@gmail.com',
        'password' => 12345678
    ],

    'default_roles' => [
        [
            'title' => 'Senior-administrator',
            'fa_title' => 'مدیر ارشد سابت'
        ],
        [
            'title' => 'Writer',
            'fa_title' => 'نویسنده'
        ]
    ],

    'default_permissions' => [
        [
            'title' => 'edit-users',
            'fa_title' => 'مدیریت کاربران'
        ],
    ],
];
