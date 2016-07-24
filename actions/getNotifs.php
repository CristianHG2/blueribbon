<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		$q = Sql::Query("SELECT * FROM notifications WHERE destination = ".$_SESSION['user_id']." ORDER BY seen DESC");

		if ( !$q )
		{
			echo json_encode(array("success" => false, "text" => "Could not get your notifications"));
			exit;
		}

		if ( Sql::numRows("SELECT * FROM notifications WHERE destination = ".$_SESSION['user_id']." ORDER BY seen DESC") < 1 )
		{
			echo json_encode(array("success" => false, "text" => "No notifications to show!"));
			exit;			
		}

		$data = array();
		$data['length'] = 0;
		$index = 0;

		foreach ( $q as $reg )
		{
			$data[$index]['id'] = $reg['id'];
			$data[$index]['url'] = $reg['url'];
			$data[$index]['text'] = $reg['text'];
			$data[$index]['seen'] = $reg['seen'];

			$index++;
			$data['length'] += 1;
		}

		$data['success'] = true;

		echo json_encode($data);
		exit;
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
		header(Kernel::GetHTTP(401));
		exit;
	}
}
else
{
	echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
	header(Kernel::GetHTTP(403));
	exit;
}