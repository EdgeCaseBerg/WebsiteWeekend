<?php
?>

<div class="loginContain">
	<form action="<? echo BASEDIR; ?>User/?lostPassword=yes" method="post">
		<ul>
			<li class="error">
				<? if(isset($_SESSION['notifications'])){
						echo "<b>".$_SESSION['notifications']."</b>";
					}
				?>
			</li>
			<li><b>Email</b></li>
			<li><input type="text" name="fldEmail" class="textInput"></li>

<li>
 <script type="text/javascript"
     src="http://www.google.com/recaptcha/api/challenge?k=6Leq0N8SAAAAAMy6bnrhxfeZ6iwfxvMt2pfJq5kb">
  </script>
  <noscript>
     <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Leq0N8SAAAAAMy6bnrhxfeZ6iwfxvMt2pfJq5kb"
         height="300" width="500" frameborder="0"></iframe><br>
     <textarea name="recaptcha_challenge_field" rows="3" cols="40">
     </textarea>
     <input type="hidden" name="recaptcha_response_field"
         value="manual_challenge">
  </noscript>
</li>

			<li style="margin-top:10px;"><input type="submit" value="submit" class="submitButton"><input type="button" value="clear" class="submitButton"></li>
		</ul>
	</form>

</div>