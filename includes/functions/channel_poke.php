<?php

function channel_poke()
{
    global $config, $dBot, $cache;
    $cfg = $config['function'][__FUNCTION__];

    if ($cfg['status'] === true)
    {
        $cache->get(__FUNCTION__, $result);

        foreach ($cfg['channels'] as $channel => $value)
        {
            $onChannel = $dBot->query()->channelClientList($channel)['data'];
            if (count($onChannel) > 0)
            {
                {
                    for ($i = 0; $i <= count($onChannel) - 1; $i++)
                    {
                        if (array_key_exists($onChannel[$i]['client_database_id'], (array)$result))
                            continue;
                        if ($dBot->hasGroup($onChannel[$i]['clid'], $value))
                            return;
                            
                            poke_admins($value, $cfg['admin_message']);
                            $dBot->query()->sendMessage(1,$onChannel[$i]['clid'] , $cfg['user_message']);
                            $result[$onChannel[$i]['client_database_id']] = $onChannel[$i];

                            $cache->set(__FUNCTION__, $result, 60);
                            $cache->saveCache();
                    }
                }
            }
        }
    }
}

function poke_admins($group, $message)
{
    global $dBot;

    $admins = $dBot->query()->serverGroupClientList($group)['data'];
    for ($i = 0; $i <= count($admins) - 1; $i++)
    {
        $admin = $dBot->query()->clientGetIds($dBot->query()->clientGetNameFromDbid($admins[$i]['cldbid'])['data']['cluid'])['data'];        
        $dBot->query()->clientPoke($admin[0]['clid'], $message);
        $dBot->query()->sendMessage(1, $admin[0]['clid'], $message);
    }
}