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
	$reg = Sql::Query("SELECT * FROM posts WHERE id = ".$_GET['id']." LIMIT 1", true);

	if ( Sql::numRows("SELECT * FROM posts WHERE id = ".$_GET['id']) < 1 )
		header('Location: index.php');

	$u = new User($_SESSION['user_id']);

	$array = json_decode($u->likedPosts, true);

	if ( in_array($_GET['id'], $array) )
		$likeText = 'Unlike';
	else
		$likeText = 'Like';
?>
	<div class="singlePost" id="post<?=$_GET['id'];?>" data-onsingle="1">
		<a href="#" data-ajax-href="user.php?id=<?=$reg['author'];?>" class="userPage">
			<img src="%site_resources%/img/userimg/<?=str_replace(' ', '%20', $reg['cachedIMG'])?>" class="pfp" alt="Profile picture">
		</a>

		<div class="message" style="padding-right: 20px;">
			<a href="#" style="text-decoration: none;" data-ajax-href="user.php?id=<?=$reg['author'];?>" class="displayname"><?=$reg['cachedPrefix'];?> <?=$reg['cachedName'];?></a>
			<div class="actionLinks"><a href="#" style="opacity: 1;" class="multiaction"><i class="fa fa-asterisk"></i></a></div>

			<br><br>

			<div class="textContent"><?=$reg['content'];?></div>

			<div class="links">
				<a href="#" data-ajax-href="post.php?id=<?=$reg['id'];?>" id="commentNum" class="commentsLink">Comments (<?=$reg['cachedComments'];?>)</a>
				 &bullet; 
				<a href="#" class="likeLink" data-postID="<?=$reg['id'];?>"><?=$likeText;?> (<?=$reg['cachedLikes'];?>)</a>

				<hr>

				<div class="comments">

				</div>

				<div id="msgHolder"></div>

				<div id="cmtFormHolder">
				<? if ( $reg['locked'] != 1 )
				{
				?>
					<form action="#" method="POST" id="commentForm">
						<textarea placeholder="Write a comment" name="commCont" class="input_field"></textarea>
						<div align="right"><button class="input_button">Post</button></div>
					</form>
				<?
				}
				?>
				</div>
			</div>
		</div>
	</div>

	<script>
		var params = kernelSys.URLToArray(window.location.href);
		
		postSys.getComments(params['id'], $(".comments"), $("#commentNum"), function(data)
		{
			if ( data !== "<b>No comments to show</b>" )
				kernelSys.launchMsg(0, data, $(".comments"));
			else
				$(".comments").append($("<center>" + data + "</center>"));
		});

		setInterval(function()
		{
			postSys.getComments(params['id'], $(".comments"), $("#commentNum"), function(data)
			{
				if ( data !== "<b>No comments to show</b>" )
					kernelSys.launchMsg(0, data, $(".comments"));
				else
					$(".comments").append($("<center>" + data + "</center>"));
			});
		}, 2000);
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