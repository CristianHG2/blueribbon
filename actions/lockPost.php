<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('id') )
		{
			if ( Text::validate($_POST['id'], 'num') )
			{
				$data = "SELECT author, id, locked FROM posts WHERE id = ".$_POST['id']." AND author = ".$_SESSION['user_id'];

				$num = Sql::numRows($data);

				if ( $num > 0 )
				{
					$d2 = Sql::Query($data, true);

					if ( $d2['locked'] == 0 )
					{
						$q = Sql::Update('posts', array("locked" => 1), 'WHERE id = '.$_POST['id']." AND author = ".$_SESSION['user_id']);
						$t = 0;
					}
					elseif ( $d2['locked'] == 1 )
					{
						$q = Sql::Update('posts', array("locked" => 0), 'WHERE id = '.$_POST['id']." AND author = ".$_SESSION['user_id']);
						$t = 1;
					}

					if ( $q )
					{
						echo json_encode(array("success" => true, "text" => $t));
						exit;
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "Could not lock/unlock this post"));
						exit;						
					}
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "No posts with the criteria you provided could be found"));
					exit;
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "The ID is not numeric"));
				exit;				
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "The ID must not be empty"));
			exit;
		}
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "You are not logged in"));
		header(Kernel::GetHTTP(403));
		exit;
	}
}
else
{
	echo json_encode(array("success" => false, "text" => "The post ID must be a numeric value"));
	header(Kernel::GetHTTP(401));
	exit;
}