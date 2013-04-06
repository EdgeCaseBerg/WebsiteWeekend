<?php
if(isset($_SESSION['notifications'])){
	echo $_SESSION['notifications'];
}
?>

<form action="<? echo BASEDIR; ?>User/?doLogin=yes" method="post">
	<ul>
		<li><input type="text" name="fldUsername"></li>
		<li><input type="text" name="fldPassword"></li>
		<li><input type="submit" value="submit"></li>
	</ul>
</form>


</html>