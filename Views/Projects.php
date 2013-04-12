<?php
require_once "topBar.php";

function githubDateFormat($date='2013-04-12T17:27:02-07:00'){
	//Split it into two parts
	$pces = explode('T',$date);
	//Reorder the yyyy-mm-dd to mm dd yyyy for 'murica
	$datePiece = explode('-',$pces[0]);
	$timePieces = explode('-',$pces[1]);
	$time = explode(':',$timePieces[0]);
	//Get the day
	$day = date('l',strtotime($pces[0]));
	$month = date('M',strtotime($pces[0]));

	//Reorder and return the date
	return $day .' '.$datePiece[1].', '.$month.' '.$datePiece[0];

}

?>


<script type="text/javascript">
$('.projectsLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.projectsLink').find('.utf8');
$thisUTF8.addClass("utf8Active");

</script>


<ul class="projects">


	<li class="col1">
		<p>
			&nbsp; &nbsp; &nbsp;<span class="firstLetter">We</span> 
			can grab the top github commit from each active project and show them here.
		</p>
		<p>
			&nbsp; &nbsp; &nbsp;At any given time there are dozens of CS-Crew projects
			in progress. Click on a project to view its status
			, to join the project, or to contact the members of the team.
		</p>
	</li>

	<li class="col2">
		<div class="contentHeader"><!--[if !IE]> -->&#10094;<!-- <![endif]-->Projects<!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th>Team</th>
		      <th>Project Name</th>
		      <th>URL</th>
		      <th>Status</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	if(!isset($this->vars['projects'])){
		  		//No Projects set at all... don't know how but it is
		  		echo '<tr><td colspan="4" style="text-align: center;">No current Projects</td></tr>';
		  	}else{
		  		if(count($this->vars['projects']) != 0 ){
		  			//No projects
		  			foreach ($this->vars['projects'] as $project) {
		  				?>
		  					<tr class="projectRow">
		  						<td><?= $project['team']; ?></td>
		  						<td><?= $project['projName']; ?></td>
		  						<td><a href="<?= $project['url']; ?>">Webpage/Repository</td>
		  						<td><?= $project['status']; ?></td>
		  					</tr>
		  				<?
		  				if(preg_match('/github/', $project['url'])){
		  					//We have a git hub url here, so lets pull it's latest commit
		  					//Show the last time updated, and some of the commit and make it a link to the commit
		  					$fh = file_get_contents($project['url'], 'r');
		  					$xmlObj = simplexml_load_string($fh);				
		  					echo '<td><strong>Last Updated:</strong><br/>' . githubDateFormat($xmlObj->updated[0]) . '</td>';
		  					echo '<td colspan="3"><strong>Commit Message:</strong><br />'.$xmlObj->entry[0]->title.'</td>';
		  				}
		  			}
		  		}else{
		  			echo '<tr><td colspan="4" style="text-align: center;">No current Projects</td></tr>';
		  		}
		  	}
		  	

		    ?>
		  </tbody>
		</table>
	</li>

</ul>
