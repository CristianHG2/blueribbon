<!DOCTYPE html>
<?

if ( !isset($_GET['provideContentToken']) )
{
?>
<html prefix="fb: http://www.facebook.com/2008/fbml" lang="en">
<head>
<? } ?>
<title>%site_name% - %page_name%</title>
<? if ( !isset($_GET['provideContentToken']) )
{
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="HandheldFriendly" content="true" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" 
      type="image/png" 
      href="https://theblueribbon.net/favicon.png">

	<!-- System resources -->

	%func::Tpl::addScript(iescript.js)%

	%func::Tpl::includeSystem()%

	<!-- Scripts -->

	%func::Tpl::addScript(kernel.js, accounts.js, posts.js, script.js, designFix.js, jssor_slider.js, jquery.visible.min.js)%

	<!-- Styles -->

	%func::Tpl::addStyle(input.css, index2.css, boxes.css)%

	<!-- Meta -->

	<META NAME="author" CONTENT="Coral Springs High School">
	<META NAME="subject" CONTENT="Non-profit website">
	<META NAME="Description" CONTENT="Blue Ribbon is a PSA website with a social aspect in which people that are going through depressions can let their voices be heard and get help.">
	<META NAME="Classification" CONTENT="Blue Ribbon is a PSA website with a social aspect in which people that are going through depressions can let their voices be heard and get help, our website contains information about bullying and is heavily moderated in order to keep the site's safety to a high standard.">
	<META NAME="Keywords" CONTENT="blue ribbon, depression, bullying, psa, help, social network, suicide">
	<META NAME="Language" CONTENT="English">
	<META NAME="Copyright" CONTENT="No rights reserved">
	<META NAME="Designer" CONTENT="Coral Springs High Web Team">
	<META NAME="Publisher" CONTENT="Coral Springs High Web Team">
	<META NAME="distribution" CONTENT="Global">
	<META NAME="Robots" CONTENT="INDEX,FOLLOW">
	<META NAME="zipcode" CONTENT="33065">
	<META NAME="city" CONTENT="Coral Springs">
	<META NAME="country" CONTENT="USA">

	<meta property="og:title" content="Blue Ribbon">
	<meta property="og:type" content="PSA Website">
	<meta property="og:url" content="https://theblueribbon.net/">
	<meta property="og:image" content="https://theblueribbon.net/favicon.png">
</head>
<body>
<?
}

if ( isset($_GET['provideContentToken']) )
{
?>
	
<?
}
?>