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
				<div id="msgHolder">
				</div>
				<form action="#" method="POST" id="postForm">
					<textarea placeholder="Have something to say?" name="postCont" class="input_field"></textarea>
					<div style="text-align: right"><button class="input_button">Post</button></div>
				</form>

			<div class="postList">
			</div>
			</div>
			<script>
			mobileFix();
			postSys.setProperty("currNum", 0);
			postSys.setProperty("postCont", $(".postList"));
			postSys.fetchPosts(function(t)
			{
				$(".postList").html("<b>" + t + "</b>");
				$(".postList").css({overflow : 'hidden'});
				mobileFix();
			});

			$(window).scroll(function()
			{ 
				if ( $(window).scrollTop() >= $(document).height() - $(window).height() - 60 )
				{
					//postSys.fetchPosts(function(t)
					//{
					//	if ( t != "No posts to show!" )
					//	{
					//		$(".postList").html("<b>" + t + "</b>");
					//		$(".postList").css({overflow : 'hidden'});
					//		mobileFix();
					//	}
					//});					
				}
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