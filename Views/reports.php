<?php
require_once "topBar.php";
?>
<div class="reports">

	<div>
		<h1>Faculty Reports</h1>
		<p>
			Use the links below to navigate to a report.
		</p>
	</div>

	<div class="row-fluid">
		<div class="span3 block">
			<div>
				<a href=<?= "'".BASEDIR."Usagedata/?data=purposeBar"."'";?>>Bar Graphs</a>
				<p>
					See the Room usage by purpose.
				</p>
			</div>
		</div>
		<div class="span3 block">
			<div>
				<a href=<?= "'".BASEDIR."Usagedata/?data=visitsOverTime"."'";?>>Line Graphs</a>
				<p>	
					See the Room's  visits over time.
				</p>
			</div>
		</div>
	</div>

	<div class="spacing"></div>
</div>