<?php

function channel_create()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        foreach ($cfg['channels'] as $channel => $value)
        {
            $channels_time = $dBot->info()['channels'];
            for ($a = 0; $a <= count($channels_time) - 1; $a++)
            {
                $empty_time = $dBot->query()->convertSecondsToArrayTime($channels_time[$a]['seconds_empty']);
                if ($empty_time['days'] > $cfg['empty_days'] && $channels_time[$a]['pid'] == $value)
                    $dBot->query()->channelDelete($channels_time[$a]['cid']);

            }
            $onChannel = $dBot->query()->channelClientList($channel)['data'];
            if (count($onChannel) > 0)
            {
                    for ($i = 0; $i <= count($onChannel) - 1; $i++)
                    {
                        $number = 1;
                        $channels = $dBot->info()['channels'];
                        for ($x = 0; $x <= count($channels) - 1; $x++)
                        {
                            if ($channels[$x]['pid'] == $value)
                            {
                                if (stripos(substr($channels[$x]['channel_name'], 0, strlen($number)+1), "$number.") === false)
                                {
                                    $dBot->query()->channelEdit($channels[$x]['cid'], ['channel_name' => $number.'. '.preg_replace('/^\d+$/', $number, $channels[$x]['channel_name'])]);
                                }
                                if ($channels[$x]['channel_name'] == "$number. {$onChannel[$i]['client_nickname']}")
                                    $dBot->query()->channelEdit($channels[$x]['cid'], ['channel_name' => $channels[$x]['channel_name'].rand(100, 999)]);
                                    
                                $number++;
                            }
                        }
                        if ($dBot->query()->channelGroupClientList(null, $onChannel[$i]['client_database_id'], $cfg['group'])['data'][0]['cid'] == true)
                        {
                            $dBot->query()->clientMove($onChannel[$i]['clid'], $dBot->query()->channelGroupClientList(null, $onChannel[$i]['client_database_id'], $cfg['group'])['data'][0]['cid']);
                            $dBot->query()->sendMessage(1, $onChannel[$i]['clid'], 'Posiadasz już kanał prywatny, zostałeś na niego przeniesiony');
                            continue;
                        }
                        
                        $pass = rand(1000, 9999);
                        $main = $dBot->query()->channelCreate(['channel_name' => $number+$i.'. Kanał '.$onChannel[$i]['client_nickname'], 'CHANNEL_FLAG_PERMANENT' => 1, 'CHANNEL_PASSWORD' => $pass, 'CPID' => $value])['data'];
                        for ($v = 1; $v <= $cfg['subchannels']; $v++)
                        {
                            $dBot->query()->channelCreate(['channel_name' => 'Podkanał '.$v, 'CHANNEL_FLAG_PERMANENT' => 1, 'CPID' => $main['cid']]);
                        }
                        $dBot->query()->clientMove($onChannel[$i]['clid'], $main['cid']);
                        $dBot->query()->channelGroupAddClient($cfg['group'], $main['cid'], $onChannel[$i]['client_database_id']);
                        $dBot->query()->sendMessage(1, $onChannel[$i]['clid'], 'Twój kanał został utworzony! Hasło: [b]'.$pass);
                        sleep(0.2);
                    }
            }
        }
    }
}