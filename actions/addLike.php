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
				$u = new User($_SESSION['user_id']);

				$arr = json_decode($u->likedPosts, true);

				if ( in_array($_POST['id'], $arr) )
				{
					$q = Sql::Query("UPDATE posts SET cachedLikes = cachedLikes - 1 WHERE id = ".$_POST['id']);

					if ( $q )
					{
						$data = Sql::Query("SELECT cachedLikes FROM posts WHERE id = ".$_POST['id'], true);

						$id = array_search($_POST['id'], $arr);

						unset($arr[$id]);

						$new_arr = array_values($arr);

						Users::modifyUser($_SESSION['user_id'], 'likedPosts', json_encode($new_arr));				

						echo json_encode(array(
							"success"	=> true,
							"text"		=> "Like (".$data['cachedLikes'].")"
							));

						exit;
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "There was a problem while Unliking the post"));
						exit;
					}
				}
				else
				{
					$q = Sql::Query("UPDATE posts SET cachedLikes = cachedLikes + 1 WHERE id = ".$_POST['id']);

					if ( $q )
					{
						$data = Sql::Query("SELECT cachedLikes FROM posts WHERE id = ".$_POST['id'], true);

						$arr[] = $_POST['id'];

						$new_arr = array_values($arr);

						Users::modifyUser($_SESSION['user_id'], 'likedPosts', json_encode($new_arr));

						echo json_encode(array(
							"success"	=> true,
							"text"		=> "Unlike (".$data['cachedLikes'].")"
							));

						exit;
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "There was a problem while liking the post"));
						exit;
					}
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
			echo json_encode(array("success" => false, "text" => "The post ID must be set"));
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