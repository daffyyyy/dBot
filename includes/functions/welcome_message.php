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
                $dBot->query()->sendMessage(1,$joined[$i]['clid'], welcome_edit_message($joined[$i], $cfg['message']));
            }    
        }
    }
}

function welcome_edit_message($client, $message)
{
    global $dBot;
    $message = $dBot->replace_message($client, null, $message);
    $groups_name = "";
    $groups = $groups = explode(',', $client['client_servergroups']);
    for ($i = 0; $i <= count($groups) -1; $i++)
    {
        if (end($groups) == $groups[$i])
            $groups_name .= $dBot->group_name($groups[$i]);
        else
            $groups_name .= $dBot->group_name($groups[$i]).', ';
    }
    return str_replace(
        [
            '[groups]',
        ],
        [
            $groups_name,
        ],
        $message
    );
}