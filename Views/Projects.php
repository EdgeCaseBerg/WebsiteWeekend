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

function removeAtom($url){
	//Removes the rss bit from a github url of the form:
	//http://github.com/Username/RepoName/commits/master.atom
	//And returns one of http://github.com/Username/RepoName/
	$boom = explode('commits',$url);
	return $boom[0];
	//Quick and dirty
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
			&nbsp; &nbsp; &nbsp;<span class="firstLetter">T</span>he 
			CS Crew prides itself on providing a place where students can work on projects and gain experience
			that they wouldn't get in the classroom. Our lab's whiteboards are full of design ideas and the scribblings
			of mad-scientists-to-be's. 
		</p>
		<p>
			&nbsp; &nbsp; &nbsp;At any given time there are dozens of CS-Crew projects
			in progress. Click on a project see a description and any contact information the
			students involved have provided.
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
		  						<td class="desc" rel="<?= $project['description'];  ?>"><?= $project['projName']; ?></td>
		  						<td><a href="<?= removeAtom($project['url']); ?>">Webpage/Repository</td>
		  						<td><?= $project['status']; ?></td>
		  					</tr>
		  				<?
		  				if(preg_match('/github/', $project['url']) && preg_match('/atom/', $project['url'])){
		  					//We have a git hub url here, so lets pull it's latest commit
		  					//Show the last time updated, and some of the commit and make it a link to the commit
		  					$fh = file_get_contents($project['url'], 'r');
		  					$xmlObj = simplexml_load_string($fh);				
		  					echo '<td><em>Last Updated:</em><br/>' . githubDateFormat($xmlObj->updated[0]) . '</td>';
		  					echo '<td colspan="3"><em>Commit Message:</em><br />'.$xmlObj->entry[0]->title.'</td>';
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

<script>
	$('.desc').bind('click',function(){
		if ($('#lightbox').length > 0) { // #lightbox exists
	    	//insert img tag with clicked link's href as src value
	    	$('#content').html($(this).attr('rel'));
	    	//show lightbox window - you can use a transition here if you want, i.e. .show('fast')
	    	$('#lightbox').show();
		}else{
			//#lightbox does not exist
    		//create HTML markup for lightbox window
    		//Styling is inline because it wont apply from the less for some reason
    		var lightbox =
    			'<div id="lightbox" class="ethanBox" style="z-index: 500; text-align: center; background:rgba(255,255,255,.7); top: 0; position: absolute;  left: 0; padding-top: 15%; display: block; width:100%; height: 100%;">' +
        			'<p style="z-index: 500; background: #000; width: 600px; margin: 0 auto; color: #fff;">Click to close</p>' +
        			'<div id="content" class="ethanBox" style="z-index: 500; width: 600px; margin: 0 auto; background: #fff; border: 1px solid #ccc; padding: 25px; border-radius:0 0 5px 5px; -moz-border-radius:0 0 5px 5px; -webkit-border-radius: 0 0 5px 5px; box-shadow:0 0 5px #ccc; -moz-box-shadow:0 0 5px #ccc; -webkit-box-shadow:0 0 5px #ccc;">' + //insert clicked link's href into img src
            			$(this).attr('rel');
        			'</div>' +
    			'</div>';
    			//insert lightbox HTML into page
    			$('body').append(lightbox);
		}
	});
	//Click to 
	$('#lightbox').live('click', function() {
    	$('#lightbox').hide();
	});
</script>