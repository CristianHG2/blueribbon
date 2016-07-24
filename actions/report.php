<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('id') )
		{
			if ( Sql::numRows("SELECT id FROM posts WHERE id = ".addslashes($_POST['id'])) > 0 )
			{
				$m = new Mail(htmlentities('Post '.$_POST['id'].' has been reported'), array("Blue Ribbon", "no-reply@theblueribbon.net"));

				$m->addRecipient('cherreragiraldo@gmail.com', 'Cristian Herrera');
				$m->makeHTML();

				$m->content = '<center><h1>Blue Ribbon</h1></center><hr><br><b>A post has been reported:</b><br><br>This is the URL of the reported post <br><br><a href="http://www.studiowolfree.com/blueribbon5/post.php?id='.$_POST['id'].'>http://www.studiowolfree.com/blueribbon5/post.php?id='.$_POST['id'].'</a><br><br>';

				$mail = $m->sendMail();

				if ( $mail )
				{
					echo json_encode(array("success" => true, "text" => "Report successfully made"));
					exit;
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "Could not submit your report"));
					exit;			
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "The post you're trying to report does not exist"));
				exit;		
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "Please fill out all the fields"));
			exit;
		}
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "You are not logged in"));
		exit;		
	}
}
else
{
	echo json_encode(array("success" => true, "text" => "ACCESS DENIED"));
	exit;
}