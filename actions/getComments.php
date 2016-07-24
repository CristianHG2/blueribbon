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
				if ( Sql::numRows("SELECT id FROM posts WHERE id = ".$_POST['id']) > 0 )
				{
					$qText = "SELECT * FROM comments WHERE postid = ".$_POST['id']." ORDER BY created ASC";

					if ( Sql::numRows($qText) > 0 )
					{
						$query = Sql::Query($qText);

						if ( !$query )
						{
							echo json_encode(array("success" => false, "text" => "Server error, could not fetch comments"));
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
								$data[$index]['user'] = $reg['author'];
								$data[$index]['text'] = $reg['content'];
								$data[$index]['userIMG'] = $reg['userIMG'];
								$data[$index]['userName'] = $reg['userName'];
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
						echo json_encode(array("success" => false, "text" => "No comments to show"));
						exit;
					}
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "The post requested does not exist"));
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
			echo json_encode(array("success" => false, "text" => "No ID was provided"));
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