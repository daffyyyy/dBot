<?php

function channel_poke()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];

    $poked = false;

    if ($cfg['status'] === true)
    {
        //var_dump($cfg);
        foreach ($cfg['channels'] as $channel => $value)
        {
            $onChannel = $dBot->query->channelClientList($channel)['data'];
            if (count($onChannel) > 0)
            {
                poke_admins($value, $cfg['admin_message']);
                $poked = true;
            }
        }
        if ($poked === true)
        {
            for ($i = 0; $i <= count($onChannel) - 1; $i++)
            {
                $dBot->query->sendMessage(1,$onChannel[$i]['clid'] , $cfg['user_message']);
                if (!in_array($onChannel[$i]['client_database_id'], $dBot->getCache('channel_poke')['value']['users'][1]))
                    $dBot->setCache('channel_poke', ['users' => [$onChannel[$i]['client_database_id']]], time()+60);
                else
                    echo 'już jest';

                var_dump();
            }
        }
    }
}

function poke_admins($group, $message)
{
    global $config, $dBot;

    $admins = $dBot->query->serverGroupClientList($group)['data'];
    for ($i = 0; $i <= count($admins) - 1; $i++)
    {
        $admin = $dBot->query->clientGetIds($dBot->query->clientGetNameFromDbid($admins[$i]['cldbid'])['data']['cluid'])['data'];        
        $dBot->query->clientPoke($admin[0]['clid'], $message);
    }
}