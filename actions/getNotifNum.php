<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		echo json_encode(
			array("success" => true, 
				"text" => Sql::numRows("SELECT seen, destination FROM notifications WHERE seen = '0' AND destination = '".$_SESSION['user_id']."'"))
			);
		exit;
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
		exit;
	}
}
else
{
	echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
	exit;
}