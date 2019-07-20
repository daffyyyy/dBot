<?php

function censorship()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $clients = $dBot->info()['clients'];
        for ($i = 0; $i <= count($clients) - 1; $i++)
        {
            for ($v = 0; $v <= count($cfg['words']) - 1; $v++)
            {
                if (stripos($clients[$i]['client_nickname'], $cfg['words'][$v]))
                {
                    $dBot->query()->clientKick($clients[$i]['clid'], 'server', $cfg['reason']);
                }
                $channel = $dBot->query()->channelFind($cfg['words'][$v])['data'];
                foreach ((array)$channel as $delete)
                {
                    //$dBot->query()->channelDelete($delete['cid'], 1);
                    $dBot->query()->channelEdit($delete['cid'] ,['channel_name' => $delete['cid'].'. Zła nazwa kanału!']);
                }
            }
        }
    }
}