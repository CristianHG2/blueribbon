<div class="sidebarLeft">
	<?
	$q = Sql::Query("SELECT * FROM blog_posts");

	foreach ( $q as $reg )
	{
		?>
	<div class="blogpost">
		<img src="%site_resources%/img/userimg/<?=$reg['cachedIMG'];?>" class="pfp" alt="Author Picture">
		
		<div class="message" style="overflow: hidden; padding-left: 7px;">
			
			<h1><?=$reg['title'];?></h1>
			<br><i><b><?=$reg['cachedName'];?></b> &bullet; <?=$reg['cachedCat'];?> &bullet; <?=gmdate("F j, Y, g:i a", $reg['time']);?></i>

			<br><br>
			
			<div class="textContent">
				<?=$reg['text'];?>
			</div>
		
		</div>
	</div>
		<?
	}
	?>
</div>