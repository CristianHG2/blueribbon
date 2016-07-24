<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( !isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('email', 'pswd') )
		{
			if ( Text::validate($_POST['email'], 'email') )
			{
				$user = new User($_POST['email'], 'email');

				$res = $user->logIn($_POST['pswd']);

				if ( $res )
				{
					echo json_encode(array("success" => true, "text" => "Successfully logged in"));
					exit;
				}
				else
				{
					if ( $res === 0 )
						echo json_encode(array("success" => false, "text" => "There is not an account associated with this email"));

					if ( $res === false )
						echo json_encode(array("success" => false, "text" => "The password is not correct"));

					exit;						
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "Please enter a valid email"));
				exit;				
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "You must fill out all fields correctly"));
			exit;
		}		
	}
	else
	{
		echo json_encode(array("success" => false, "text" => "You're already logged in"));
		//header(Kernel::getHTTP(401));
		exit;		
	}
}
else
{
	echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
	header(Kernel::getHTTP(403));
	exit;
}