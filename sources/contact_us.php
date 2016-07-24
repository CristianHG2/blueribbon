<div class="bContainer">
    <h2>Contact us</h2><br><br>

    <div id="msgHolder"></div><br><br>

    <form action="#" method="POST" id="contactusForm" style="float: left; width: 80%">

	    <label><b>Your name:</b></label><br><br>
	    <input class="input_field" style="width: 60%; margin-bottom: 2%;" id="name"><br>

	    <label><b>Your email:</b></label><br><br>
	    <input class="input_field" style="width: 60%; margin-bottom: 2%;" id="email"><br>

	    <label><b>Subject:</b></label><br><br>
	    <input class="input_field" style="width: 60%; margin-bottom: 2%;" id="subject"><br>

	    <label><b>How can we help you?</b></label><br><br>
	    <textarea class="input_field" id="msg" style="width: 60%; height: 200px;"></textarea><br>

	    <button class="input_field" type="submit" style="margin-bottom: 0;">Submit</button>
   	</form>

   	<div style="float: right;">
   	<b>Members of the team:</b><br><br>

   	Jacob West - <b>01-0030-0110</b><br>
   	Daniel Ogawa - <b>01-0030-0020</b><br>
   	Chris Richards - <b>01-0030-0060</b><br>
   	Cristian Herrera - <b>01-0030-0046</b><br>
   	</div>

   	<script>
   		$("#contactusForm").submit(function(e)
   		{
   			e.preventDefault();

   			$.ajax({
   				url : window.actionPath + 'contact.php',
   				data : { name : $("#name").val(), email : $("#email").val(), subject : $("#subject").val(), msg : $("#msg").val() },
   				method : 'POST',
   				dataType : 'json'
   			})
   			.fail(function(data)
   			{
   				kernelSys.popUp('Network error', 'Could not perform your contact request');
   			})
   			.done(function(data)
   			{
   				console.log(data);
   				if ( data.success == false )
   				{
   					kernelSys.launchMsg(0, data.text, $("#msgHolder"));
   				}
   				else
   				{
   					kernelSys.launchMsg(2, data.text, $("#msgHolder"));
   				}
   			});
   		});
   	</script>
</div>