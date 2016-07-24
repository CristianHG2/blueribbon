<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('post') )
		{
			if ( strlen($_POST['post']) > 0 )
			{
				$u = new User($_SESSION['user_id']);

				$q = Sql::Insert("posts", array(
						"author"		=> $_SESSION['user_id'],
						"content"		=> nl2br(htmlentities($_POST['post'])),
						"date_created"	=> time(),
						"lastactive"	=> time(),
						"cachedName"	=> $u->username,
						"cachedLikes"	=> 0,
						"cachedIMG"		=> $u->image,
						"cachedPrefix"	=> $u->prefix
					));

				if ( $q )
				{
					echo json_encode(array("success" => true, "text" => "Post successfully posted"));
					exit;
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "Error, could not create your post, please contact support"));
					exit;				
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "Your post must be longer than 0 characters"));
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