<?php

require '../Init.php';

if ( Kernel::isAjax() )
{
	if ( !Kernel::areEmpty('name', 'email', 'subject', 'msg') )
	{
		if ( Text::validate($_POST['email'], 'email') )
		{
			$m = new Mail(htmlentities($_POST['subject']), array("Blue Ribbon", "no-reply@theblueribbon.net"));

			$m->addRecipient('cherreragiraldo@gmail.com', 'Cristian Herrera');
			$m->makeHTML();

			$m->content = '<center><h1>Blue Ribbon</h1></center><hr><br><b>You have received a contact request:</b><br><br>'.$_POST['msg'].'<br><br><b>Contactee\'s email: '.$_POST['email'];

			$mail = $m->sendMail();

			if ( $mail )
			{
				echo json_encode(array("success" => true, "text" => "Contact request successfully made"));
				exit;
			}
			else
			{
				echo json_encode(array("success" => true, "text" => "Could not perform the contact request"));
				exit;			
			}
		}
		else
		{
			echo json_encode(array("success" => true, "text" => "Please enter a valid email address"));
			exit;		
		}
	}
	else
	{
		echo json_encode(array("success" => true, "text" => "Please fill out all the fields"));
		exit;
	}
}
else
{
	echo json_encode(array("success" => true, "text" => "ACCESS DENIED"));
	exit;
}