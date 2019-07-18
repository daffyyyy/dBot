<?php

$config['connect'] =
[
    'ip' => 'daffyy.pro',
    'port' => 9987,
    'login' => 'serveradmin',
    'password' => 'gsHsIRCL',
    'query_port' => 10011,

    'connect_channel' => 1,
];

$config['function'] = 
[
        1 => 
        [
            'instance_name' => '⭐ dBot @ Olcia',
            'functions' => ['random_sname', 'channel_poke', 'channel_group', 'server_status', 'group_online'],

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
                    41 => 10,
                ],
                'admin_message' =>  'Ktoś oczekuje twojej pomocy!',
                'user_message' =>   'Administracja została powiadomiona o twojej obecności',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 3],
            ],

            'channel_group' =>
            [
                'status' => true,
                'channels' =>
                [
                    62 => 11,
                ],
                'user_message' =>   'Grupa [b][group][/b] została nadana',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 3],
            ],

            'server_status' =>
            [
                'status' => true,
                'channels' =>
                [
                    63 => ['name' => '[VPS #1] - [status]', 'ip' => 'daffyy.pro', 'port' => 80],
                    66 => ['name' => '[VPS #2] - [status]', 'ip' => 'free.ts3support.com', 'port' => 22],
                    67 => ['name' => '[VPS BOTY] - [status]', 'ip' => '188.68.236.100', 'port' => 22],
                    65 => ['name' => '[DEDI #1] - [status]', 'ip' => 'd1.daffyy.pro', 'port' => 8000],
                    68 => ['name' => '[MUZOBOT - LICENCJA] - [status]', 'ip' => 'license.muzobot.pl', 'port' => 80],
                ],

                'interval' => ['hours' => 0, 'minutes' => 2, 'seconds' => 0],
            ],

            'group_online' =>
            [
                'status' => true,
                'channels' =>
                [
                    69 => ['group' => 10, 'online' => 'Pasożyt ✔', 'offline' => 'Pasożyt niet'], // Tylko nazwa kanału
                    70 => 10, // Nazwa i opis
                ],
                'channel_name' => 'Czy pasożyt online? [count]',
                'description' => ['head' => '[center][b]Lista online[/b][/center]\n\n', 'status' => ['online' => '[nick] - ONLINE', 'offline' => '[nick] - OFFLINE']],

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],
            ]

        ]
];
