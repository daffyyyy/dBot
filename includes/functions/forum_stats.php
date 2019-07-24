<?php

function forum_stats()
{
    global $config, $dBot;

    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $html = @file_get_html($cfg['site']);
        $stats = $cfg['stats'];
        if (!$html)
            $ret = [0 => 'Brak danych', 1 => 'Brak danych', 2 => 'Brak danych'];

        for ($i = 0; $i <= count($stats) - 1; $i++)
        {
            if ($html)
                $ret[] = $html->find($stats[$i], 0)->plaintext;
        }
        $dBot->query()->channelEdit($cfg['channels'][0], ['channel_name' => 'Tematów: '.$ret[0]]);
        $dBot->query()->channelEdit($cfg['channels'][1], ['channel_name' => 'Postów: '.$ret[1]]);
        $dBot->query()->channelEdit($cfg['channels'][2], ['channel_name' => 'Użytkowników: '.$ret[2]]);
    }
}