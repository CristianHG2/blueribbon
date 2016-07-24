<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		$user = new User($_SESSION['user_id']);

		if ( $user->logOut() )
		{
			echo json_encode(array("success" => true, "text" => "Successfully logged out"));
			exit;
		}
		else
		{
			echo json_encode(array("success" => true, "text" => "Could not log you out"));
			exit;
		}
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "You're not logged in"));
		header(Kernel::getHTTP(401));
		exit;
	}
}
else
{
	echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
	header(Kernel::getHTTP(403));
	exit;
}