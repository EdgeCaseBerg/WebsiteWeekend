<?php
// page to reset a user's password
?>
<div class="loginContain">
	<form action="<? echo BASEDIR; ?>User/?completeResetPassword=yes" method="post">
		<ul>
<?
	// verify that the hash and email match a row (this is in case someone tried to manuall go here)
	$userHash = $this->vars['lostEmailHash'];
	$email = $this->vars['lostEmail'];
	$array = array(
		'tableName'=>'userAccounts',
		'fldEmail'=>$email,
		'fldLostPasswordHash'=>$userHash
	);

	$dbWrapper = new InteractDB('select', $array);
	if (count($dbWrapper->returnedRows) == 1){
		echo "<input type='hidden' value='".$email."' name='validEmail'>";
		echo "<input type='hidden' value='".$userHash."' name='lostEmailHash'>";
	}else{
		header("location: ".BASEDIR."Default/"); 
		exit;
	}
?>
			<li class="error">
				<? if(isset($_SESSION['notifications'])){
						echo "<b>".$_SESSION['notifications']."</b>";
					}
				?>
			</li>
			<li><b>New Password</b></li>
			<li><input type="text" name="fldPassword" class="textInput"></li>
			<li><b>Re-enter New Password</b></li>
			<li><input type="text" name="fldPasswordValid" class="textInput"></li>

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

			<li style="margin-top:10px;"><input type="submit" value="submit" class="submitButton" disabled><input type="button" value="clear" class="submitButton"></li>
		</ul>
	</form>

</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input").keyup(function(){
		if(($("input[name='fldPassword']").val() == $("input[name='fldPasswordValid']").val()) && $("input[name='fldPasswordValid']").val().length > 6){
			$("input[name='fldPassword']").css("background-color", "#BCF7C5");
			$("input[name='fldPasswordValid']").css("background-color", "#BCF7C5");
			$('.submitButton').attr("disabled", false);
		}else{
			$("input[name='fldPassword']").css("background-color", "#F7BCC9");
			$("input[name='fldPasswordValid']").css("background-color", "#F7BCC9");
		}
	});

	$('.clearButton').click(function(){
		$("input[type='text']").each(function(){
			$(this).val("");
		});
		$("input[type='password']").each(function(){
			$(this).val("");
		});
	});
});
</script>