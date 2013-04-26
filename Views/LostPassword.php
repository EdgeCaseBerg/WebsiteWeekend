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
			<li style="margin-top:10px;"><input type="submit" value="submit" class="submitButton"><input type="button" value="clear" class="submitButton"></li>
		</ul>
	</form>

</div>

<?
if(isset($_SESSION['notifications'])){
	$_SESSION['notifications'] = "";
}