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
	<div id="holder"></div>
	<h1 style="font-size: 60px !important;">Account settings</h1>
	<br><br><br>

	<style type="text/css" media="screen">
		label
		{
			font-weight: bold;
		}
	</style>

	<form action="#" id="accSettingsForm" method="POST">

		<label>Display name:</label><br><br>
		<input type="text" name="displayname" class="input_field" style="width: 100%" value="<?=$u->username;?>">

		<label>Motto:</label><br><br>
		<input type="text" name="motto" class="input_field" style="width: 100%" value="<?=$u->motto;?>">

		<label>E-mail:</label><br><br>
		<input type="text" name="email" class="input_field" style="width: 100%" value="<?=$u->email;?>">

		<label>Profile picture:</label><br><br>
		<input type="file" name="profilepic" class="input_field" style="width: 100%">

		<label>New password:</label><br><br>
		<input type="password" name="newpswd" class="input_field" style="width: 100%" value="PSWD_NOCHANGE_DIRECT">

		<label>New password:</label><br><br>
		<input type="password" name="confirmpswd" class="input_field" style="width: 100%" value="PSWD_NOCHANGE_DIRECT">

		<label>Current password (<b style="color: red">*</b>):</label><br><br>
		<input type="password" name="currpswd" class="input_field" style="width: 100%">

		<button type="submit" class="input_button">Submit</button>
	
	</form>

	<script>
		$("#accSettingsForm").submit(function(e)
		{
			e.preventDefault();

			var fData = new FormData($("#accSettingsForm")[0]);

			$.ajax({
				url : window.actionPath + 'modifyUser.php',
				cache : false,
				contentType : false,
				processData : false,
				data : fData,
				dataType : 'json',
				type : 'POST'
			})
			.fail(function(data)
			{
				console.log(data);
				kernelSys.popUp("Network Error", "Could not process the detail change request");
			})
			.done(function(data)
			{
				if ( data.success == true )
				{
					kernelSys.launchMsg(2, data.text, $("#holder"));
				}
				else
				{
					kernelSys.launchMsg(0, data.text, $("#holder"));
				}
			});
		});
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