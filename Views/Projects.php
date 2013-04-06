<?php
require_once "topBar.php";
?>


<script type="text/javascript">
$('.projectsLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.projectsLink').find('.utf8');
$thisUTF8.addClass("utf8Active");

</script>


<ul class="projects">


	<li class="col1">
		<p>
			&nbsp; &nbsp; &nbsp;<span class="firstLetter">I</span> 
			can grab the feed off of github, so that we never have to update
			the table, all we have to do is add projects to github, 
			and they'll automaticly populate here.
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
		    <tr class="projectRow">
		      <td>josh</td>
		      <td>some game</td>
		      <td>http://</td>
		      <td>Active</td>
		    </tr>
		    <tr>
		      <td>Ethan</td>
		      <td>Pro-shit</td>
		      <td>http://</td>
		      <td>Complete</td>
		    </tr>
		  </tbody>
		</table>
	</li>

</ul>
