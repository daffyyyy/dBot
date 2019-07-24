<?php

function time_spent()
{
    global $config, $dBot, $cache;

    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $clients = $dBot->info()['clients'];
        $cache->get(__FUNCTION__, $result);
        foreach ($result as $key => $value)
        {
            if (!$dBot->query()->clientGetIds($key)['success'])
                $result[$key]['connected_time'] = 0;
        }
        for ($i = 0; $i <= count($clients) - 1; $i++)
        {
            if ($clients[$i]['client_type'] == 1)
                continue;
            $info = $dBot->query()->clientInfo($clients[$i]['clid'])['data'];
            if (array_key_exists($clients[$i]['client_unique_identifier'], (array)$result))
            {
                if ($result[$clients[$i]['client_unique_identifier']]['total_connections'] < $info['client_totalconnections'])
                {
                    $result[$clients[$i]['client_unique_identifier']]['total_time'] = $result[$clients[$i]['client_unique_identifier']]['total_time'] + $info['connection_connected_time'] / 1000;
                    $result[$clients[$i]['client_unique_identifier']]['total_connections']++;
                    $result[$clients[$i]['client_unique_identifier']]['connected_time'] = $info['connection_connected_time'] / 1000;
                    $result[$clients[$i]['client_unique_identifier']]['client_nickname'] = $info['client_nickname'];
                } else {
                    $result[$clients[$i]['client_unique_identifier']]['total_time'] = $result[$clients[$i]['client_unique_identifier']]['total_time'] - $result[$clients[$i]['client_unique_identifier']]['connected_time'] + $info['connection_connected_time'] / 1000;
                    $result[$clients[$i]['client_unique_identifier']]['connected_time'] = $info['connection_connected_time'] / 1000;
                }
            }
            else
                $result[$clients[$i]['client_unique_identifier']] = ['total_time' => $info['connection_connected_time'] / 1000, 'total_connections' => $info['client_totalconnections'], 'connected_time' => $info['connection_connected_time'] / 1000, 'nick' => $info['client_nickname']];

            if ($cfg['time_ranks_status'] == true)
            {
                $times = array_keys($cfg['time_ranks']);
                $ranks = array_values($cfg['time_ranks']);
                $curr_rank = 0;
                foreach ($times as $key => $time)
                {
                    if ($time <= intval(($result[$clients[$i]['client_unique_identifier']]['total_time'] * 1000) / (1000 * 60)))
                    {
                        if ($curr_rank == 0)
                            $dBot->query()->serverGroupDeleteClient($ranks[$curr_rank], $info['client_database_id']);
                        else
                            $dBot->query()->serverGroupDeleteClient($ranks[$curr_rank - 1], $info['client_database_id']);
                        $curr_rank++;
                    }
                }
                if ($times[0] <= intval(($result[$clients[$i]['client_unique_identifier']]['total_time'] * 1000) / (1000 * 60)))
                {
                    $dBot->query()->serverGroupAddClient($ranks[$curr_rank - 1], $info['client_database_id']); 
                    $result[$clients[$i]['client_unique_identifier']]['level'] = $ranks[$curr_rank - 1];
                }
            }
        }
        $cache->set(__FUNCTION__, $result);
        $cache->saveCache();
    }
}