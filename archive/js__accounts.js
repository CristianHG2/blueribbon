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

function accountSystem()
{
	// Internal function caller

	var accountSelf = this;

	// Functions
	
	this.signUp = function(fData, callBack, msgHolder)
	{
		$.ajax({
			url : window.actionPath + 'signup.php',
			cache : false,
			contentType : false,
			processData : false,
			data : fData,
			dataType : 'json',
			type : 'POST'
		})
		.fail(function(data)
		{
			console.log(data);
			kernelSys.popUp("Network Error", "Could not process your sign up, please try again later");
		})
		.done(function(data)
		{
			if ( data.success == true )
			{
				callBack();
			}
			else
			{
				kernelSys.launchMsg(0, data.text, msgHolder);
			}
		});
	}

	this.logIn = function(userVal, passwordVal, callBack, msgHolder)
	{
		$.ajax({
			url : window.actionPath + 'login.php',
			data : { email : userVal, pswd : passwordVal },
			type : 'POST',
			dataType : 'json'
		})
		.fail(function(data)
		{
			kernelSys.popUp("Network Error", "Could not sign you in, please try again later");
		})
		.done(function(data)
		{
			if ( data.success == true )
			{
				callBack();
			}
			else
			{
				kernelSys.launchMsg(0, data.text, msgHolder);
			}
		});
	}

	this.logOut = function(callBack)
	{
		$.ajax({
			url : window.actionPath + 'logout.php',
			method : 'POST',
			dataType : 'json'
		})
		.fail(function ( data )
		{
			console.log(data);
			return false;
		})
		.done(function ( data )
		{
			console.log(data);
			callBack(data.success, data.text);
		});
	}

	this.changeInfo = function(info, newvalue, beforeFunc, callBack)
	{
		$.ajax({
			url : window.actionPath + 'changeInfo.php',
			data : { row : info, newVal : newValue },
			method : 'POST',
			before : beforeFunc,
			dataType : 'json'
		})
		.fail(function ( data )
		{
			return false;
		})
		.done(function ( data )
		{
			callBack(data.success, data.text);
		});
	}

	this.changePicture = function(formDOM, beforeFunc, callBack)
	{
		var fd = new FormData(formDOM);

		$.ajax({
		  url: window.actionPath + 'changePicture.php',
		  data: fd,
		  processData: false,
		  contentType: false,
		  type: 'POST',
		  before : beforeFunc,
		  dataType : 'json'
		})
		.fail(function ( data )
		{
			return false;
		})
		.done(function ( data )
		{
			callBack(data.success, data.text);
		});
	}

	this.lostPswd = function(emailVal)
	{
		$.ajax({
			url : window.actionPath + 'lostPswd.php',
			data : { email : emailVal },
			method : 'POST',
			before : beforeFunc,
			dataType : 'json'
		})
		.fail(function ( data )
		{
			return false;
		})
		.done(function ( data )
		{
			callBack(data.success, data.text);
		});
	}

	// Callbacks

	this.remoteLogout = function()
	{
		accountSelf.logOut(function()
		{
			kernelSys.popUp('System error', 'You have been remotely logged out.', 3000);

			setTimeout(function()
			{
				kernelSys.loadPage('index.php');
			}, 3000);
		});
	}

	this.remoteLock = function()
	{
		accountSelf.logOut(function()
		{
			kernelSys.popUp('System error', 'Your account has been remotely locked.', 3000);

			setTimeout(function()
			{
				kernelSys.loadPage('index.php');
			}, 3000);
		});
	}

	this.accountShutdown = function(executer, reason)
	{
		accountSelf.logOut(function()
		{
			kernelSys.popUp('System error', 'Your account has been shut down by ' + executer + ' due to ' + reason, 3000);

			setTimeout(function()
			{
				kernelSys.loadPage('index.php');
			}, 3000);
		});
	}	
};