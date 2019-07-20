<?php

$config['connect'] =
[
    'ip' => 'daffyy.pro',
    'port' => 9987,
    'login' => 'serveradmin',
    'password' => 'gsHsIRCL',
    'query_port' => 10011,
    'channel' => 64,

    'lobby' => 1,
];

$config['function'] = 
[
        1 => 
        [
            'instance_name' => '⭐ dBot @ Olcia',
            'functions' => ['random_server_name', 'server_status', 'group_online', 'online_server_name', 'welcome_message'],

            'random_server_name' => 
            [
                'status' => true,
                'names' => ['✯ daffyy.pro ✯ - Prywatny timspik czy', "✯ daffyy.pro ✯ - Programista / Web Developer / Freelancer", 
                '✯ daffyy.pro ✯ - Gramy i kodzimy!'],

                'interval' => ['hours' => 0, 'minutes' => 2, 'seconds' => 0],
            ],

            'online_server_name' => 
            [
                'status' => false,
                'name' => 'Nazwa serwera - [online]/[max]',

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],
            ],

            'welcome_message' => 
            [
                'status' => true,
                'message' => 'Witaj [b][nick][/b] na [b][server_name][/b],
                Twoje grupy: [b][groups][/b], na serwerze jest [b][online][/b] osoób a my jesteśmy online od [b][uptime][/b]',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 1],
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
                    //69 => ['group' => 10, 'online' => 'Pasożyt ✔', 'offline' => 'Pasożyt niet'], // Tylko nazwa kanału
                    69 => 10, // Nazwa i opis
                ],
                'channel_name' => 'Czy pasożyt online? [count]',
                'description' => ['head' => '[center][b]Lista online[/b][/center]\n\n', 'status' => ['online' => '[nick] - ONLINE', 'offline' => '[nick] - OFFLINE']],

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],
            ],

        ],
        2 =>
        [
            'instance_name' => '⭐ dBot @ Mandaryna',
            'functions' => ['channel_poke', 'channel_group', 'channel_create', 'censorship', 'anty_vpn'],

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

            'channel_create' =>
            [
                'status' => true,
                'channels' =>
                [
                    69 => 151,
                ],
                'group' => 5,
                'count' => 2,

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 3],
            ],

            'censorship' =>
            [
                'status' => true,
                'words' =>
                [
                    'kutas', 'jeba', 'huj', 'cipa', 'dziwka', 'pizda', 'kurwa', 'spierdal',
                ],
                'reason' => 'Twój nick zawiera niecenzuralny wyraz!',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 20],
            ],

            'anty_vpn' =>
            [
                'status' => false,
                'email' => 'xdaffe01@gmail.com',
                'type' => 1,
                'reason' => 'Wyłącz program do maskowania IP!',
                'allowed' => 10,

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 30],
            ],

        ]
];
