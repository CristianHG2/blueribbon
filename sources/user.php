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

	$u = new User($_GET['id']);
?>
				<div class="userPage2">
					<div class="img">
						<img src="%site_resources%/img/userimg/<?=str_replace(' ', '%20', $u->image);?>" alt="User profile" style="height: 100% !important;">

						<Br><br><br><br>

						<center>
						<? if ( $_GET['id'] == $_SESSION['user_id'] ) { ?>
							<a href="#" class="button" id="accSettings">Account settings</a><br>
						<? } else { ?>
							<a href="#" class="button" id="reportAction">Report</a><br>
						<? } ?>
						</center>
					</div>
					<div class="userinfo">
						<h1 style="font-size: 50px !important;"><?=$u->prefix;?> <?=$u->username;?></h1>
						<h3 class="openSans" style="font-size: 20px !important;">"<?=$u->motto;?>"</h3><br><br>

						<div style="margin-bottom: 3.8%; margin-top: 3%;">
							<span><b>Posts:</b> <?=Sql::numRows("SELECT author FROM posts WHERE author = ".$_GET['id']);?></span><br><br>
							<span><b>Comments:</b> <?=Sql::numRows("SELECT author FROM comments WHERE author = ".$_GET['id']);?></span><br><br>
							<span><b>Liked Posts:</b> <? $json = json_decode($u->likedPosts, true); echo count($json); ?></span><br><br>
						</div>

						<br><br>

						<?

						$q = "SELECT * FROM posts WHERE author = ".$_GET['id'];

						if ( Sql::numRows($q) > 0 )
						{
							$s = Sql::Query($q);

							foreach ( $s as $reg )
							{
							?>
								<a href="#" class="userPostClick" data-ajax-href="post.php?id=<?=$reg['id'];?>">
									<div class="unclicked userPost">
										<p class="postContent" style="overflow: auto">
											<span style="float: left; margin: 0; overflow-y: hidden;"><?=Kernel::getWords($reg['content']);?>...</span>
											<span style="float: right; margin: 0; overflow-y: hidden;">Likes (<?=$reg['cachedLikes'];?>) | Comments (<?=$reg['cachedComments'];?>)</span>
										</p>
									</div>
								</a>
							<?
							}
						}
						else
						{
						?>
							No posts by this user
						<?
						}
						?>
					</div>
				</div>
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