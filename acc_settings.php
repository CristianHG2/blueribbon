<?php

require 'Init.php';

if ( !isset($_SESSION['user_id']) )
{
	header(Kernel::getHTTP(403));
	header('Location: login.php');
	exit;
}

$page['id'] = 'acc_settings';
$page['name'] = 'Account settings';