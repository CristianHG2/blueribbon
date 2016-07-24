
var isIE10=false;var kernelSys=new kernelSystem();var accountSys=new accountSystem();var postSys=new postSystem();var hoveredAsterisks=new Array();$(document).ready(function()
{window.overlayDom=$("#mainOverlay");window.boxDom=window.overlayDom.children(".box");$.fn.follow=function(event,callback)
{$(document).on(event,$(this).selector,callback);}
if($(".postContainer").length)
{window.pageContainer=$(".postContainer");}
postSys.setProperty("messageTpl",'<div class="post"><a href="#" class="userPage"><img src="" class="pfp"></a><div class="message"><a href="#" style="text-decoration: none;" data-ajax-href="#" class="displayname"></a><div class="actionLinks"><a href="#" style="opacity: 0;" class="multiaction"><i class="fa fa-asterisk"></i></a></div><br><br><div class="textContent"></div><div class="links"><a href="#" class="commentsLink">Comments (0)</a> &bullet; <a href="#" class="likeLink">Like (0)</a></div></div></div>');postSys.setProperty("commentTpl",'<div class="comment"><div class="innerComment"><figure><img src="#"></figure><div class="content"><a href="#" data-ajax-href="#" style="text-decoration: none;" class="name">Johny Doe</a><br><br><p></p></div></div></div>');postSys.setProperty("menuTpl",'<div class="floatingmenu" postID="#"><p></p></div>');postSys.setProperty("notifTpl",'<a href="#" id="#" data-ajax-href="#" class="notification"><div></div></div>');var cmtFormTpl='<form action="#" method="POST" id="commentForm"><textarea placeholder="Write a comment" name="commCont" class="input_field"></textarea><div align="right"><button class="input_button">Post</button></div></form>';$("a").click(function(e)
{if($(this).attr('href')=="#")
e.preventDefault();if($(this).attr('data-special')=="indexRed")
{window.location.href='/login.php';}
if($(this).attr('data-special')=="goURL")
{window.location.href='/'+$(this).attr('data-url');}});$("#splashPage").fadeIn(1000);$("#splashVideo").css({width:$(window).width()+900,height:$(window).height()+900});$(".deletePostLink").follow('click',function()
{var Pid=$(this).parent().parent().attr('data-postid');var sing=$("#post"+Pid).attr('data-onsingle');postSys.deletePost(Pid,function()
{if(sing==1)
{window.location.href=window.siteRL+'login.php';}
else
{$("#post"+Pid).remove();postSys.setProperty("currNum",0);postSys.setProperty("postCont",$(".postList"));postSys.fetchPosts(function(t)
{$(".postContainer").html("<b>"+t+"</b>");$(".postContainer").css({overflow:'hidden'});});}},$("#msgHolder"));});$(".lockPostLink").follow('click',function()
{if($(this).text()=='Lock')
$(this).text('Unlock');else
$(this).text('Lock');var Pid=$(this).parent().parent().attr('data-postid');var sing=$("#post"+Pid).attr('data-onsingle');postSys.lockPost(Pid,function(type)
{if(sing==1&&type==0)
$("#commentForm").remove();if(sing==1&&type==1)
$("#cmtFormHolder").append($(cmtFormTpl));},$("#msgHolder"));});$(".reportPostLink").follow('click',function()
{var Pid=$(this).parent().parent().attr('data-postid');var sing=$("#post"+Pid).attr('data-onsingle');$.ajax({url:window.actionPath+'report.php',method:'POST',data:{id:Pid},dataType:'json'}).fail(function(data)
{kernelSys.popUp('Network Error','Could not submit your report');}).done(function(data)
{if(data.success==true)
{kernelSys.popUp('Success','Your report has been placed. We\'ll get back to you ASAP');}
else
{kernelSys.popUp('Failure',data.text);}});});$(".message").follow('mouseover',function()
{$(this).children('.actionLinks').children('.multiaction').css('opacity','1');});$(".message").follow('mouseleave',function()
{if(hoveredAsterisks.indexOf($(this).parent().attr('id'))===-1)
$(this).children('.actionLinks').children('.multiaction').css('opacity','0');});$(".multiaction").follow('mouseover',function()
{var m=$(this).parent().parent();postSys.overPost(m,function(t)
{hoveredAsterisks.push(t);},function(t,a)
{$("#"+t).remove();$("#"+a).children('.message').children('.actionLinks').children('.multiaction').css('opacity','0');var id=hoveredAsterisks.indexOf(a);if(id>-1)
hoveredAsterisks.splice(id,1);});});$("#mainOverlay").click(function()
{kernelSys.hideOverlay();});$("a").follow('click',function(e)
{if($(this).attr('data-special')=="indexRed")
{window.location.href='/login.php';}
if($(this).attr('data-special')=="goURL")
{}
if($(this).attr('href')=="#")
{e.preventDefault();var t=$(this);if($(this).attr('data-ajax-href')!==null&&$(this).attr('data-ajax-href')!==undefined)
{kernelSys.loadPage(t.attr('data-ajax-href'),function(data)
{window.pageContainer.html(data);});}
if($(this).attr('id')=="accSettings")
{kernelSys.loadPage('acc_settings.php',function(data)
{window.pageContainer.html(data);});}}});$("#signUpS1Form").follow('submit',function(e)
{e.preventDefault();var emailVal=$(this).children("input[name=email]").val();var displayVal=$(this).children("input[name=display]").val();kernelSys.loadPage('signup.php?mail='+emailVal+'&pswd='+displayVal,function(data)
{$("#pageHolder").html(data);$("#splashOverlay").slideUp(500);$("#splashVideo").fadeOut(500);$("#splashPage").slideUp(500,function()
{$("#mainSplash").remove();window.pageContainer=$(".insideContainer");$("#pageHolder").css({"z-index":'100'});});},true);});$("#signupForm").follow('submit',function(e)
{e.preventDefault();var fData=new FormData($("#signupForm")[0]);accountSys.signUp(fData,function()
{kernelSys.loadPage('dashboard.php',function(data)
{window.pageContainer.html(data);window.location.reload(true);});},$("#msgField"));});$("#loginForm").follow('submit',function(e)
{e.preventDefault();var emailVal=$(this).children('input[name=email]').val();var pswdVal=$(this).children('input[name=pswd]').val();accountSys.logIn(emailVal,pswdVal,function()
{kernelSys.loadPage('dashboard.php',function(data)
{$("#pageHolder").html(data);$("#splashOverlay").slideUp(500);$("#splashVideo").fadeOut(500);$("#splashPage").slideUp(500,function()
{$("#mainSplash").remove();window.pageContainer=$(".insideContainer");$("#pageHolder").css({"z-index":'100'});window.location.reload(true);});},true);},$("#msgHolder"));});$("#postForm").follow('submit',function(e)
{e.preventDefault();var t=$(this).children('textarea');postSys.addPost($(this).children('.input_field').val(),function(data)
{if(data.success==true)
{postSys.setProperty("postCont",$(".postList"));postSys.fetchPosts(function(t)
{if(t!="No posts to show!")
{$(".postContainer").html("<b>"+t+"</b>");$(".postContainer").css({overflow:'hidden'});}});t.val('');}
else
{kernelSys.launchMsg(0,data.text,$("#msgHolder"));}});});$("#commentForm").follow('submit',function(e)
{e.preventDefault();var commentText=$(this).children('textarea').val();var url=kernelSys.URLToArray(window.location.href);var t=$(this).children('textarea');if(url['id']!==undefined&&url['id']!==null)
{postSys.addComment(commentText,parseInt(url['id']),function(data)
{if(data.success==false)
{kernelSys.launchMsg(0,data.text,$("#msgHolder"));}
else
{var params=kernelSys.URLToArray(window.location.href);postSys.getComments(params['id'],$(".comments"),$("#commentNum"),function(data)
{if(data!=="<b>No comments to show</b>")
kernelSys.launchMsg(0,data,$(".comments"));else
$(".comments").append($("<center>"+data+"</center>"));});}
t.val('');});}
else
{kernelSys.launchMsg(0,'The post ID is not valid',$("#msgHolder"));}});$(".likeLink").follow('click',function(e)
{e.preventDefault();postSys.likePost($(this).attr('data-postID'),$(this),function(data)
{kernelSys.popUp("Error",data);});});$("a").follow('click',function(e)
{e.preventDefault();if($(this).attr('data-action')=="userActionLogout")
{accountSys.logOut(function(success,text)
{if(success==true)
{window.location.href='login.php';}});}});var lastPg=null;window.addEventListener('popstate',function(event)
{var pathName=document.location.pathname.substring(document.location.pathname.lastIndexOf('/')+1);var params=window.location.search;kernelSys.loadPage(pathName+params,function(data)
{window.pageContainer.html(data);});});$(".hidePost").follow('click',function()
{var ts=$(this);$.ajax({url:window.actionPath+'hidePost.php',data:{postid:ts.attr('data-postid')},method:'POST',dataType:'json'}).fail(function(data)
{kernelSys.popUp("Network Error","Could not hide this post");}).done(function(data)
{if(data.success==true)
ts.parent().parent().parent().remove();else
kernelSys.popUp("Could not hide this post",data.text);});});$(".notification").follow('click',function()
{var ts=$(this);$.ajax({url:window.actionPath+'sawNotif.php',data:{notifid:ts.attr('data-notif-id')},method:'POST',dataType:'json'}).fail(function(data)
{kernelSys.popUp("Network Error","Could not modify the notification");}).done(function(data)
{if(data.success!=true)
{kernelSys.popUp("Could not hide modify the notification",data.text);}});});var showingHambNav=0;$("#userHamb").follow('click',function()
{if(showingHambNav==0)
{$(".userHambNav").show(500);showingHambNav=1;}
else
{showingHambNav=0;$(".userHambNav").hide(500);}});var lastNotif=0;setInterval(function()
{if($(".notifNums").length>0)
{$.ajax({url:window.actionPath+'getNotifNum.php',dataType:'json',method:'GET'}).fail(function(data)
{}).done(function(data)
{if(data.success==true)
{$(".notifNums").text(data.text);if(lastNotif!=data.text)
{$(".notifNum").animate({padding:'+=10px'},500,function()
{$(".notifNum").animate({padding:'-=10px'},500);});lastNotif=data.text;}}});}},1000);setInterval(function()
{if($(".notifNum").length>0)
{var p=$("#notifSign").position();$(".notifNum").css({left:p.left+37,top:p.top+10});}},300);});