<?php

function server_status()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        foreach ($cfg['channels'] as $channel => $value)
        {
            $status = $dBot->server_status($value['ip'], $value['port']) ? 'ONLINE' : 'OFFLINE';
            $dBot->query()->channelEdit($channel, ['channel_name' => str_replace('[status]', $status, $value['name'])]);
        }
    }
}