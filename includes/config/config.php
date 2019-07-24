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
            'functions' => ['multi_functions', 'server_status', 'forum_stats', 'group_online', 'welcome_message', 'time_spent'],

            'multi_functions' =>
            [
                'status' => true,
                'server_name' => 
                [
                    'status' => false,
                    'name' => 'Nazwa serwera - [online]/[maxonline]',  // '[online]','[maxonline]','[query]','[uptime]','[server_name]','[packet_loss]','[channels]','[date]'
                ],
                'random_server_name' => 
                [
                    'status' => true,
                    'names' => ['✯ daffyy.pro ✯ - Prywatny timspik czy', "✯ daffyy.pro ✯ - Programista / Web Developer / Freelancer", 
                    '✯ daffyy.pro ✯ - Gramy i kodzimy!'],   // '[online]','[maxonline]','[query]','[uptime]','[server_name]','[packet_loss]','[channels]','[date]'
                ],  
                'clock' => 
                [
                    'status' => true,
                    'name' => '[cspacer] Aktualna godzina: [clock]',
                    'channel' => 788, 
                ],
                'date' => 
                [
                    'status' => true,
                    'name' => '[cspacer] Aktualna data: [date]',
                    'channel' => 789, 
                ],
                'name_day' => 
                [
                    'status' => false,
                    'channel' => 153, 
                ],
                'record_online' =>
                [
                    'status' => true,
                    'name' => '[cspacer] Rekord: [record]',
                    'channel' => 790,
                ],

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],  
            ],

            'welcome_message' => 
            [
                'status' => true,
                'message' => 'Witaj [b][nick][/b] na [b][server_name][/b],\n
                Twoje grupy: [b][groups][/b], na serwerze jest [b][online][/b] osób a my jesteśmy online od [b][uptime][/b]',  // '[online]','[maxonline]','[query]','[uptime]','[server_name]','[packet_loss]','[channels]','[nick]','[date]','[nick]','[country]','[client_connections]','[groups]'

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
                    41 => ['group' => 10, 'online' => 'Support & Reklamacje ✔', 'offline' => 'Support & Reklamacje ❌', 'away' => 'Support & Reklamacje ⏳'], // Tylko nazwa kanału
                    //69 => 10, // Nazwa i opis
                ],
                'channel_name' => 'Czy pasożyt online? [count]',
                'description' => ['head' => '[center][b]Lista online[/b][/center]\n\n', 'status' => ['online' => '[nick] - ONLINE', 'offline' => '[nick] - OFFLINE', 'away' => '[nick] - AWAY']],

                'interval' => ['hours' => 0, 'minutes' => 1, 'seconds' => 0],
            ],

            'forum_stats' =>
            [
                'status' => true,
                'site' => 'https://onecie.pl/',
                'stats' => ['span[id=all_topics]', 'span[id=all_posts]', 'span[id=all_users]'],
                'channels' =>
                [
                    792,
                    793,
                    794
                ],

                'interval' => ['hours' => 0, 'minutes' => 5, 'seconds' => 0],
            ],

            'time_spent' =>
            [
                'status' => true,

                'time_ranks_status' => true,
                'time_ranks' => 
                [
                    50 => 12,
                    70 => 13,
                    100 => 14,
                    110 => 15,
                ],

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 10],
            ]

        ],
        2 =>
        [
            'instance_name' => '⭐ dBot @ Mandaryna',
            'functions' => ['channel_poke', 'channel_create', 'channel_group', 'auto_group'],

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

            'channel_create' =>
            [
                'status' => false,
                'channels' =>
                [
                    69 => 785,
                ],
                'group' => 5,
                'subchannels' => 2,
                'empty_days' => 30,

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

            'auto_group' =>
            [
                'status' => true,
                'groups' =>
                [
                    10 => ['uid' => 'dfuTNJShoKvYr36X6Rjj59IGA50='],
                    //3213 => ['ip' => '127.0.0.1'],
                ],

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 1],
            ],

        ],
        3 =>
        [
            'instance_name' => '⭐ dBot @ Majeczka',
            'functions' => ['censorship', 'group_protect', 'anty_vpn', 'ip_limit', 'mass_ban_protect', 'myts_protect'],
            'censorship' =>
            [
                'status' => true,
                'words' =>
                [
                    'kutas', 'jeba', 'huj', 'cipa', 'dziwka', 'pizda', 'kurwa', 'spierdal', '.pl', '.com', '.eu', 'speak.', 'voice.', 'ts3.', '.ts3',
                ],
                'reason' => 'Twój nick zawiera niedozwolony wyraz!',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 20],
            ],

            'group_protect' =>
            [
                'status' => true,
                'groups' =>
                [
                    10 => ['uid' => ['dfuTNJShoKvYr36X6Rjj59IGA50=', 'XlHzI/6mG10N91470xteBuudBdY=']]
                ],
                //'reason' => 'Twój nick zawiera niecenzuralny wyraz!',

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 2],
            ],

            'anty_vpn' =>
            [
                'status' => false,
                'email' => 'xdaffe01@gmail.com',
                'type' => 1,
                'reason' => 'Wyłącz program do maskowania IP!',
                'time' => 5,
                'allowed' => 10,

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 30],
            ],

            'ip_limit' =>
            [
                'status' => true,
                'email' => 'xdaffe01@gmail.com',
                'type' => 2,
                'reason' => 'Maksymalnie [count] połączeń!',
                'time' => 1,
                'allowed' => ['127.0.0.1', ''],
                'how_many' => 3,

                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 5],
            ],

            'mass_ban_protect' =>
            [
                'status' => true,
                'how_many' => 10,
                'time' => 5,
                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 1],
            ],

            'myts_protect' =>
            [
                'status' => true,
                'interval' => ['hours' => 0, 'minutes' => 0, 'seconds' => 1],
            ]

        ]
];
