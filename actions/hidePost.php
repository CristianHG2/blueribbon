<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('postid') )
		{
			if ( strlen($_POST['postid']) > 0 )
			{
				$u = new User($_SESSION['user_id']);

				if ( Sql::numRows("SELECT id FROM posts WHERE id = ".$_POST['postid']) > 0)
				{
					$arr = json_decode($u->hiddenPosts, true);

					$arr[] = $_POST['postid'];

					$q = Sql::Query("UPDATE accounts SET hiddenPosts = '".json_encode($arr)."' WHERE id = ".$_SESSION['user_id']);
				}
				else
				{
					echo json_encode(array("success" => true, "text" => "The post you're trying to hide does not exist"));
					exit;					
				}

				if ( $q )
				{
					echo json_encode(array("success" => true, "text" => "Post successfully posted"));
					exit;
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "Error, could not hide this post, please contact support"));
					exit;				
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "The post ID must be longer than 0 characters"));
				exit;
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "Please fill out all fields correctly"));
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