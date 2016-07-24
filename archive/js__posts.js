/**
 *
 * Unnamed Project
 * Account system
 *
 * @package Unnamed project
 * @author CSHS Web Team
 * @copyright Public domain
 *
 * This file contains all functions and variables related to the user interface 
 *
 */

// Main declaration

function postSystem()
{
	// Class variables

	this.postContainer = null;
	this.messageTemplate = null;
	this.currentPostNum = 0;
	this.commentTemplate = null;
	this.floatingMenuTpl = null;
	this.notificationTpl = null;

	// Internal function caller
	
	var postSelf = this;

	// Functions
	
	this.setProperty = function(property, value)
	{
		if ( property == "postCont" )
			postSelf.postContainer = value;

		if ( property == "messageTpl" )
			postSelf.messageTemplate = value;

		if ( property == "currNum" )
			postSelf.currentPostNum = value;

		if ( property == "commentTpl" )
			postSelf.commentTemplate = value;

		if ( property == "menuTpl" )
			postSelf.floatingMenuTpl = value;

		if ( property == "notifTpl" )
			postSelf.notificationTpl = value;
	}

	this.fetchPosts = function(failureCallback)
	{

		$.ajax({
			url : window.actionPath + 'getPosts.php',
			type : 'POST',
			before : function() { },
			dataType : 'json',
			data : { post_start : postSelf.currentPostNum }
		})
		.fail(function( data )
		{
			console.log(data);
			kernelSys.popUp('Network Error', 'Failed to fetch posts, please try again later', 5000);
			return false;
		})
		.done(function( data )
		{

			if ( data.success == false )
			{
				failureCallback(data.text);
				return false;
			}

			var put = false;

			for ( var i = 0; i <= data.length - 1; i++ )
			{
				if ( $("#post" + data[i].postID).length <= 0 )
				{
					
					var msg = $(postSelf.messageTemplate);

					//if ( put == false )
						//msg.css({"margin-top" : '0%'});

					var msgDiv = msg.children(".message");
					var linksDiv = msgDiv.children(".links");

					msg.attr('id', 'post' + data[i].postID);

					msg.children(".userPage").attr('data-ajax-href', 'user.php?id=' + data[i].userURL);
					//msg.children(".userPage").attr('href', 'user.php?id=' + data[i].userURL);

					msg.children(".userPage").children("img").attr('src', window.resourceFolder + 'img/userimg/' + data[i].userIMG.replace(/ /g, '%20'));
					msg.children(".userPage").children("img").attr('alt', 'User Image');

					msgDiv.children(".displayname").html(data[i].prefix + ' ' +data[i].userName);

					msgDiv.children(".displayname").attr('data-ajax-href', 'user.php?id=' + data[i].userURL);

					msgDiv.children(".textContent").html(data[i].postCont);

					linksDiv.children(".commentsLink").html(data[i].commentText);
					linksDiv.children(".likeLink").html(data[i].likeText);

					linksDiv.children(".commentsLink").attr('data-ajax-href', 'post.php?id=' + data[i].postID);
					//linksDiv.children(".commentsLink").attr('href', 'post.php?id=' + data[i].postID);

					linksDiv.children(".likeLink").attr('data-postID', data[i].postID);

					postSelf.postContainer.prepend(msg);

					put = true;
				}

				postSelf.currentPostNum += 1;
			}
			
			return true;
		});
	}

	this.addPost = function(contentVal, callback)
	{
		$.ajax({
			url : window.actionPath + 'post.php',
			data : { post : contentVal },
			type : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			console.log(data);
			kernelSys.popUp("Network Error", "Could not process your post");
		})
		.done(function(data)
		{
			callback(data);
		});	
	}

	this.addComment = function(comment, postID, callback)
	{
		$.ajax({
			url : window.actionPath + 'addComment.php',
			data : { text : comment, id : postID },
			type : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			console.log(data);
			kernelSys.popUp("Network Error", "Could not add your comment");
		})
		.done(function(data)
		{
			postSelf.notify(postID);
			callback(data);
		});			
	}

	this.getComments = function(postID, object, likeObj, callback)
	{
		$.ajax({
			url : window.actionPath + 'getComments.php',
			data : { id : parseInt(postID) },
			type : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not retrieve the comments");
		})
		.done(function(data)
		{
			object.empty();

			if ( data.success == true )
			{			
				for ( var i = 0; i <= data.length - 1; i++ )
				{
					var comment = $(postSelf.commentTemplate);
					var inner = comment.children('.innerComment');
					var content = inner.children('.content');

					inner.children('figure').children('img').attr('src', window.resourceFolder + 'img/userimg/' + data[i].userIMG.replace(/ /g, '%20'));
					inner.children('figure').children('img').attr('alt', 'User picture');
					
					content.children('.name').html(data[i].prefix + ' ' + data[i].userName);
					content.children('.name').attr('data-ajax-href', 'user.php?id=' + data[i].user);

					content.children('p').html(data[i].text);

					object.append(comment);
				}

				likeObj.html('Comments (' + data.length + ')');
			}
			else
			{
				callback("<b>" + data.text + "</b>");
			}
		});
	}

	this.likePost = function(postID, likeLink, callback)
	{
		$.ajax({
			url : window.actionPath + 'addLike.php',
			data : { id : parseInt(postID) },
			type : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not retrieve the comments");
		})
		.done(function(data)
		{
			if ( data.success == true )
			{			
				likeLink.html(data.text);
			}
			else
			{
				callback(data.text);
			}
		});
	}

	this.deletePost = function(Pid, callback, holder)
	{
		$.ajax({
			url : window.actionPath + 'deletePost.php',
			data : { id : Pid },
			type : 'POST',
			dataType : 'json',
			method : 'POST'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not delete this post.");
		})
		.done(function(data)
		{
			if ( data.success == true )
			{
				callback();
			}
			else
			{
				kernelSys.launchMsg(0, data.text, holder);
			}
		});		
	}

	this.lockPost = function(Pid, callback, holder)
	{
		$.ajax({
			url : window.actionPath + 'lockPost.php',
			data : { id : Pid },
			type : 'POST',
			dataType : 'json',
			method : 'POST'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not lock/unlock this post, please try again later.");
		})
		.done(function(data)
		{
			if ( data.success == true )
			{
				callback(data.text);
			}
			else
			{
				kernelSys.launchMsg(0, data.text, holder);
			}
		});		
	}

	// Callbacks

	this.overPost = function(dom, overcallback, outcallback)
	{
		var string = dom.parent().attr('id');
		var string2 = string.replace('post', '');

		var post = dom;

		var asterisk = dom.children('.actionLinks').children('a').children('i');
		var pos = asterisk.offset();

		var newMenu = $(postSelf.floatingMenuTpl);

		console.log(string2);

		$.ajax({
			url : window.actionPath + 'getLinks.php',
			data : { id : string2 },
			method : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			console.log(data);

			kernelSys.popUp("Network Error", "Could not retrieve floating menu.");
		})
		.done(function(data)
		{
			console.log(data);

			if ( data.success == true )
				newMenu.children('p').html(data.text);
		});

		newMenu.css({position : 'absolute', top : (pos.top + 30) + 'px', left : (pos.left - 36.5) + 'px'});
		newMenu.attr('id', 'floatingMenu' + dom.parent().attr('id'));

		$("body").append(newMenu);

		$(this).children('.actionLinks').children('.multiaction').css('opacity', '1');
		
		overcallback(dom.parent().attr('id'));

		var string = dom.parent().attr('id');

		newMenu.attr('data-postid', string.replace('post', ''));

		$("#" +'floatingMenu' + dom.parent().attr('id')).follow('mouseleave', function()
		{
			outcallback('floatingMenu' + dom.parent().attr('id'), dom.parent().attr('id'));
		});
	}

	this.leavePost = function(id)
	{
		var id2 = id.parent().attr('id');

		$('#floatingMenu' + id2).remove();
	}

	this.notify = function(post)
	{
		$.ajax({
			url : window.actionPath + 'addNotif.php',
			data : { postid : post },
			method : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			console.log(data);
			kernelSys.popUp("Network Error", "Could not notify the participants");
		})
		.done(function(data)
		{
			console.log(data);
			if ( data.success != true )
			{
				kernelSys.popUp("Network Error", data.text);
			}			
		});		
	}

	this.getNotifications = function(placeHolder, failureCallback)
	{
		$.ajax({
			url : window.actionPath + 'getNotifs.php',
			method : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not retrieve your notifications");
		})
		.done(function(data)
		{

			placeHolder.empty();

			if ( data.success == true )
			{
				for ( var i = 0; i <= data.length - 1; i++ )
				{
					var parsedTpl = $(postSelf.notificationTpl);

					if ( data[i].seen == 1 )
						parsedTpl.addClass('notifSeen');

					parsedTpl.attr('data-ajax-href', data[i].url);

					parsedTpl.attr('data-notif-id', data[i].id);

					parsedTpl.children('div').html(data[i].text);

					placeHolder.prepend(parsedTpl);
				}
			}
			else
				failureCallback(data.text);
		});
	}
}