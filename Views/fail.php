<?php

?>
<div class="failContainer" style="width:600px; margin:auto; margin-top:100px;">
	<a href=<? echo "'".BASEDIR."Default/'";?>>
		<img style="width:600px" src=<? echo "'".BASEDIR."Views/images/fail.jpg'"; ?>>
	</a>
	<div style="background:white; padding:5px">
		<? 
			if(isset($_SESSION['fail_message'])){
				echo $_SESSION['fail_message'];
			}
		?>
	</div>
</div>