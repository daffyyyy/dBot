<?php

function myts_protect()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $joined = $dBot->joined();
        for ($i = 0; $i <= count($joined) - 1; $i++)
        {
            if (array_key_exists('notifycliententerview', $joined[$i]) && empty($joined[$i]['client_myteamspeak_id']))
            {
                $dBot->query()->clientKick($joined[$i]['clid'], 'server', 'Wymagane myTeamSpeakID -> http://prntscr.com/ojdqd6');
            }    
        }
    }
}