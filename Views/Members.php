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
	<div class="membersContain">
		<div class="contentHeader"><!--[if !IE]> -->&#10094;<!-- <![endif]-->Members<!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
		<div class="row-fluid">
		      <th>Name</th>
		      <th>Year</th>
		      <th>Major</th>
		      <th>Contact Info</th>
		      <th>Website</th>
		    <?php
		    	if($none){
		    		echo '<div class="span1">No Currently Active Members</div>';
		    	}else{
		    		foreach ($this->vars['members'] as $member) {
			    		echo '<div class="span1">';
			    			if($member['image'] != ""){
			    				echo '<img src="'. BASEDIR . 'Views/images/profile_images/' . $member['image'] .'">'	;
			    			}else{
			    				echo '<img src="'. BASEDIR . 'Views/profilePics/noprofile.png">'	;
			    			}
			    			echo "</br><span>".$member['fname']." ". $member['lname']."</span><br />";
			    			echo '<a href="mailto:'.$member['email'].'">Contact ' . $member['fname'] . '</a><br />';
			    			echo '<a href="' . $member['url'] . '" >'.$member['url']. '</a><br />';

			    			
			    			
			    		echo '</div>';
		    		}	
		    	}
		    ?>
		</div>
</div>