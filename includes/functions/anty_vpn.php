<?php

function anty_vpn()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $clients = $dBot->info()['clients'];
        for ($i = 0; $i <= count($clients) - 1; $i++)
        {
            if ($clients[$i]['client_type'] == 1)
                continue;
            $check = file_get_contents("https://check.getipintel.net/check.php?ip={$clients[$i]['connection_client_ip']}&flags=m&contact={$cfg['email']}");
            var_dump($check);
            if ($check > 0.995)
            {
                switch ($cfg['type'])
                {
                    case 1:
                        $dBot->query()->banClient($clients[$i]['clid'], 5*60, $cfg['reason']);
                        break;
                    case 2:
                        $dBot->query()->clientKick($clients[$i]['clid'], 'server', $cfg['reason']);
                        break;
                }
            }
            sleep(0.01);
        }
    }
}