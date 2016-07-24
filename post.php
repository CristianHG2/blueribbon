<?php

require 'Init.php';

if ( !isset($_SESSION['user_id']) )
{
	header(Kernel::getHTTP(403));
	header('Location: login.php');
	exit;
}

if ( !isset($_GET['id']) || !ctype_digit($_GET['id']) )
{
	header('Location: login.php');
	exit;
}
else
{
	if ( Sql::numRows("SELECT * FROM posts WHERE id = ".$_GET['id']." LIMIT 1") < 1 )
	{
		header(Kernel::getHTTP(404));

		$_GET['http_error'] = 404;

		$page['id'] = 'error';
		$page['name'] = 'Not found';
	}
	else
	{
		$data = Sql::Query("SELECT * FROM posts WHERE id = ".$_GET['id']." LIMIT 1", true);

		$page['id'] = 'post';
		$page['name'] = Kernel::getWords($data['content']).'...';
	}
}