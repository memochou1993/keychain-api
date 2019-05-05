<?php

return [

    'user' => [
        'id' => 1,
        'name' => 'Administrator',
        'username' => 'username',
        'email' => 'admin@email.com',
        'email_verified_at' => now(),
        'password' => '$argon2i$v=19$m=1024,t=2,p=2$UThmSUxhMU12OVRwV3VaWg$OrU1Vlm51hSvU89zeCbiFTn0l335EcKBw5U6kQoE5No', // password
        'settings' => json_encode([
            'language' => 'en',
            'lock' => false,
            'strict' => false,
            'keep' => false,
            'keepDays' => 7,
            'paging' => 'loadMoreButton',
            'paginate' => 15,
            'theme' => '',
        ]),
    ],

];
