<?php

require 'Init.php';

if ( isset($_SESSION['user_id']) )
{
	header(Kernel::getHTTP(401));
	header('Location: login.php');
	exit;
}

$page['id'] = 'signup';
$page['name'] = 'Sign up';