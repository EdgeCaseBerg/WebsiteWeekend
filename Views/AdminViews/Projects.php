<?php
require_once "Views/topBar.php";

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
			From this admin page you can add projects using the form below, edit a project's descriptive text, 
			or delete the project itself. If you're using version control to manage the source code, the 
			CS Crew Triumvirate at the time of this CMS's development (Ethan,Scott, and Garth) recommend using
			git and github, and our nice CMS will display your latest commit on the projects page! Simply
			use the base url of http://github.com/UserName/Project/commits/master.atom in the url given and enjoy
		</p>
		<p>
			&nbsp; &nbsp; &nbsp;At any given time there are dozens of CS-Crew projects
			in progress. Click on a project see a description and any contact information the
			students involved have placed into it.
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
		      <th>Delete?</th>
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
		  						<td class="desc" rel="<?= $project['description'];  ?>"><?= $project['projName']; ?></td>
		  						<td><a href="<?= $project['url']; ?>">Webpage/Repository</td>
		  						<td><?= $project['status']; ?></td>
		  						<td><a href="" onclick="return false;" class="delete" rel="<?=$project['pkID']; ?>" >Delete</a></td>
		  					</tr>
		  					<tr class="projectRow">
		  						<td colspan="5"><?= $project['description'] ?></td>
		  					</tr>
		  				<?
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

<script>
	
</script>