<?php

function welcome_message()
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
                $dBot->query()->sendMessage(1,$joined[$i]['clid'], edit_message($joined[$i], $cfg['message']));
            }    
        }
    }
}

function edit_message($client, $message)
{
    global $dBot;
    $groups_name = "";
    for ($i = 0; $i <= count($groups = explode(',', $client['client_servergroups'])) -1; $i++)
    {
        $groups_name .= $dBot->group_name($groups[$i]).', ';
    }
    return str_replace(
        [
            '[nick]',
            '[country]',
            '[groups]',
        ],
        [
            $client['client_nickname'],
            $client['client_country'],
            $groups_name,
        ],
        $message
    );
}