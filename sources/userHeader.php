<header>
	<div class="logoHead">
		<span class="title"><a href="/login.php" data-special="indexRed" style="color: #FFF; text-decoration: none;">Blue Ribbon</a></span>
	</div>
	<?

	if ( isset($_SESSION['user_id']) )
	{
	?>
		<div class="hamb" id="userHamb" style="opacity: 0.5;"><img src="resources/img/hamburger.png" height="30" alt="Menu"></div>
		<div class="userHambNav" style="display: none;">
			<a href="#" class="nav" style="color: #FFF; display: block; float: none; padding: 10px 20px 10px 20px; margin-bottom: 5px; margin-right: 0; margin-top: 20px;" data-ajax-href="notifs.php">Notifications (<span class="notifNums">3</span>)</a>			
			<a href="#" class="nav" style="color: #FFF; display: block; float: none; padding: 10px 20px 10px 20px; margin-bottom: 5px; margin-right: 0; " data-ajax-href="acc_settings.php">Account settings</a>
			<a href="#" class="nav" style="color: #FFF; display: block; float: none; padding: 10px 20px 10px 20px; margin-bottom: 5px; margin-right: 0; " data-action="userActionLogout">Log out</a>
		</div>
		<div class="items">
			<a href="#" style="color: #FFF" data-ajax-href="notifs.php" id="notifSign"><i class="fa fa-exclamation-circle"></i><div class="notifNum"><span style="    position: relative;
	    bottom: 7px;
	    left: -4.5px;
	    font-weight: bold;" class="notifNums">0</span></div></a>			
			<a href="#" style="color: #FFF" data-ajax-href="acc_settings.php"><i class="fa fa-cog"></i></a>
			<a href="#" style="color: #FFF" data-action="userActionLogout"><i class="fa fa-sign-out"></i></a>
		</div>
	<?
	}
	?>
</header>