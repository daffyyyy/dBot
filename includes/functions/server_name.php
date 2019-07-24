<?php

function server_name()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $name = $dBot->replace_message(null, null, $cfg['name']);
        $dBot->query()->serverEdit(['virtualserver_name' => $name]);
    }
}