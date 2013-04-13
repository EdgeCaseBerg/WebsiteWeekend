<?php
?>

<div class="loginContain">
	<form action="<? echo BASEDIR; ?>User/?doLogin=yes" method="post">
		<ul>
			<li class="error">
				<? if(isset($this->vars['notifications'])){
						echo "<b>".$this->vars['notifications']."</b>";
					}
				?>
			</li>
			<li><b>Userame</b></li>
			<li><input type="text" name="fldUsername" class="textInput"></li>
			<li><b>Password</b></li>
			<li><input type="password" name="fldPassword" class="textInput"></li>
			


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