<?
if ( !isset($_GET['secondaryToken']) )
{
	include('userHeader.php');
	?>
	<div class="mainContainer">
		<div class="container">
			<div class="postContainerMod postContainer">
<?
}
	$u = new User($_SESSION['user_id']);
?>
	<h1 style="font-size: 60px !important;">Notifications</h1>
	<br><br><br>

	<div class="notifs">
	</div>

	<script>
		setInterval(function()
		{
			postSys.getNotifications($(".notifs"), function(t)
			{
				$(".notifs").html(t);
			});
		}, 500);

	</script>
<?
if ( !isset($_GET['secondaryToken']) )
{
?>
			</div>
		</div>
	</div>
<?
}
?>