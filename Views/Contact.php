<?php
require_once "topBar.php";
?>

<script type="text/javascript">
$('.contactLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.contactLink').find('.utf8');
$thisUTF8.addClass("utf8Active");
</script>

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
				<input type="text" size="20">
			</li>
			<li>
				<span>Your Email Address:</span>
			</li>
			<li>
				<input type="text" size="20">
			</li>
			<li>
				<textarea cols="20" rows="7"></textarea>
			</li>

			<li>
				<input type="button" class="button" value="send it!">
			</li>
		</ul>
	</li>
</ul>