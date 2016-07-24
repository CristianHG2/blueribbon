<?
	
$pro = array('/login.php', '/index.php');

if ( 
	(!isset($_GET['provideContentToken']) && !in_array($_SERVER['PHP_SELF'], $pro))
	OR
	(!isset($_GET['secondaryToken']) && isset($_GET['provideContentToken']))
   )
{
?>
<footer><a href="/privacy.php" data-special="goURL" data-URL="privacy.php">Privacy Policy & ToS</a> | <a href="/about.php" data-special="goURL" data-URL="about.php">About Us</a> | <a href="/contact_us.php" data-special="goURL" data-URL="contact_us.php">Contact</a> | <a href="/sitemap.php" data-special="goURL" data-URL="sitemap.php">Sitemap</a> | <a href="/sitemap.php" data-special="goURL" data-URL="copyright.php">Copyright notices</a></footer>
<?
}
else
{
	echo "</div>";
}
?>
</html>