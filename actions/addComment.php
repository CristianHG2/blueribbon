<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('text', 'id') )
		{
			if ( Text::validate($_POST['id'], 'num') )
			{
				if ( Sql::numRows("SELECT id, locked FROM posts WHERE id = ".$_POST['id']." AND locked = '0'") > 0 )
				{
					$text = nl2br(preg_replace('/[[:^print:]]/', '', htmlentities($_POST['text'])));

					$u = new User($_SESSION['user_id']);

					$q = Sql::Insert('comments', array(
						"author"	=> $_SESSION['user_id'],
						"content"	=> $text,
						"postid"	=> $_POST['id'],
						"created"	=> time(),
						"userIMG"	=> $u->image,
						"userName"	=> $u->username,
						"cachedPrefix"	=> $u->prefix
					));

					if ( $q )
					{
						Sql::Query("UPDATE posts SET cachedComments = cachedComments + 1, lastactive = ".time()." WHERE id = ".$_POST['id']);

						echo json_encode(array(
							"success" 	=> true, 
							"text" 		=> $text,
							"userIMG" 	=> $u->image,
							"userName"	=> $u->username,
							"prefix"	=> $u->prefix
						));
						
						exit;
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "Could not post your comment"));
						exit;
					}
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "The post you're trying to comment on does not exist"));
					exit;					
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "The post ID must be a numeric value"));
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