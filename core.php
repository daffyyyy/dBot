<?php
date_default_timezone_set('Europe/Warsaw');
define('APP_NAME', "dBot");
define('AUTHOR', 'daffyy');
define('VERSION', 'BETA');
define('ENDLINE', "\n");

$include = ['includes/classess/ts3admin.class.php', 'includes/config/config.php', 'includes/classess/dBot.class.php', 'includes/classess/cache.class.php'];
for ($i = 0; $i <= count($include) - 1; $i++)
	include_once $include[$i];

$dBot = new dBot();
$cache = new cache();

$events = array();
$instance = getopt("i:");

if(!isset($instance['i']) || !isset($config['function'][$instance['i']])) 
	die("Podana instancja nie istnieje!".ENDLINE);
else 
	$config['function'] = $config['function'][$instance['i']];

echo "[⭐] Startowanie aplikacji ".APP_NAME.' '.VERSION.ENDLINE;
echo "[⭐] Autor: ".AUTHOR.ENDLINE;

$dBot->run();
?>