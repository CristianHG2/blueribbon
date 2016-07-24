<?php
	if ( !isset($_GET['provideContentToken']) )
	{
?>
<!-- Loading bar -->
<div class="topBar" id="loadingBar"></div>
<!-- Overlay -->
<div class="overlay" id="mainOverlay" style="display: none;">
	<div class="box">
		<header></header>
		<main></main>
	</div>
</div>
    <nav>
    <div class="logo" id="siteTitle" style="font-family: 'Oswald', sans-serif;">Blue Ribbon</div>

    <div class="hamb" style="display: none; opacity: 0.5;"><img src="resources/img/hamburger.png" height="30" alt="Menu"></div>
    <div class="links">
        <a href="contact_us.php" class="nav" data-href="contact_us.php"> <span>Contact Us</span></a>
        <a href="login.php" class="nav" data-href="login.php"> <span>Community</span></a>
        <a href="blog/" class="nav" data-href="blog"> <span>Blog</span></a>
        <a href="about.php" class="nav" data-href="about.php"> <span>About</span></a>
        <a href="index.php" class="nav" data-href="index.php"> <span>Home</span></a>
    </div>

    </nav>
<div class="indexContainer">
<?
	}
?>
<script>
	$("a").click(function(e)
	{
		var t = $(this);

		if ( $("#jssor_1").length )
		{
			$("#jssor_1").slideUp(1000, function()
			{
				e.preventDefault();

				switch ( t.attr('data-href') )
				{
					case 'blog':
						window.location.href = 'blog';
					break;
					case 'login.php':
						window.location.href = 'login.php';
					break;
					default:
						window.pageContainer = $(".indexContainer");

						kernelSys.loadPage(t.attr('data-href'), function(data)
						{
							window.pageContainer.html(data);
						});	
					break;			
				}
			});
		}
		else
		{
			e.preventDefault();
			
			switch ( t.attr('data-href') )
			{
				case 'blog':
					window.location.href = 'blog';
				break;
				case 'login.php':
					window.location.href = 'login.php';
				break;
				default:
					window.pageContainer = $(".indexContainer");

					kernelSys.loadPage(t.attr('data-href'), function(data)
					{
						window.pageContainer.html(data);
					});		
				break;
			}	
		}
	});
</script>