<?php

function online_server_name()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $info = $dBot->info()['server'];
        $dBot->query()->serverEdit(['virtualserver_name' => str_replace(['[online]', '[max]'], [$info['virtualserver_clientsonline'] - $info['virtualserver_queryclientsonline'], $info['virtualserver_maxclients']], $cfg['name'])]);
    }
}