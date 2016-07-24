<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('notifid') )
		{
			if ( strlen($_POST['notifid']) > 0 )
			{
				$q = Sql::Query("UPDATE notifications SET seen = '1' WHERE id = ".$_POST['notifid']);

				if ( !$q )
				{
					echo json_encode(array("success" => false, "text" => "Could not modify the notification"));
					exit;
				}

				echo json_encode(array("success" => true, "text" => "OK"));
				exit;
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "The notification ID must be longer than 0 characters"));
				exit;
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "The notification ID must be set"));
			exit;			
		}
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