<?php
require_once "topBar.php";

$none = false;
if(!isset($this->vars['members'])){
	//No active members Members?? 
	$none = true;
}

?>

<script type="text/javascript">
$('.membersLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.membersLink').find('.utf8');
$thisUTF8.addClass("utf8Active");
</script>


	<div class="membersContainer">
		<div class="contentHeader"><!--[if !IE]> -->&#10094;<!-- <![endif]-->Members<!--[if !IE]> -->&#10095;<!-- <![endif]--></div>

		<p>
			Members of the CS Crew
		</p>

		<div class="row-fluid text-center">
		    <?php
		    	if($none){
		    		echo '<div class="span1">No Currently Active Members</div>';
		    	}else{
		    		foreach ($this->vars['members'] as $member) {
			    		echo '<div class="span2">';
			    			if($member['image'] != ""){
			    				echo '<img src="'. BASEDIR . 'Views/images/profile_images/' . $member['image'] .'">'	;
			    			}else{
			    				echo '<img src="'. BASEDIR . 'Views/profilePics/noprofile.png">'	;
			    			}
			    			echo "</br><span>".$member['fname']." ". $member['lname']."</span><br />";
			    			echo '<a href="mailto:'.$member['email'].'">Contact ' . $member['fname'] . '</a><br />';
			    			if($member['url']!=''){
			    				echo '<a href="' . $member['url'] . '" >Personal Website</a><br />';	    			
			    			}
			    		echo '</div>';
		    		}	
		    	}
		    ?>
		</div>
</div>