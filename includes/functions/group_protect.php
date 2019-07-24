<?php

function group_protect()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        foreach ($cfg['groups'] as $group => $value)
        {
            $admins = $dBot->query()->serverGroupClientList($group)['data'];
            if (!isset($admins[0]) || !isset($admins[0]['cldbid']))
                continue;
            for ($i = 0; $i <= count($admins) - 1; $i++)
            {
                $uid = $dBot->query()->clientGetNameFromDbid($admins[$i]['cldbid'])['data'];
                
                if (!in_array($uid['cluid'], $value['uid']) && isset($uid['cluid']))
                    $dBot->query()->serverGroupDeleteClient($group, $uid['cldbid']);
            }
        }
    }
}