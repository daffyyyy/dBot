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
            $connected = true;
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
                $this->channels = $this->query->getElement('data', $this->query->channelList('-seconds_empty'));
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
        }
        else{
            die("[⭐] Nie udało się połączyć sprawdź config".ENDLINE);
        }
    }

    public function run()
    {
        $this->connect();
    }

    public function query()
    {
        return $this->query;
    }

    public function info()
    {
        return ['clients' => $this->clients, 'server' => $this->serverInfo, 'channels' => $this->channels];
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

    public function server_status($ip, $port, $query_port = null, $players = false)
    {
        $status = false;
        $fp = @fsockopen($ip, $port, $errno, $errstr, 1);
        if ($fp)
            $status = true;
        
        $fp = @fsockopen("udp://$ip", $port, $errno, $errstr, 1);
        if ($fp)
            $status = true;

        return $status;
    }

    public function replace_message($client = null, $group = null, $message)
    {
        global $cache;
        $info = $this->info();
        $uptime = $this->query->convertSecondsToArrayTime($info['server']['virtualserver_uptime']);
        $cache->get('record_online', $record);
        return str_replace(
        [
            '[online]',
            '[maxonline]',
            '[query]',
            '[group]',
            '[uptime]',
            '[record]',
            '[server_name]',
            '[client_connections]',
            '[packet_loss]',
            '[channels]',
            '[nick]',
            '[country]',
            '[date]'
        ],  
        [
            $info['server']['virtualserver_clientsonline'] - $info['server']['virtualserver_queryclientsonline'],
            $info['server']['virtualserver_maxclients'],
            $info['server']['virtualserver_queryclientsonline'],
            $this->group_name($group),
            $uptime['days'].' dni '.$uptime['hours'].' godzin '.$uptime['minutes'].' minut',
            $record,
            $info['server']['virtualserver_name'],
            $info['server']['virtualserver_client_connections'],
            $info['server']['virtualserver_total_packetloss_total'],
            $info['server']['virtualserver_channelsonline'],
            $client['client_nickname'],
            $client['client_country'],
            date('d.m.Y G:i:s', time()),
        ],$message);
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

    public function footer()
    {
        return '\n\n[hr]\n[right][img]https://static.daffyy.pro/projects/dBot/assets/img/logo.png[/img]';
    }

}
