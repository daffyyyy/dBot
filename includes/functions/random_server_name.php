<?php

function random_server_name()
{
    global $config, $dBot;
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $rand_name = $cfg['names'][rand(0, count($cfg['names']) - 1)];
        $name = $dBot->replace_message(null, null, $rand_name);
        $dBot->query()->serverEdit(['virtualserver_name' => $name]);
    }
}