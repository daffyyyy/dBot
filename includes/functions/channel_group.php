<?php

function channel_group()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];

    if ($cfg['status'] === true)
    {
        foreach ($cfg['channels'] as $channel => $value)
        {
            $onChannel = $dBot->query()->channelClientList($channel)['data'];
            if (count($onChannel) > 0)
            {
                {
                    for ($i = 0; $i <= count($onChannel) - 1; $i++)
                    {
                        $group_name = $dBot->query()->serverGroupList()['data'];
                        for ($v = 0; $v <= count($group_name) - 1; $v++)
                        {
                            if ($group_name[$v]['sgid'] == $value)
                            {
                                $group_name = $group_name[$v]['name'];
                                break;
                            }
                        }
                        if ($dBot->hasGroup($onChannel[$i]['clid'], $value))
                        {
                            $dBot->query()->serverGroupDeleteClient($value, $onChannel[$i]['client_database_id']);
                            $dBot->query()->clientMove($onChannel[$i]['clid'], $config['connect']['connect_channel']);
                            continue;
                        }
                        $dBot->query()->serverGroupAddClient($value, $onChannel[$i]['client_database_id']);
                        $dBot->query()->clientMove($onChannel[$i]['clid'], $config['connect']['connect_channel']);
                        $dBot->query()->sendMessage(1, $onChannel[$i]['clid'], str_replace('[group]', $group_name, $cfg['user_message']));
                    }
                }
            }
        }
    }
}