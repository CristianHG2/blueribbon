<?

require 'Init.php';

if ( !isset($_SESSION['user_id']) )
{
	header(Kernel::getHTTP(403));
	header('Location: login.php');
	exit;
}

$page['id'] = 'dashboard';
$page['name'] = 'Dashboard';