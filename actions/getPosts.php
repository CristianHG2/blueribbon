<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		$u = new User($_SESSION['user_id']);

		$where = '';

		if ( count(json_decode($u->hiddenPosts, true)) > 0 )
		{
			$where = 'WHERE id NOT IN (';
			$where .= implode(', ', json_decode($u->hiddenPosts, true));
			$where .= ')';
		}

		$qText = "SELECT * FROM posts ".$where;

		$num = Sql::numRows($qText);

		$lim = $num;

		for ( $i = 0; $i <= 8; $i++ )
		{
			if ( $lim > 0 )
				$lim -= 1;
		}

		if ( isset($_POST['post_start']) && is_numeric($_POST['post_start']) && $_POST['post_start'] > 0 )
		{
			$qText = "SELECT * FROM posts ".$where." ORDER BY lastactive ASC";
		}
		else
			$qText = "SELECT * FROM posts ".$where." ORDER BY lastactive ASC";

		$num = Sql::numRows($qText);

		if ( $num > 0 )
		{
			$query = Sql::Query($qText);

			if ( !$query )
			{
				echo json_encode(array("success" => false, "text" => "Server error, could not fetch posts"));
				exit;
			}
			else
			{
				$data = array();
				$index = 0;
				$data['length'] = 0;
				foreach ( $query as $reg )
				{
					$data[$index]['prefix'] = $reg['cachedPrefix'];
					$data[$index]['userURL'] = $reg['author'];
					$data[$index]['userIMG'] = $reg['cachedIMG'];
					$data[$index]['userName'] = $reg['cachedName'];
					$data[$index]['postCont'] = $reg['content'];
					$data[$index]['commentText'] = 'Comments ('.$reg['cachedComments'].')';

					$u = new User($_SESSION['user_id']);

					$arr = json_decode($u->likedPosts, true);

					if ( in_array($reg['id'], $arr) )
					{
						$data[$index]['likeText'] = 'Unlike ('.$reg['cachedLikes'].')';
					}
					else
					{
						$data[$index]['likeText'] = 'Like ('.$reg['cachedLikes'].')';
					}

					$data[$index]['postID'] = $reg['id'];
					$data['length'] += 1;

					$index++;
				}

				$data['success'] = true;

				echo json_encode($data);
				exit;
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "No posts to show!"));
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