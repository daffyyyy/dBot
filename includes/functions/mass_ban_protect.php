<?php

function mass_ban_protect()
{
    global $config, $dBot, $cache;
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $banned = $dBot->joined();
        $cache->get(__FUNCTION__, $result);
        //var_dump($banned);
        for ($i = 0; $i <= count($banned) - 1; $i++)
        {
            if (array_key_exists('bantime', $banned[$i]))
            {
                if (array_key_exists($banned[$i]['invokeruid'], (array)$result))
                {
                    if ($result[$banned[$i]['invokeruid']]['time'] + ($cfg['time']*60) < time())
                        unset($result[$banned[$i]['invokeruid']]);
                    $result[$banned[$i]['invokeruid']]['bans']++;
                    $result[$banned[$i]['invokeruid']]['time'] = time();
                }
                else
                    $result[$banned[$i]['invokeruid']] = ['bans' => 1, 'last' => time()];

                if (array_key_exists($banned[$i]['invokeruid'], (array)$result) && $result[$banned[$i]['invokeruid']]['bans'] > $cfg['how_many'] && $result[$banned[$i]['invokeruid']]['time'] + ($cfg['time']*60) > time())
                {
                    $dbinfo = $dBot->query()->clientGetDbIdFromUid($banned[$i]['invokeruid'])['data'];
                    $groups = $dBot->query()->serverGroupsByClientID($dbinfo['cldbid'])['data'];
                    foreach ($groups as $group)
                        $dBot->query()->serverGroupDeleteClient($group['sgid'], $group['cldbid']);
                    $dBot->query()->banClient($dBot->query()->clientGetIds($banned[$i]['invokeruid'])['data'][0]['clid'], 1, 'Próba wykonania masowego bana: '. date('d.m.Y G:i:s', time()));
                    unset($result[$banned[$i]['invokeruid']]);
                }

                $cache->set(__FUNCTION__, $result, $cfg['time']*60);
                $cache->saveCache();
                print_r($result);
            }
        }
    }
}