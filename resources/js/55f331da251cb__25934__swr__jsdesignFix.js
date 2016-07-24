
(function($){if($.fn.style){return;}
var escape=function(text){return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&");};var isStyleFuncSupported=!!CSSStyleDeclaration.prototype.getPropertyValue;if(!isStyleFuncSupported){CSSStyleDeclaration.prototype.getPropertyValue=function(a){return this.getAttribute(a);};CSSStyleDeclaration.prototype.setProperty=function(styleName,value,priority){this.setAttribute(styleName,value);var priority=typeof priority!='undefined'?priority:'';if(priority!=''){var rule=new RegExp(escape(styleName)+'\\s*:\\s*'+escape(value)+'(\\s*;)?','gmi');this.cssText=this.cssText.replace(rule,styleName+': '+value+' !'+priority+';');}};CSSStyleDeclaration.prototype.removeProperty=function(a){return this.removeAttribute(a);};CSSStyleDeclaration.prototype.getPropertyPriority=function(styleName){var rule=new RegExp(escape(styleName)+'\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?','gmi');return rule.test(this.cssText)?'important':'';}}
$.fn.style=function(styleName,value,priority){var node=this.get(0);if(typeof node=='undefined'){return this;}
var style=this.get(0).style;if(typeof styleName!='undefined'){if(typeof value!='undefined'){priority=typeof priority!='undefined'?priority:'';style.setProperty(styleName,value,priority);return this;}else{return style.getPropertyValue(styleName);}}else{return style;}};})(jQuery);var containerInt;function mobileFix()
{var w=$(window).width();if($(".fixedButtons").length>0)
{$("footer").css({'margin-bottom':$("footer").height()+50});}
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||w<1050)
{if($(".indexContainer").length>0)
{$("nav .links").hide();$(".hamb").show();$("#siteTitle").css({'float':'none','padding-left':'0px','position':'relative'});$("nav .links a").css({'display':'block','float':'none','padding-top':'5px','padding-right':'0px','margin-right':'0px','padding-bottom':'5px','margin-top':'5px','background-color':'rgba(255, 255, 255, .3)','padding-right':'0px'});$("nav .links").css({'margin-bottom':'5px'});}
if($(".splashPage").length>0)
{$(".column").css({'text-align':'center','width':'100vw'});$(".splashLogin").css({'width':'100%','margin-top':'20%'});$("#siteTitle").style('font-size','50px','important');$("#loginTitle").style('font-size','30px','important');$("#signupTitle").style('font-size','30px','important');$("input").attr('size','');$("#signupColumn").children('div').css({'margin-top':'14%','margin-bottom':'4%'});}
if($(".postContainer").length>0)
{$(".container").css('padding-bottom',$("footer").height()+10);if($(".userPage2").length>0)
{$(".userPage2").children('.img').hide();$(".userPage2").children('.userinfo').css({'width':'100%','float':'none','position':'inherit'});}
$(".container").css({'margin':'0px','width':'100vw'});$("#postForm, #commentForm").children('textarea').css({'height':'20%','font-size':'30px'});$("#postForm, #commentForm").children('div').children('button').css({'font-size':'15px'});$(".post, .singlePost").children('.message').addClass('mobile');$('.post, .singlePost').children('.message').css({'font-size':'18px','margin-right':'0'});$('.post, .singlePost').children('.message').children('.links').css({'font-size':'13px'});$("header").css({'padding':'20px 0 20px 0'});$("header").children('.items').hide();$("header").children(".logoHead").css({'float':'none','display':'inline'});$("header").children(".hamb").show();$("header").children(".logoHead").children('span').css({'font-size':'60px'});$(".comments").css({'font-size':'13px'});$("header").css({'text-align':'center'});}}
else
{if($("#indexCont").length>0)
{$("nav .links").show();$(".hamb").hide();$("#siteTitle").css({'float':'','padding-left':'','position':''});$("nav .links a").css({'display':'inline','float':'right','padding':'50px','padding-bottom':'','margin-top':'','padding-right':'','margin-right':'5px','background-color':''});$("nav .links").css({'margin-right':'5px'});}
if($(".splashPage").length>0)
{$(".right").css({'text-align':'right','width':'40%'});$(".left").css({'text-align':'left','width':'40%'});$(".splashLogin").css({'width':'70%','margin-top':''});$("#signupColumn").children('div').css({'margin-top':'','margin-bottom':'4%'});}
if($(".postContainer").length>0)
{if($(".userPage2").length>0)
{$(".userPage2").children('.img').show();$(".userPage2").children('.userinfo').css({'width':'45vw','float':'left','position':'relative'});}
$(".userHambNav").hide();$("header").children(".hamb").hide();$(".container").css('padding-bottom',$("footer").height()+10);$(".container").css({'margin':'0% 8% 0% 13.5%','width':'71vw'});$("#postForm, #commentForm").children('textarea').css({'height':'5vw','font-size':''});$(".post, .singlePost").children('.message').removeClass('mobile');$("#postForm, #commentForm").children('div').children('button').css({'font-size':''});$('.post, .singlePost').children('.message').css({'font-size':'18px','margin-right':'3%'});$('.post, .singlePost').children('.message').children('.links').css({'font-size':'10px'});$("header").css({'padding':'35px 20px 35px 20px'})
$("header").children('.items').show();$("header").children(".logoHead").css({'float':'left'});$("header").children(".logoHead").children('span').css({'font-size':''});$(".comments").css({'font-size':'13px'});$("header").css({'text-align':''});}}}
$(document).ready(function()
{mobileFix();if($(".fixedButtons").length>0)
{$("#indexCont").css('margin-bottom',$(".fixedButtons").height()+10);}
var isClicked=false;if($(".postContainer").length>0)
{setInterval(function()
{mobileFix();},200);}
$(".hamb").click(function()
{if(!isClicked)
{$("nav .links").show(500);isClicked=true;}
else
{$("nav .links").hide(500);isClicked=false;}});});$(window).resize(mobileFix);