<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( !isset($_SESSION['user_id']) )
	{
		if ( !Kernel::areEmpty('email', 'pswd', 'pswd_confirm', 'displayname') )
		{
			if ( Text::validate($_POST['email'], 'email') )
			{
				if ( Text::validate($_POST['displayname'], 'alnum') )
				{
					if ( strlen($_POST['displayname']) < 60 )
					{
						if ( $_POST['pswd'] === $_POST['pswd_confirm'] )
						{
							$img = Kernel::uploadFile('pic');

							switch ( $img )
							{
								case 'copy';
									echo json_encode(array("success" => false, "text" => "Could not upload your profile picture"));
									exit;
								break;
								case 'format';
									echo json_encode(array("success" => false, "text" => "Please upload a valid image (JPG, GIF, PNG)"));
									exit;
								break;
								case 'oversize';
									echo json_encode(array("success" => false, "text" => "Please do not upload an image that's over 2 MB in size"));
									exit;
								break;
								case 'minify';
									echo json_encode(array("success" => false, "text" => "Could not compress your profile picture"));
									exit;
								break;
								default:
									if ( $_POST['pswd'] !== $_POST['pswd_confirm'] )
									{
										echo json_encode(array("false" => true, "text" => "Passwords do not match"));
										exit;
									}

									$u = new Users('email');
									
									if ( !Users::userExists($_POST['email']) )
									{
										if ( Users::addUser($_POST['displayname'], $_POST['email'], $_POST['pswd'], array("image" => $img, "rank" => 1, "likedPosts" => json_encode(array()))) )
										{
											Users::logIn($_POST['email'], $_POST['pswd']);
											
											echo json_encode(array("success" => true, "text" => "Successfully signed up"));
											exit;
										}
									}
									else
									{
										echo json_encode(array("success" => false, "text" => "There's an account that's already registered to your email"));
										exit;
									}
								break;
							}
						}
						else
						{
							echo json_encode(array("success" => false, "text" => "The passwords don't match"));
							exit;						
						}
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "The display name may not be longer than 60 characters"));
						exit;							
					}
				}
				else
				{
					echo json_encode(array("success" => false, "text" => "Your username may only contain alphanumeric characters (A-Z, 1-9)"));
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