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
				$q = "SELECT author, locked FROM posts WHERE id = ".$_POST['id'];

				if ( Sql::numRows($q) > 0 )
				{
					$data = Sql::Query($q, true);

					if ( $data['author'] == $_SESSION['user_id'] )
					{
						if ( $data['locked'] == 1 )
							$lockText = 'Unlock';
						else
							$lockText = 'Lock';

						echo json_encode(array("success" => true, "text" => "<a href=\"#\" class=\"deletePostLink\">Delete</a><br><br><a href=\"#\" class=\"lockPostLink\">".$lockText."</a><br>"));
						exit;
					}
					else
					{
						echo json_encode(array("success" => true, "text" => "<br><a href=\"#\" class=\"reportPostLink\">Report</a><br>"));
						exit;
					}
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "The post you're looking for does not exist"));
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
			echo json_encode(array("success" => false, "text" => "The post ID must be set".var_export($_POST, true)));
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