<?php
Class dBot
{
    public function __construct()
    {
        global $config;
        $this->query = new ts3admin($config['connect']['ip'], $config['connect']['port']);
        $this->cache = [];
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
            echo "[*] Włączanie instancji".END;
            if ($this->query->getElement('success', $this->query->login($config['connect']['login'], $config['connect']['password']))){
                echo "[*] Zalogowano na serwer".END;
            }
            else{
                echo "[*] Nie udało się zalogować do serwera".END;
                exit;
            }
            $this->query->selectServer(9987);
            $this->query->setName($config['function']['instance_name']);
            $core = $this->query->getElement('data', $this->query->whoAmI());
            //$this->query->clientMove($core['client_id'],$config['function']['move_channel']);
            while (true)
            {
                $this->clients = $this->query->getElement('data', $this->query->clientList('-groups -voice -away -times -uid -country -info'));
                $this->serverInfo = $this->query->getElement('data', $this->query->serverInfo());
                $this->query->execOwnCommand(0, 'servernotifyregister event=server');
                $this->query->execOwnCommand(0, 'servernotifyregister event=textprivate');
                
                foreach($config['function']['functions'] as $function)
                {
                    if($this->checkInterval($events, $function))
                    {
                        $function();
                    }
                }
            
                sleep(1);
            }
        }
        else{
            die("[*] Nie udało się połączyć sprawdz config").END;
        }
    }

    public function run()
    {
        $this->connect();
    }

    public function query()
    {
        return $this->query();
    }

    public function info()
    {
        return ['clients' => $this->clients, 'server' => $this->serverInfo];
    }

    public function getCache($key)
    {
        $cache = $this->cache[$key];
        if ($cache)
            return $cache;
        return false;
    }

    public function setCache($key, $value, $time)
    {
        $array = [$key => ['value' => $value, 'time' => $time]];
        $this->cache = array_merge($this->cache, $array);
    }

    public function checkInterval(&$events, $event_name)
    {
        if(time() - $events[$event_name]['time'] >= $events[$event_name]['interval'])
        {
            $events[$event_name]['time'] = time();
            return true;
        }
        else
            return false;
    }

}