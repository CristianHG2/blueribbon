<?php

require 'Init.php';

$page['id'] = 'user';
$page['name'] = 'User';

if ( !isset($_SESSION['user_id']) )
{
	header(Kernel::getHTTP(403));
	header('Location: login.php');
	exit;
}

if ( !isset($_GET['id']) )
	header('Location: login.php');

if ( !Text::validate($_GET['id'], 'num') )
	header('Location: login.php');

if ( !Users::userExists($_SESSION['user_id']) )
	header('Location: login.php');