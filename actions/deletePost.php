<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( isset($_POST['id']) )
		{
			if ( Text::validate($_POST['id'], 'num') )
			{
				$data = "SELECT author, id FROM posts WHERE id = ".$_POST['id']." AND author = ".$_SESSION['user_id'];

				$num = Sql::numRows($data);

				if ( $num > 0 )
				{
					$q = Sql::Query("DELETE FROM posts WHERE id = ".$_POST['id']." AND author = ".$_SESSION['user_id']);
					Sql::Query("DELETE FROM comments WHERE postid = ".$_POST['id']);
					Sql::Query("DELETE FROM notifications WHERE url = 'post.php?id=".$_POST['id']."'");

					if ( $q )
					{
						echo json_encode(array("success" => true, "text" => "Post successfully deleted"));
						exit;
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "Could not delete your post"));
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