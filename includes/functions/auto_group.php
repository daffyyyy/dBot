<?php

function auto_group()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $joined = $dBot->joined();
        for ($i = 0; $i <= count($joined) - 1; $i++)
        {
            if (array_key_exists('notifycliententerview', $joined[$i]))
            {
                $client = $dBot->query()->clientInfo($joined[$i]['clid'])['data'];
                foreach ($cfg['groups'] as $group => $value)
                {
                    if ($dBot->hasGroup($joined[$i]['clid'], $group))
                        continue;

                    if (isset($value['uid']))
                    {
                        if ($joined[$i]['client_unique_identifier'] == $value['uid'])
                            $dBot->query()->serverGroupAddClient($group, $client['client_database_id']);
                    }
                    if (isset($value['ip']))
                    {
                        if ($client['connection_client_ip'] == $value['ip'])
                            $dBot->query()->serverGroupAddClient($group, $client['client_database_id']);
                    }
                }    
            }
        }
    }
}