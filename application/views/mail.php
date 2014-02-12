<style type="text/css">
	.container {
		width : 980;
		margin: 20px auto;
	}
</style>

<div class="container">
	<table class="table table-striped">
  		<caption><h2>Basic Details of Patients</h2></caption>
  		<thead>
    		<tr>
      			<th>Id</th>
      			<th>Name</th>
      			<th>Mobile</th>
      			<th>Email</th>
      			<th>DOB</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($patients as $key=>$patient ) : ?> 
		    <tr>
		      <td> <input type="checkbox" class="checkbox" value="<?php echo $patient['email'] ?>"> </td>
		      <td> <?php echo $patient['name'] ?> </td>
		      <td> <?php echo $patient['mobile'] ?> </td>
		      <td> <?php echo $patient['email'] ?> </td>
		      <td> <?php echo $patient['dob'] ?> </td>
		    </tr>
		    <?php endforeach; ?>
  		</tbody>
	</table>

	<p class="lead">Please Tick the above checkboxes to select the patients you want to email. Enter the email text below </p>

	<form class="form-horizontal mail">
  		<div class="control-group">
    		<label class="control-label" for="subject">Subject</label>
    		<div class="controls">
      			<input type="text" class="subject" placeholder="subject" style="width:300px;">
    		</div>
  		</div>
  		<div class="control-group">
	    	<label class="control-label" for="inputPassword">Text</label>
	    	<div class="controls">
	      		<textarea rows="10" cols="100" placeholder = "Type the text here" class="mailText"></textarea>
	    	</div>
  		</div>
  		<div class="control-group">
    		<div class="controls">
      			<button class="btn btn-primary send_mail_btn">Send Mails</button>
    		</div>
  		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.mail .send_mail_btn').click(function(){
			var emails = [];
			$('.table .checkbox').each(function(){
				if($(this).prop('checked')){
					var email = $(this).val();
					if(email == ""){
						alert('Please don\'t choose the patients who dont have email ids');
						return false;
					}
					emails.push(email);
				}
			})
			var text = $('.mailText').val();
			if(text == ""){
				alert("Please enter some text to send mails");
				return false;
			}
			var subject = $('.subject').val();
			if(subject == ""){
				alert("Please enter some subject to send mails");
				return false;	
			}
			console.log(emails);
			$.ajax({
	            type: "POST",
	            url: '/mail/send_mail',
	            data: {'users' : emails, 'text' : text, 'subject' : subject},
	            success: function(resp){
	              if(resp.status == "success")
	              	alert("Successfully sent the mails");
	            },
	            dataType: "json"
          	});
			return false;
		})
	})
</script>
