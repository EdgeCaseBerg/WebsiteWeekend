<?php
?>
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
<div class="loginContain">
	<form action="<? echo BASEDIR; ?>User/?newUser=yes" method="post">
		<ul>
			<li class="error">
				<? if(isset($this->vars['notifications'])){
						echo "<b>".$this->vars['notifications']."</b>";
					}
				?>
			</li>
			<li><b>Desired Userame</b></li>
			<li><input type="text" name="fldUsername" class="textInput" required></li>
			<li><b>Password (must be 7 or more characters)</b></li>
			<li><input type="password" name="fldPassword" class="textInput" required></li>
			<li><b>Re-enter Password</b></li>
			<li><input type="password" name="fldPasswordValid" class="textInput" required></li>
			<li><input type="submit" value="submit" class="submitButton" disabled><input type="button" value="clear" class="submitButton clearButton"></li>
		</ul>
	</form>
</div>