f<?php
/**
* @author Joshua Dickerson at The University of Vermont
*  Profile.php displays the user's profile
**/
require_once "topBar.php";
?>

<script type="text/javascript">
$(document).ready(function(){
	var base= "<?= BASEDIR ?>";
	<?
		if(isset($_GET['showUserProfile'])){
	?>
		
		var query = base+"User/?showUserProfile="+<? echo $_GET['showUserProfile']; ?>+"&output=json";
	<?	}else{ ?>
	// grab our profile data from our model object via AJAX
	var query =base+"User/?getProfile=true&output=json";
	<? } ?>
	$.getJSON(query, function(data) {
		// set our inputs full of data from the DB
		if(data['fldAboutMe']!= "" && typeof data['fldAboutMe'] != "undefined"){
			$('.descripText').text(data['fldAboutMe']);
		}else{
			$('.descripText').text("You haven't added an 'about me' to your profile");
		}
		// if there is a loaded image, show it, otherwise show the default
		
		if(typeof data['fldProfileImage']  == "undefined"){
			data['fldProfileImage'] = "";
		}
		if(data['fldProfileImage'] != "" && typeof data['fldProfileImage'] != "undefined"){
			var basedir = <? echo "'".BASEDIR."'"; ?>;
			var imgStr = "<img src='"+basedir+"Views/images/profile_images/"+data['fldProfileImage']+"'>"
			$('.profilePicNest').html(imgStr);
		}else{
			$('.profilePicNest').html("<img class='avatar'>");
		}
		if(typeof data['fldFirstName']  == "undefined"){
			data['fldFirstName'] = "";
		}
		if(data['fldFirstName']!= ""){
		}
		if(typeof data['fldLastName']  == "undefined"){
			data['fldLastName'] = "";
		}
		if(data['fldLastName']!= ""){
		}
		// for our profile title
		if(data['fldLastName']!= "" && data['fldFirstName']!= ""){
			$('.contentHeader').text(data['fldFirstName']+" "+data['fldLastName']);
		}
		if(data['fldPersonalURL']!= "" && typeof data['fldPersonalURL'] != "undefined"){
		}
		// social shit
		if(data['fldGitURL']!= "" && typeof data['fldGitURL'] != "undefined"){
			$('.social').append("<a target='_blank' href='"+data['fldTwitterURL']+
				"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/git.png'></a>");
		}
		if(data['fldTwitterURL']!= "" && typeof data['fldTwitterURL'] != "undefined"){
			$('.social').append("<a target='_blank' href='"+data['fldTwitterURL']+
				"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png'></a>");
		}
		if(data['fldFacebookURL']!= "" && typeof data['fldFacebookURL'] != "undefined"){
			$('.social').append("<a target='_blank' href='"+data['fldFacebookURL']+
				"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png'></a>");
		}
		if(data['fldLinkedinURL']!= "" && typeof data['fldLinkedinURL'] != "undefined"){
			$('.social').append("<a target='_blank' href='"+data['fldLinkedinURL']+
				"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png'></a>");
		}
		if(data['fldGoogleURL']!= "" && typeof data['fldGoogleURL'] != "undefined"){
			$('.social').append("<a target='_blank' href='"+data['fldGoogleURL']+
				"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/google.png'></a>");
		}
	});
});
</script>

<div class="profileContain">
	<div class="contentHeader">
	</div>
	<ul>
		<li class="containRow row1">
			<div class="nest">
				<div class="profilePicNest">
				</div>
				<div class="profileDescrip">
					<h3><b>About Me</b></h3>
					<span class="descripText"></span>
				</div>
				<div class="social">
				</div>
				<div class="clearBoth"></div>
				</div>
			</div>
		</li>
	</ul>
</div>

