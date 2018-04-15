<?php
    return [
        'gender' => [
            'male' => 1,
            'female' => 0,
        ],
        'rules' => [
            'is_user' => 0,
            'is_moderator' => 1,
            'is_admin' => 2,
        ],
        'is_ban' => [
            'true' => true,
            'false' => false,
        ],
        'is_illegal' => [
            'true' => true,
            'false' => false,
        ],
        'avatar' => [
            'path_store' => 'public/uploads/avatars',
            'path_default' => 'images/user_default.png',
        ]
    ];
