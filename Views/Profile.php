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
	var query =base+"User/?showUserProfile="+<?= $_SESSION['user']->getUserID() ?>+"&output=json";
	<? } ?>
	
	$.ajax({
			url: query,
			type: "POST",
			success: function(data){
				profileData = data.profile;
				console.log(data);
				langData = data.langs;
				console.log(langData);
				// set our inputs full of data from the DB
				if(profileData['fldAboutMe']!= "" && typeof profileData['fldAboutMe'] != "undefined"){
					$('.descripText').text(profileData['fldAboutMe']);
				}else{
					$('.descripText').text("You haven't added an 'about me' to your profile");
				}
				// if there is a loaded image, show it, otherwise show the default
				
				if(typeof profileData['fldProfileImage']  == "undefined"){
					data['fldProfileImage'] = "";
				}
				if(profileData['fldProfileImage'] != "" && typeof profileData['fldProfileImage'] != "undefined"){
					var basedir = <? echo "'".BASEDIR."'"; ?>;
					var imgStr = "<img src='"+basedir+"Views/images/profile_images/"+profileData['fldProfileImage']+"'>"
					$('.profilePicNest').html(imgStr);
				}else{
					$('.profilePicNest').html("<img class='avatar'>");
				}
				if(typeof profileData['fldFirstName']  == "undefined"){
					profileData['fldFirstName'] = "";
				}
				if(profileData['fldFirstName']!= ""){
				}
				if(typeof profileData['fldLastName']  == "undefined"){
					profileData['fldLastName'] = "";
				}
				if(profileData['fldLastName']!= ""){
				}
				// for our profile title
				if(profileData['fldLastName']!= "" && profileData['fldFirstName']!= ""){
					$('.contentHeader').text(profileData['fldFirstName']+" "+profileData['fldLastName']);
				}
				if(profileData['fldPersonalURL']!= "" && typeof profileData['fldPersonalURL'] != "undefined"){
					$('.personalURL').html("<a href='"+profileData['fldPersonalURL']+"'>"+profileData['fldPersonalURL']+"</a>");
				}
				// social shit
				if(profileData['fldGitURL']!= "" && typeof profileData['fldGitURL'] != "undefined"){
					$('.social').append("<a target='_blank' href='"+profileData['fldGitURL']+
						"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/git.png'></a>");
				}
				if(profileData['fldTwitterURL']!= "" && typeof profileData['fldTwitterURL'] != "undefined"){
					$('.social').append("<a target='_blank' href='"+profileData['fldTwitterURL']+
						"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png'></a>");
				}
				if(profileData['fldFacebookURL']!= "" && typeof profileData['fldFacebookURL'] != "undefined"){
					$('.social').append("<a target='_blank' href='"+profileData['fldFacebookURL']+
						"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png'></a>");
				}
				if(profileData['fldLinkedinURL']!= "" && typeof profileData['fldLinkedinURL'] != "undefined"){
					$('.social').append("<a target='_blank' href='"+profileData['fldLinkedinURL']+
						"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png'></a>");
				}
				if(profileData['fldGoogleURL']!= "" && typeof profileData['fldGoogleURL'] != "undefined"){
					$('.social').append("<a target='_blank' href='"+profileData['fldGoogleURL']+
						"'><img alt='img' class='icon' src='"+base+"Views/css/fonts/icons/elegantmediaicons/PNG/google.png'></a>");
				}
				for(var ii=0; ii<langData.length; ii++){
					if(ii == langData.length-1){
						$('.expertiseList').append(langData[ii].language);
					}else{
						$('.expertiseList').append(langData[ii].language+", ");
					}
				}
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
					<ul>
						<li class="title"><h3><b>About Me</b></h3></li>
						<li class="profileData descripText"></li>
						<li class="title"><h3><b>Expertise</b></h3></li>
						<li class="profileData expertiseList"><li>
						<li class="title"><h3><b>Website</b></h3></li>
						<li class="profileData personalURL"></li>
					</ul>
				</div>
				<div class="social">
				</div>
				<div class="clearBoth"></div>
				</div>
			</div>
		</li>
	</ul>
</div>

