<?

require 'Init.php';

if ( isset($_SESSION['user_id']) )
	header('Location: dashboard.php');

$page['id'] = 'login';
$page['name'] = 'Login';