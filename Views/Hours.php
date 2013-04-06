<?php
require_once "topBar.php";
?>

<div class="hoursPage">

	<h3>Volunteer Help Hours*</h3>

	<hr>

	<p>
		Having trouble with a problem? Need some computer related advice? 
		Want to get involved with a project? Come check out room 332 with 
		the Computer Science Crew (CSCrew).
	</p>

	<p>
		Please check back often. Hours may change on a weekly basis.
	</p>

	<p class="note">
		*Volunteers are students just like you, we don't know everything but we'll do out best to help!
	</p>

	<div class="hours">
		<div class="search">
			<form>
				Expertise Search:
				<select name="expertise">
					<option>Show all</option>
					<?php
						foreach ($this->vars['languages'] as $pkID => $language) {
							echo "<option value=\"".$language['pkID']."\" >";
							echo $language['language'];
							echo "</option>";
						}
					?>
				</select>
				<input type="submit" value="Search"/> 
			</form>
		</div> 

	
		<table>
			<thead>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
			</thead>
			<tbody>
				<?php
				$maxDepth = 0;
				$days = array('Mon','Tues','Wednes','Thurs','Fri');
				$hours = array(	'Mon'=>array(),
								'Tues'=>array(),
								'Wednesday'=>array(),
								'Thurs'=>array(),
								'Fri'=>array()
							  );
				foreach ($this->vars['hours'] as $member) {
					//Add this member to the correct day
					$hours[$member['day']][] = $member;
					//Figure out the maximal depth of the subarrays
					if(count($hours[$member['day']]) > $maxDepth){
						$maxDepth = count($hours[$member['day']]);
					}
				}
				for ($i=0; $i < $maxDepth; $i++) { 
					echo "<tr class=\"" . $i%2==0 ? 'alt' : '' ."\">";
					foreach ($hours as $day => $hoursOnDay) {
						
					}
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
	</div>

	<?php
		print_r($this->vars['hours'],true);
	?>

</div>

<?php
require_once "footer.php";
?>