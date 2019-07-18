<?php

$config['connect'] =
[
    'ip' => 'daffyy.pro',
    'port' => 10011,
    'login' => 'serveradmin',
    'password' => 'gsHsIRCL',
];

$config['function'] = 
[
        1 => 
        [
            'instance_name' => '✯dBot @ Pracuś ',
            'functions' => ['random_sname', 'channel_poke'],

            'random_sname' => 
            [
                'status' => true,
                'names' => ['✯ daffyy.pro ✯ - Prywatny timspik czy', "✯ daffyy.pro ✯ - Programista / Web Developer / Freelancer", 
                '✯ daffyy.pro ✯ - Gramy i kodzimy!'],

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],
            ],

            'channel_poke' =>
            [
                'status' => true,
                'channels' =>
                [
                    41 => '10',
                ],
                'admin_message' =>  'Ktoś oczekuje twojej pomocy!',
                'user_message' =>   'Administracja została powiadomiona o twojej obecności',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 5],
            ]

        ]
];
