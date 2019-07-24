<?php

function ip_limit()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $ips = [];
        $clients = $dBot->info()['clients'];
        for ($i = 0; $i <= count($clients) - 1; $i++)
        {
            if ($clients[$i]['client_type'] == 1 || in_array($clients[$i]['connection_client_ip'], $cfg['allowed']))
                continue;

            if (in_array($clients[$i]['connection_client_ip'], $ips))
                $ips[$clients[$i]['connection_client_ip']]++;

            $ips[$clients[$i]['connection_client_ip']] = 1;      

            foreach ($ips as $ip)
            {
                if ($ip > $cfg['how_many'])
                {
                    echo 'die';
                    switch ($cfg['type'])
                    {
                        case 1:
                            $dBot->query()->clientKick($clients[$i]['clid'], 'server', $cfg['reason']);
                        break;
                        case 2:
                            $dBot->query()->banClient($clients[$i]['clid'], $cfg['time']*60, $cfg['reason']);
                        break;
                    }
                    sleep(0.01);
                }
            }    
        }
    }
}