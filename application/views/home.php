<style type="text/css">
	.container {
		width : 980;
		margin: 20px auto;
	}
</style>



<div id="container">
	<?php if(!count($emails)): ?>
		<h1><?php echo $user ?> have not sent any emails, click on Mail Button to send emails</h1>
	<?php else:  ?>
		<?php echo json_encode($emails) ?>
	<?php endif; ?>
	<div id="body">
		<p>page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>