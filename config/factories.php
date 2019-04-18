<?php

return [

    'user' => [
        'name' => 'Administrator',
        'email' => 'admin@email.com',
        'email_verified_at' => now(),
        'password' => '$argon2i$v=19$m=1024,t=2,p=2$UUxxaWZ1akM1dzlmbEtiNA$+Q2+IURHJIe0xYmLds0j3x59SeC+77W6/Qp9wR85jQY', // secret
        'settings' => json_encode([
            'key' => [
                'strict' => true,
                'paginate' => 15,
                'pagination' => false,
            ],
        ]),
    ],

];
