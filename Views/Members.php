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
			If you'd like to contact a member of CS Crew, you can come to our lab in Votey 332 or <a href="<?=BASEDIR ?>Default/?page=contact">Contact Us</a>.
			If you know which member you'd like to contact, you can find active member's contact information below.
		</p>

		<div class="">
		    <?php
		    	if($none){
		    		echo '<div class="span1">No Currently Active Members</div></div>';
		    	}else{
		    		$i=0;
		    		echo '<div class="row">';
		    		foreach ($this->vars['members'] as $member) {
			    		echo '<div class="span3">';
			    			echo '<a href="'. BASEDIR . 'User/?showUserProfile='. $member['profLink'] . '">';
			    			if($member['image'] != ""){
			    				echo '<img width="200" src="'. BASEDIR . 'Views/images/profile_images/' . $member['image'] .'">'	;
			    			}else{
			    				echo '<img width="200" height = "200" src="'. BASEDIR . 'Views/profilePics/noprofile.png">'	;
			    			}
			    			echo '</a>';
			    			echo "</br><span>".$member['fname']." ". $member['lname']."</span><br />";
			    			echo '<a href="mailto:'.$member['email'].'">Contact ' . $member['fname'] . '</a><br />';
			    			if($member['url']!=''){
			    				echo '<a href="' . $member['url'] . '" >Personal Website</a><br />';	    			
			    			}
			    		echo '</div>';
			    		$i=$i+1;
			    		if($i % 4 == 0){
			    			echo '</div>';
			    			echo '<div class="row">';
			    		}

		    		}	
		    		echo '</div>';
		    		
		    	}
		    ?>
		</div>
		<div class="spacing"></div>
</div>
