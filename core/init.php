<?php
session_start();
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '',
		'username' => '',
		'password' => '',
		'db' => ''
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);
spl_autoload_register(function($class)
{
	require_once 'classes/'.$class.'.php';
});
require_once 'functions/sanitize.php';
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{
	//echo "Remembered";
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
	if($hashCheck->count())
	{
		//echo "Hash matches, login ok";
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
?>