<?php

function group_online()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        foreach ($cfg['channels'] as $channel => $value)
        {
            if (!is_array($value))
                $desc = $cfg['description']['head'];
            //$clients_group = $dBot->query()->serverGroupClientList($value)['data'];
            if (!is_array($value))
                $clients_group = $dBot->query()->serverGroupClientList($value, true)['data'];
            else
                $clients_group = $dBot->query()->serverGroupClientList($value['group'], true)['data'];

            $online = 0;
            for ($i = 0; $i <= count($clients_group) - 1; $i++)
            {
                $clients_array[] = $clients_group[$i];
            }

            for ($v = 0; $v <= count($clients_array) - 1; $v++)
            {
                if ($find = $dBot->query()->clientFind($clients_array[$v]['client_nickname'])['data'][0])
                {
                    $online++;
                    if (!is_array($value))
                        $desc .= '[URL=client://'.$find['clid'].'/'.$clients_array[$v]['client_unique_identifier'].']'.str_replace(['[nick]'], $clients_array[$v]['client_nickname'], 
                        $cfg['description']['status']['online']).'[/URL]'.ENDLINE;
                }
                else
                {
                    if (!is_array($value))
                        $desc .= '[URL=client://'.$find['clid'].'/'.$clients_array[$v]['client_unique_identifier'].']'.str_replace(['[nick]'], $clients_array[$v]['client_nickname'], 
                        $cfg['description']['status']['offline']).'[/URL]'.ENDLINE;
                }
            }
            if (!is_array($value))
                $dBot->query()->channelEdit($channel, ['channel_name' => str_replace('[count]', $online, $cfg['channel_name']), 'channel_description' => $desc]);
            else
                $dBot->query()->channelEdit($channel, ['channel_name' => $value[$online ? 'online' : 'offline']]);
        }
    }
}