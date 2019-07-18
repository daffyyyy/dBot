<?php
/* Interval oraz instancje pomagał robić razorek dziękuje za pomoc :D */
define('App', "dBot");
define('Author', 'daffyy');
define('VERSION', 'BETA');
define('END', "\n");

date_default_timezone_set('Europe/Warsaw');
$include = ['includes/classess/ts3admin.class.php', 'includes/config/config.php', 'includes/classess/dBot.class.php'];
for ($i = 0; $i <= count($include) - 1; $i++)
	include_once $include[$i];

$dBot = new dBot();

$events = array();
$instance = getopt("i:");

if(!isset($instance['i']) || !isset($config['function'][$instance['i']])) die("Podana instancja nie istnieje!\n");
else $config['function'] = $config['function'][$instance['i']];

echo "[*] Startowanie aplikacji".App.' '.VERSION.END;
echo "[*] Autor: ".Author.END;

$dBot->run();

?>