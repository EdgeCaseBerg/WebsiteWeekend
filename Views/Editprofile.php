<?php

$profilePic = "noprofile";
// var_dump($vars['git']);

function checkSet($var){
	// don't want to do a hundred isset's 
	if(!isset($var) || $var == "null"){
		return "";
	}else{return $var;}
}

?>

<script type="text/javascript" src="<? echo BASEDIR; ?>Views/js/fileuploader.js"></script>

<script type="text/javascript">

$(document).mousemove(function(){
	// this provides that when the mouse is moved around the document, the 
	// script sees if an image has been uploaded, if so it hides the upload button, and 
	// sets the hidden input's value to the image name
		var uploadedSRC = $('#PhotoPrevs img:first-child').attr('src');
		
	if(typeof(uploadedSRC) != 'undefined'){
		var urlSplit = uploadedSRC.split('?')[0];
		var imgSRC = urlSplit.split('uploads/')[1];
		$('#imgUpload').attr('value', imgSRC);
		$('.qq-upload-button').hide();
	}
});

$(document).ready(function(){

	// this block checks and sets all the form inputs for the 
	// social networks

	var twitter_addr = <? echo '"'.checkSet($vars['twitter']).'"'; ?>;
	var facebook_addr = <? echo '"'.checkSet($vars['facebook']).'"'; ?>;
	var tumblr_addr = <? echo '"'.checkSet($vars['tumblr']).'"'; ?>;
	var blogger_addr = <? echo '"'.checkSet($vars['blogger']).'"'; ?>;
	var linkedin_addr = <? echo '"'.checkSet($vars['linkedin']).'"'; ?>;
	var google_addr = <? echo '"'.checkSet($vars['google']).'"'; ?>;
	var rss_addr = <? echo '"'.checkSet($vars['rss']).'"'; ?>;
	var git_addr = <? echo '"'.checkSet($vars['git']).'"'; ?>;

	if(git_addr != "" && git_addr != "null"){$('#git').prop("checked", true);
		$("input[name='git']").prop("value", git_addr);
		$('#git').parent().find(".socialUrl").show();
	}

	if(twitter_addr != "" && twitter_addr != "null"){$('#twitter').prop("checked", true);
		$("input[name='twitter']").prop("value", twitter_addr);
		$('#twitter').parent().find(".socialUrl").show();
	}
	if(facebook_addr != "" && facebook_addr != "null"){$('#facebook').prop("checked", true);
		$("input[name='facebook']").prop("value", facebook_addr);
		$('#facebook').parent().find(".socialUrl").show();
	}
	if(tumblr_addr != "" && tumblr_addr != "null"){$('#tumblr').prop("checked", true);
		$("input[name='tumblr']").prop("value", tumblr_addr);
		$('#tumblr').parent().find(".socialUrl").show();
	}
	if(blogger_addr != "" && blogger_addr != "null"){$('#blogger').prop("checked", true);
		$("input[name='blogger']").prop("value", blogger_addr);
		$('#blogger').parent().find(".socialUrl").show();
	}
	if(linkedin_addr != "" && linkedin_addr != "null"){$('#linkedin').prop("checked", true);
		$("input[name='linkedin']").prop("value", linkedin_addr);
		$('#linkedin').parent().find(".socialUrl").show();
	}
	if(google_addr != "" && google_addr != "null"){$('#google').prop("checked", true);
		$("input[name='google']").prop("value", google_addr);
		$('#google').parent().find(".socialUrl").show();
	}
	if(rss_addr != "" && rss_addr != "null"){$('#rss').prop("checked", true);
		$("input[name='rss']").prop("value", rss_addr);
		$('#rss').parent().find(".socialUrl").show();
	}

	// if there is a $vars['about_me'] set the textarea's value
	$("textarea[name='about_me']").val(<? echo '"'.checkSet($vars['about_me']).'"'; ?>);
	

	// animations for social networks checkboxes
	$(".socialCheckbox").click(function(){	
		if ($(this).is(':checked')){
			$(this).parent().find(".socialUrl").slideDown();
		}
		else{
			$(this).parent().find("input[type='text']").prop('value', "");
			$(this).parent().find(".socialUrl").slideToggle();
		}
	});


	// $('#test').click(function(){
	// 	alert($("input[name='twitter_url']").attr('value'));
	// });

	
    $("#submitButt").click(function(){
    	// for ajax submitting 2 forms at the same time

    	// first find all the social network inputs with empty values 
    	// and remove them from the post array
        $('#editSoc').find(':input[value=""]').attr("disabled", "disabled");

        var dataStringSoc = "";
        // prepare our post
        $("#editSoc input[type='text']").each(function(){
        	// if($(this).val() != "")
        	dataStringSoc += $(this).attr("name") + "=" + $(this).val() + "&";
        });
        dataStringSoc = dataStringSoc.slice(0, -1);
        // alert(dataString);
        // perform the post
        $.ajax({
        	type: "POST",
        	url: <? echo "'" . BASEDIR . "User/?updateProfile=social'"; ?>,
        	data: dataStringSoc
        	// success: alert('worked')
        });
        

        $('#editProf').find(':input[value=""]').attr("disabled", "disabled");

        var dataStringProf = "";
        // prepare our post
        $("#editProf input[type='text']").each(function(){
        	// if($(this).val() != "")
        	dataStringProf += $(this).attr("name") + "=" + $(this).val() + "&";
        });

        $("#editProf textarea").each(function(){
        	if($(this).val() != "")
        	dataStringProf += $(this).attr("name") + "=" + $(this).val() + "&";
        });

        dataStringProf = dataStringProf.slice(0, -1);
        // alert(dataString);
        // perform the post
        $.ajax({
        	type: "POST",
        	url: <? echo "'" . BASEDIR . "User/?updateProfile=profile'"; ?>,
        	data: dataStringProf,
        	success: document.location.reload() 
        });
	});

});
</script>

<div class="editProfileContain">
	<div class="contentHeader">Edit My Profile
	</div> 
	<ul>
		<li class="containRow">
			<div class="leftCell containCell">
				<form method="post" action="<? echo BASEDIR; ?>User/?updateProfile=profile" id="editProf" name="form1">
				
					<ul>
						<li><span class="inputTitle">First Name</span></li>
						<li><input type="text" name="first_name" value="<? echo checkSet($vars['first_name']); ?>"></li>
						<li><span>Last Name</span></li>
						<li><input type="text" name="last_name" value="<? echo checkSet($vars['last_name']); ?>"></li>
						<li><span>Personal Website URL</span></li>
						<li><input type="text" name="personal_url" value="<? echo checkSet($vars['personal_url']); ?>"></li>
						<li><span>About Me</span></li>
						<li><textarea name="about_me" class="about_me" rows="6"></textarea></li>
					</ul>

				</form>
				</div>


				<div class="rightCell containCell">
					<div class="leftNest nest">
						<form method="post" action="<? echo BASEDIR; ?>User/?updateProfile=social" id="editSoc" name="form2">
						<div class="inputTitle">Social Networks</div>
						<ul>
							<li>
								<input type="checkbox" class="socialCheckbox" id="git">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/git.png">
								GIT
								<div class="socialUrl">Username: <input type="text" name="git"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="twitter">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png">
								Twitter
								<div class="socialUrl">Username: <input type="text" name="twitter"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="facebook">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png">
								Facebook
								<div class="socialUrl">URL: <input type="text" name="facebook"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="tumblr">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/tumblr.png">
								Tumblr
								<div class="socialUrl">URL: <input type="text" name="tumblr"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="blogger">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/blogger.png">
								Blogger
								<div class="socialUrl">URL: <input type="text" name="blogger"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="linkedin">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png">
								Linkedin
								<div class="socialUrl">URL: <input type="text" name="linkedin"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="google">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/google.png">
								Google +
								<div class="socialUrl">URL: <input type="text" name="google"></div>
							</li>
							<li>
								<input type="checkbox" class="socialCheckbox" id="rss">
								<img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/rss.png">
								RSS Feed
								<div class="socialUrl">URL: <input type="text" name="rss"></div>
							</li>
						</ul>
						</form>
					</div>

					<div class="rightNest nest">
						<div class="inputTitle">Profile image</div>
						<div class="imageDialog" id="PhotoPrevs">
						</div>
						<div class="fileInput">
							<div id="UploadImages">
								<noscript>Please enable javascript to upload and crop images.</noscript>
							</div>
							<!-- <input type="file" name="profile_image"> -->
						</div>
						<input type="hidden" id="imgUpload" name="img_url" value="null">
					</div>

				</div>
		</li>

		<li class="buttonRow">
			<input type="button" id="submitButt" value="submit" class="button">
			<input type="button" value="clear" id="clear" class="button">
			<input type="button" value="test" id="test" style="display:none;">
		</li>

		<? include "Views/profilePics/example-advanced/index.php"; ?>
		

		

	</ul>
</div>
</form>
