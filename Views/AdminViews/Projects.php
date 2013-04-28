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
			<form action="<?= BASEDIR ?>Admin/?projects=new" method="POST">
				<fieldset class="addProj">
					<legend>Add a new Project</legend>
					<label for="Team">Team Name:<input type="text" name="team" /></label>
					<label for="Project">Project Name:<input type="text" name="projName" /></label>
					<label for="url">URL:<input type="text" name="url" /></label>
					<label for="status">Status:<input type="text" name="status" /></label>
					<label for="description">Description: <textarea name="description"></textarea></label>
					<input type="submit" value="Create new Project">
				</fieldset>
			</form>
		</p>
	</li>

	<li class="col2">
		<div class="contentHeader"><!--[if !IE]> -->&#10094;<!-- <![endif]-->Projects<!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
		<h3>Click to edit a field</h3><h4 id="response"></h4>
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
		  		echo '<tr><td colspan="4" style="text-align: center;">No current Projects. why not add some?</td></tr>';
		  	}else{
		  		if(count($this->vars['projects']) != 0 ){
		  			//No projects
		  			foreach ($this->vars['projects'] as $project) {
		  				?>
		  					<tr class="projectRow" rel="<?=$project['pkID']; ?>">
		  						<td rel="<?=$project['pkID']; ?>" class="edit" field="team" ><?= $project['team']; ?></td>
		  						<td rel="<?=$project['pkID']; ?>" class="edit" field="projName"><?= $project['projName']; ?></td>
		  						<td rel="<?=$project['pkID']; ?>" class="edit" field="url"><?= $project['url']; ?></td>
		  						<td rel="<?=$project['pkID']; ?>" class="edit" field="status"><?= $project['status']; ?></td>
		  						<td><a href="" onclick="return false;" class="delete" rel="<?=$project['pkID']; ?>" >Delete</a></td>
		  					</tr>
		  					<tr class="projectRow" rel="<?=$project['pkID']; ?>" >
		  						<td colspan="5" rel="<?=$project['pkID']; ?>" field="description" class="edit"><?= $project['description'] ?></td>
		  					</tr>
		  				<?
		  			}
		  		}else{
		  			echo '<tr><td colspan="4" style="text-align: center;">No current Projects. Why not add some?</td></tr>';
		  		}
		  	}
		  	

		    ?>
		  </tbody>
		</table>
	</li>

</ul>

<script>
	//Delete link operations:
	$('.delete').bind('click',function(){
		var id = $(this).attr('rel');
		$.ajax({
			url: '<?= BASEDIR ?>Admin/?projects=delete',
			type: "POST",
			data: "id="+id+"&output=json",
			success: function(data){
				console.log(data);
				if(data.success){
					$('#response').html('Deleted Project Successfully');
					//Remove the old project from view 
					$('tr[rel='+id+']').hide();
				}else{
					$('#response').html('Issue deleting project');
				}
			}
		});
	});
	//Bind the td with a click so we can click to edit
	$('td.edit').click(function(){  
  
 		$('.ajax').html($('.ajax input').val());  
 		$('.ajax').removeClass('ajax');  
  
 		$(this).addClass('ajax');  
 		$(this).html(' <input id="editbox" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '">');  
  
		$('#editbox').focus();
	} );  
	//Ajax call on enter
	$('td.edit').keydown(function(event){  
    	if(event.which == 13){  
    		//We use the field to determine what we're updating and pass it's value along
      		$.ajax({    type: "POST",  
      					url:"<?= BASEDIR ?>Admin/?projects=edit",  
      					data: "id="+$('.ajax').attr('rel')+"&"+$(this).attr('field')+"=" +$('.ajax input').val()+"&field="+$(this).attr('field'),
      					success: function(data){  
      						
      						console.log(data);
      						$('.ajax').html($('.ajax input').val());  
        					$('.ajax').removeClass('ajax');  
      						
       		}});  
    	}  
	    //Remove input box if they click outside of it
	    $('#editbox').live('blur',function(){  
	        $('.ajax').html($('.ajax input').val());  
	        $('.ajax').removeClass('ajax');  
		});
	});  
	//Remove input box if they click outside of it
	$('#editbox').live('blur',function(){  
	    $('.ajax').html($('.ajax input').val());  
	    $('.ajax').removeClass('ajax');  
	});
	
</script>