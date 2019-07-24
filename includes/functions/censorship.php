<?php

function censorship()
{
    global $root_config, $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $channels = $dBot->info()['channels'];
        $clients = $dBot->info()['clients'];

        $pids = array_values($root_config['function'][2]['channel_create']['channels']);

        for ($i = 0; $i <= count($clients) - 1; $i++)
        {
            for ($v = 0; $v <= count($cfg['words']) - 1; $v++)
            {
                if (stripos($clients[$i]['client_nickname'], $cfg['words'][$v]))
                {
                    $dBot->query()->clientKick($clients[$i]['clid'], 'server', $cfg['reason']);
                }
            }
        }

        for ($x = 0; $x <= count($channels) - 1; $x++)
        {
            for ($a = 0; $a <= count($cfg['words']) - 1; $a++)
            {
                if (stripos($channels[$x]['channel_name'], $cfg['words'][$a]) && in_array($channels[$x]['pid'], $pids) || preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $channels[$x]['channel_name']) && in_array($channels[$x]['pid'], $pids))
                {
                    $dBot->query()->channelEdit($channels[$x]['cid'], ['channel_name' => $channels[$x]['cid'].'. Zła nazwa kanału!']);
                }
            }
        }
    }
}