<?

if ( !isset($_GET['secondaryToken']) )
{
	include('userHeader.php');
	?>
	<div class="mainContainer">
		<div class="container">
			<div class="postContainer">
<?
}
?>
			<div class="insideContainer">
				<center style="margin-bottom: 5%;">
					<h1>Just a few more steps...</h1>
				</center>
				<div id="msgField"></div><br>
				<form action="#" class="finishSignupForm" id="signupForm" method="POST">
					<label>E-mail:</label><br><br>
					<input type="ptext" name="email" class="input_field" style="width: 100%" <? echo ( isset($_GET['mail']) ? "value=\"".$_GET['mail']."\"" : "placeholder=\"Your email\"" ); ?>><br>

					<label>Password:</label><br><br>
					<input type="password" name="pswd" class="input_field" style="width: 100%" placeholder="Your password"><br>

					<label>Confirm password:</label><br><br>
					<input type="password" name="pswd_confirm" class="input_field" style="width: 100%" placeholder="Confirm password"><br>

					<label>Display name <small>(Only alphanumeric characters! [A-Z] [1-9])</small>:</label><br><br>
					<input type="text" name="displayname" class="input_field" style="width: 100%" <? echo ( isset($_GET['pswd']) ? "value=\"".$_GET['pswd']."\"" : "placeholder=\"Display name (How you'll appear on the forums)\"" ); ?> maxlength="60"><br>

					<label>Profile picture <small>(Must be below 2 MB) (JPG, GIF and PNG accepted)</small>:</label><br><br>
					<input type="file" name="pic" class="input_field" style="width: 100%" placeholder="Password"><br>

					<button class="input_field" style="width: 100%;">Submit</button>
				</form>
			</div>

			<script>

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