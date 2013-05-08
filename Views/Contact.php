<?php
require_once "topBar.php";

//If we just posted we should go ahead and mail people
//Right now since contact doesn't really deserve it's own module
//We'll ignore the framework and just do this
if(isset($_POST['submit'])){
	if($_POST['submit']){
		$to ="uvm.cscrew@gmail.com";
		//Trim the last comma
		// $to = substr($to, 0,-1);
		$subject = "CS Crew Contact Form";
		$body = "From: " . $_POST['name'] . ' (' . $_POST['from'] . ')\n\n';
		$body .= $_POST['body'];
		$success = false;
		if(mail($to, $subject, $body)){
			$success = true;
			?>
			<script>
			$(document).ready(function(){
				$('.contactCover').css("display" : "block");
				$('#notifier').text("Someone will be contacting you shortly");
			});
			</script>
			<?
		}else{
			?>
			<script>
			$(document).ready(function(){
				$('.contactCover').css("display" : "block");
				$('#notifier').text('Your message was not sent, something must have gone wrong. Email us at cscrew@uvm.edu or uvm.cscrew@gmail.com!');
			});
			</script>
			<?
		}
	}
}

?>

<script type="text/javascript">
$(document).ready(function(){
	$('.contactLink').css({'color' : '#00774B'});
	var $thisUTF8 = $('a.contactLink').find('.utf8');
	$thisUTF8.addClass("utf8Active");
	$('#closeContactCover').click(function(){
		$('.contactCover').hide();
	})
});
</script>
<form action="<? echo BASEDIR;?>Default/?page=contact" method="POST">

	<ul class="contactForm">

		<li class="column col1">
			<ul>
				<li>
					<img id="mailImg" src="<? echo BASEDIR; ?>Views/images/mail2.png" alt="envelope" />
					<h3>Drop us a line.</h3>
					<h4>We'd love to hear from you!</h4>
					
				</li>
			</ul>
		</li>

		<li class="column col2">
			<ul>
				<li>
					<span>Your Name:</span>
				</li>
				<li>
					<input name="name"type="text" size="20">
				</li>
				<li>
					<span>Your Email Address:</span>
				</li>
				<li>
					<input name="from" type="text" size="20">
				</li>
				<li>
					<textarea name="body" cols="20" rows="7"></textarea>
				</li>

				<li>
					<input name="submit" type="submit" class="button" value="send it!">
				</li>
			</ul>
		</li>
	</ul>

</form>

<div class="contactCover">
	<div class="contactCoverNest">
		<div id="notifier"></div>
		<input type="button" id="closeContactCover">
	</div>
</div>