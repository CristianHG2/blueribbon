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
					$comm = Sql::Query("SELECT author, postid FROM comments WHERE postid = ".$_POST['postid']);
					$postQ = Sql::Query("SELECT author, id FROM posts WHERE id = ".$_POST['postid'], true);

					$notified = array();

					foreach ( $comm as $reg )
					{
						if ( $reg['author'] != $_SESSION['user_id'] )
							$notified[] = $reg['author'];
					}

					$notified[] = $postQ['author'];

					$text = $u->username." commented on a post you previously commented on";

					foreach ( $notified as $i )
					{
						$q2 = Sql::Insert('notifications', array(
							"text"			=> $text,
							"destination"	=> $i,
							"seen"			=> "0",
							"url"		    => "post.php?id=".$_POST['postid']
						));

						if ( !$q2 )
						{
							echo json_encode(array("success" => false, "text" => "Could not notify all participants"));
							exit;
						}
					}
					
					echo json_encode(array("success" => true, "text" => "Participants notified."));
					exit;
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "The post you're trying to notify participants of does not exist"));
					exit;					
				}

				if ( $q )
				{
					echo json_encode(array("success" => true, "text" => "Participants notified."));
					exit;
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "Error, could not notify participants, please contact support"));
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