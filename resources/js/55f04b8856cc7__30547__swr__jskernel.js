
var lastRequest='';function kernelSystem()
{var kernelSelf=this;this.URLToArray=function(url)
{var request={};var pairs=url.substring(url.indexOf('?')+1).split('&');for(var i=0;i<pairs.length;i++){if(!pairs[i])
continue;var pair=pairs[i].split('=');request[decodeURIComponent(pair[0])]=decodeURIComponent(pair[1]);}
return request;}
this.popUp=function(title,content,time,imm)
{window.boxDom.children("main").html(content);window.boxDom.children("header").html(title);var fadeNum=500;var fadeNum2=250;if(imm==true)
{var fadeNum=0;var fadeNum2=0;}
window.overlayDom.fadeIn(fadeNum,function()
{window.boxDom.fadeIn(fadeNum2);});if(time>0)
{setTimeout(function()
{kernelSelf.hideOverlay();},time);}}
this.hideOverlay=function(imm)
{var fadeNum=500;var fadeNum2=250;if(imm==true)
{var fadeNum=0;var fadeNum2=0;}
window.boxDom.fadeOut(fadeNum,function()
{window.overlayDom.fadeOut(fadeNum2);});}
this.launchMsg=function(type,text,element)
{element.empty();switch(type)
{case 0:if($('.msgbox .error').length)
$('.msgbox .error').remove();var el=$('<center class="msgbox error"></center>');el.html(text);element.append(el);break;case 1:if($('.msgbox .info').length)
$('.msgbox .info').remove();var el=$('<center class="msgbox info"></center>');el.html(text);element.append(el);break;case 2:if($('.msgbox .success').length)
$('.msgbox .success').remove();var el=$('<center class="msgbox success"></center>');el.html(text);element.append(el);break;}}
this.loadPage=function(page,callback,override)
{if(typeof override==="undefined")
override=false;if(page.indexOf('?')>-1)
var pToken='&provideContentToken&secondaryToken';else
var pToken='?provideContentToken&secondaryToken';if(override===true&&page.indexOf('?')>-1)
var pToken='&provideContentToken';else if(override===true)
var pToken='?provideContentToken';$.ajax({before:function()
{window.progressBar.animate({width:'0%'},500);kernelSelf.popUp("Network message","Loading",0,true);},xhr:function()
{kernelSelf.popUp("Network message","Loading",0,true);var xhr=new window.XMLHttpRequest();window.progressBar.animate({width:'8%'},500);xhr.upload.addEventListener("progress",function(evt){if(evt.lengthComputable)
{var percentComplete=evt.loaded/evt.total;window.progressBar.animate({width:percentComplete*100+'%'},500);}},false);xhr.addEventListener("progress",function(evt)
{if(evt.lengthComputable)
{var percentComplete=evt.loaded/evt.total;window.progressBar.animate({width:percentComplete*100+'%'},500);}
else
{window.progressBar.animate({width:'80%'},500);}},false);return xhr;},type:'POST',url:window.siteRL+page+pToken}).fail(function(data)
{console.log(data);kernelSelf.hideOverlay(true);kernelSelf.popUp('Network error','Could not load site page through KernelSys, please check your connection or contact support.');}).done(function(data)
{kernelSelf.hideOverlay(true);window.progressBar.animate({width:'100%'},500);var stateObj={foo:"bar"};history.pushState(stateObj,"Blue Ribbon",page);document.title=$(data).filter('title').text();var data=data.replace(/<title>(.*)<\/title>/g,"");callback(data);});}
this.siteDown=function()
{kernelSelf.loadPage('siteDown.php');}
this.bannedFromSite=function()
{kernelSelf.loadPage('banned.php');}
this.siteNotice=function(title,content)
{kernelSelf.popUp(title,content);}}
window.siteRL='https://theblueribbon.net/';window.actionPath=window.siteRL+'actions/';window.progressBar=$("#loadingBar");window.pageContainer=$("#pageCont");window.resourceFolder=window.siteRL+'resources/';