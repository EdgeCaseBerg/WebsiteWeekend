<?php
require_once "topBar.php";
?>
<div class="miscDiv">
	<ul>
		<li><a href=<?= "'".BASEDIR."Usagedata/?data=purposeBar"."'";?>>Bar Graphs</a></li>
		<li><a href=<?= "'".BASEDIR."Usagedata/?data=visitsOverTime"."'";?>>Line Graphs</a></li>
		<li><a href=<?= "'".BASEDIR."RoomSignIn/"."'";?>>Room Sign In</a></li>
		<li><a href=<?= "'".BASEDIR."Admin/?news=new"."'";?>>Admin New Article</a></li>
		<li><a href=<?= "'".BASEDIR."News/?alStories=true"."'";?>>News Page</a></li>
	</ul>
</div>