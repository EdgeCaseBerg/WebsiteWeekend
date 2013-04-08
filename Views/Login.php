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
			<li><input type="submit" value="submit" class="submitButton"><input type="button" value="clear" class="submitButton"></li>
		</ul>
	</form>
</div>