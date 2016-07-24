<?php

require '../Init.php';

// isAJAX
if ( true )
{
	if ( isset($_SESSION['user_id']) )
	{
		//if ( isset($_POST['user_id']) && !empty($_POST['user_id']) && Text::validate($_POST['user_id'], 'num') )
		//	$userid = $_POST['user_id'];
		//else
			$userid = $_SESSION['user_id'];

		if ( $userid )
		{
			if ( Users::userExists($userid) )
			{	
				$u = new User($_SESSION['user_id']);

				if ( $userid !== $_SESSION['user_id'] )
				{
					if ( $u->rank < 3 )
					{
						echo json_encode(array("success" => false, "text" => "You do not have the permissions required to modify this user"));
						break;				
					}
					else
					{
						$u2 = new User($_POST['user_id']);

						if ( isset($_POST['displayname']) && strlen($_POST['displayname']) > 1 )
						{
							if ( Text::validate($_POST['displayname'], 'alnum') )
								$displayname = $_POST['displayname'];
							else
								$error[] = 'The display name can only contain alphanumeric characters';
						}
						else
							$displayname = $u2->username;

						if ( isset($_POST['email']) )
						{
							if ( Text::validate($_POST['email'], 'email') )
								$usermail = $_POST['email'];
							else
								$error[] = 'The email is not valid';
						}
						else
							$usermail = $u2->email;

						if ( isset($_FILES['profilepic']['tmp_name']) && strlen($_FILES['profilepic']['tmp_name']) > 3 )
						{
							$img = Kernel::uploadFile('profilepic');

							switch ( $img )
							{
								case 'copy';
									$error[] = 'Could not upload your profile picture';
									exit;
								break;
								case 'format';
									$error[] = 'Please upload a valid image (JPG, GIF, PNG)';
									exit;
								break;
								case 'oversize';
									$error[] = 'Please do not upload an image that\'s over 2 MB in size';
									exit;
								break;
								case 'minify';
									$error[] = 'Could not compress your profile picture';
									exit;
								break;
								default:
									$profile = $img;
								break;
							}
						}
						else
							$profile = $u2->image;

						if ( isset($_POST['motto']) && strlen($_POST['motto']) > 1 )
						{
							$motto = preg_replace('/[A-Za-z0-9!? ]/U', "", $_POST['motto']);
						}
						else
							$motto = $u2->motto;

						if ( isset($_POST['newpswd']) && $_POST['newpswd'] !== 'PSWD_NOCHANGE_DIRECT' )
						{
							if ( $_POST['newpswd'] == $_POST['confirmpswd'] )
							{
								$pswd = crypt($_POST['confirmpswd'], $displayname);
							}
							else
							{
								$error[] = 'Passwords do not match';
							}
						}
						else
							$pswd = $newpswd;

						if ( isset($error) )
						{
							$message = '';

							foreach ( $error as $i )
							{
								$message .= '<li>'.$i.'</li>';

								echo json_encode(array("success" => false, "text" => $message));
								exit();
							}
						}
					
						$q = Sql::Query("UPDATE accounts SET username = '".addslashes($displayname)."', email = '".addslashes($usermail)."', image = '".addslashes($profile)."', motto = '".addslashes($motto)."', password = '".addslashes($pswd)."' WHERE id = ".$u2->id);

						Sql::Query("UPDATE comments SET userIMG = '".addslashes($profile)."', userName = '".addslashes($displayname)."' WHERE author = ".$u2->id);

						Sql::Query("UPDATE posts SET userIMG = '".addslashes($profile)."', userName = '".addslashes($displayname)."' WHERE author = ".$u2->id);

						if ( $q )
						{
							echo json_encode(array("success" => true, "text" => "Details successfully changed"));
							exit();
						}
						else
						{
							echo json_encode(array("success" => false, "text" => "There has been an error while modifying the account"));
							exit();							
						}
					}
				}
				else
				{
					$u2 = new User($_SESSION['user_id']);

					if ( isset($_POST['displayname']) && strlen($_POST['displayname']) > 1 )
					{
						if ( Text::validate($_POST['displayname'], 'alnum') )
							$displayname = $_POST['displayname'];
						else
							$error[] = 'The display name can only contain alphanumeric characters';
					
						$newpswd = crypt($_POST['currpswd'], $_POST['displayname']);
					}
					else
						$displayname = $u2->username;

					if ( isset($_POST['email']) )
					{
						if ( Text::validate($_POST['email'], 'email') )
							$usermail = $_POST['email'];
						else
							$error[] = 'The email is not valid';
					}
					else
						$usermail = $u2->email;

					if ( isset($_FILES['profilepic']['tmp_name']) && strlen($_FILES['profilepic']['tmp_name']) > 3 )
					{
						$img = Kernel::uploadFile('profilepic');

						switch ( $img )
						{
							case 'copy';
								$error[] = 'Could not upload your profile picture';
								exit;
							break;
							case 'format';
								$error[] = 'Please upload a valid image (JPG, GIF, PNG)';
								exit;
							break;
							case 'oversize';
								$error[] = 'Please do not upload an image that\'s over 2 MB in size';
								exit;
							break;
							case 'minify';
								$error[] = 'Could not compress your profile picture';
								exit;
							break;
							default:
								$profile = $img;
							break;
						}
					}
					else
						$profile = $u2->image;

					if ( isset($_POST['motto']) && strlen($_POST['motto']) > 1 )
					{
						$motto = preg_replace('/[^A-Za-z0-9!? ]/U', "", $_POST['motto']);
					}
					else
						$motto = $u2->motto;

					if ( isset($_POST['newpswd']) && $_POST['newpswd'] !== 'PSWD_NOCHANGE_DIRECT' )
					{
						if ( $_POST['newpswd'] == $_POST['confirmpswd'] )
						{
							$pswd = crypt($_POST['confirmpswd'], $displayname);
						}
						else
						{
							$error[] = 'Passwords do not match';
						}
					}
					else
					{
							$pswd = $u2->password;

							if ( isset($_POST['displayname']) && strlen($_POST['displayname']) > 1 )
							{
								$pswd = $newpswd;
							}
					}

					if ( isset($error) )
					{
						$message = '';

						foreach ( $error as $i )
						{
							$message .= '<li>'.$i.'</li>';

							echo json_encode(array("success" => false, "text" => $message));
							exit();
						}
					}
					
					if ( crypt($_POST['currpswd'], $u2->username) == $u2->password )
					{

						$q = Sql::Query("UPDATE accounts SET username = '".addslashes($displayname)."', email = '".addslashes($usermail)."', image = '".addslashes($profile)."', motto = '".addslashes($motto)."', password = '".addslashes($pswd)."' WHERE id = ".$u2->id);

						Sql::Query("UPDATE comments SET userIMG = '".addslashes($profile)."', userName = '".addslashes($displayname)."' WHERE author = ".$u2->id);

						Sql::Query("UPDATE posts SET cachedIMG = '".addslashes($profile)."', cachedName = '".addslashes($displayname)."' WHERE author = ".$u2->id);

						if ( $q )
						{
							echo json_encode(array("success" => true, "text" => "Details successfully changed"));
							exit();
						}
						else
						{
							echo json_encode(array("success" => false, "text" => "There has been an error while modifying the account"));
							exit();							
						}
					}
					else
					{
						echo json_encode(array("success" => false, "text" => "The password you entered is not correct"));
						exit();						
					}
				}
			}
			else
			{
				echo json_encode(array("success" => false, "text" => "That user does not exist"));
				exit;
			}
		}
		else
		{
			echo json_encode(array("success" => false, "text" => "Cannot parse user ID"));
			header(Kernel::GetHTTP(403));
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
	echo json_encode(array("success" => false, "text" => "ACCESS DENIED"));
	header(Kernel::GetHTTP(401));
	exit;
}