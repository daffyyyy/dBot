<?php
Class dBot
{
    public function __construct()
    {
        global $config;
        $this->query = new ts3admin($config['connect']['ip'], $config['connect']['query_port']);
    }

    public function __destruct()
    {
        $this->query->logout();
    }


    private function connect()
    {
        global $config;

        foreach($config['function']['functions'] as $function)
        {
            $events[$function]['time'] = 0;
            $events[$function]['interval'] = $config['function'][$function]['interval']['hours'] * 3600 + $config['function'][$function]['interval']['minutes'] * 60 + $config['function'][$function]['interval']['seconds'];
            
            include_once "includes/functions/".$function.".php";
        }

        if ($this->query->getElement('success', $this->query->connect()))
        {
            echo "[⭐] Włączanie instancji".ENDLINE;
            if ($this->query->getElement('success', $this->query->login($config['connect']['login'], $config['connect']['password']))){
                echo "[⭐] Zalogowano na serwer".ENDLINE;
            }
            else{
                echo "[⭐] Nie udało się zalogować do serwera".ENDLINE;
                exit;
            }
            $this->query->selectServer($config['connect']['port']);
            $this->query->setName($config['function']['instance_name']);
            $core = $this->query->getElement('data', $this->query->whoAmI());
            $this->query->clientMove($core['client_id'],$config['connect']['channel']);

            $this->query->execOwnCommand(0, 'servernotifyregister event=server');
            //var_dump($this->query->execOwnCommand(0, 'servernotifyregister event=textprivate'));

            while (true)
            {
                $this->joined = $this->query->getElement('data', $this->query->execOwnCommand(2, 'servernotifyregister event=channel id='.$config['connect']['lobby']));
                $this->clients = $this->query->getElement('data', $this->query->clientList('-groups -voice -away -times -uid -country -info -ip'));
                $this->serverInfo = $this->query->getElement('data', $this->query->serverInfo());
                foreach($config['function']['functions'] as $function)
                {
                    if($this->checkInterval($events, $function))
                    {
                        $function();
                    }
                }
                sleep(1);
            }
            echo 1;
        }
        else{
            die("[⭐] Nie udało się połączyć sprawdz config").ENDLINE;
        }
    }

    public function run()
    {
        $this->connect();
        echo 1;
    }

    public function query()
    {
        return $this->query;
    }

    public function info()
    {
        return ['clients' => $this->clients, 'server' => $this->serverInfo];
    }

    public function joined()
    {
        return $this->joined;
    }

    public function hasGroup($client ,$group)
    {
        $groups = explode(',', $this->query->clientInfo($client)['data']['client_servergroups']);
        if (is_array($group))
        {
            for ($i = 0; $i <= count($group) - 1; $i++)
            {
                if (in_array($group[$i], $groups))
                    return true;
            }
        } elseif (in_array($group, $groups))
            return true;

        return false;
    }

    public function server_status($ip, $port)
    {
        $fp = @fsockopen($ip, $port, $errno, $errstr, 1);
        if ($fp)
            return true;

        return false;
    }

    public function group_name($group)
    {
        $group_name = $this->query->serverGroupList()['data'];
        for ($v = 0; $v <= count($group_name) - 1; $v++)
        {
            if ($group_name[$v]['sgid'] == $group)
            {
                return $group_name[$v]['name'];
            }
        }

        return false;
    }

    public function checkInterval(&$events, $event_name)
    {
        if(time() - $events[$event_name]['time'] >= $events[$event_name]['interval'])
        {
            $events[$event_name]['time'] = time();
            return true;
        }

        return false;
    }

}