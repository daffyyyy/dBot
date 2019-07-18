<?php

function random_sname()
{
    global $config, $dBot;
    
    $cfg = $config['function'][__FUNCTION__];
    if ($cfg['status'] == true)
    {
        $rand_name = $cfg['names'][rand(0, count($cfg['names']) - 1)];
        $dBot->query->serverEdit([ 'virtualserver_name' => $rand_name]);
    }
}