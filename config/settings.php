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
        'avatar' => [
            'path_store' => 'public/uploads/avatars',
            'path_default' => 'images/user_default.png',
        ],
        'category' => [
            'is_parent' => 0,
            'category_default' => 1,
            'per_page' => 1,
        ],
        'document' => [
            'path_store' => 'public/uploads/documents',
            'path_thumbnail' => 'public/uploads/thumbnails',
            'status' => [
                'is_illegal' => 0,
                'is_checking' => 1,
                'is_published' => 2,
            ],
            'uploaded' => [
                'paginate' => 4,
            ],
            'top_new' => 10,
            'paginate_per_page' => 8,
            'top_views' => 8,
            'is_bookmark' => [
                'true' => true,
                'false' => false,
            ],
            'bookmark' => [
                'paginate' => 4,
            ]
        ],
        'search' => [
            'by_all' => 'all',
        ],
        'comment' => [
            'paginate' => 10,
        ],
        'user' => [
            'paginate' => 10,
        ],
        'top_related_document' => 10,
        'report' => [
            'status' => [
                'unread' => 0,
                'read' => 1,
            ],
        ],
        'locale' => [
            'vi' => 'vi',
            'en' => 'en',
        ],
        'notification' => [
            'status' => [
                'unread' => 0,
                'read' => 1,
            ],
        ],
    ];
