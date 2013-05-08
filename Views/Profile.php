<?php
/**
* @author Joshua Dickerson at The University of Vermont
*  Profile.php displays the user's profile
**/
require_once "topBar.php";
// var_dump($this->vars['memberLangs']);
?>

<script type="text/javascript">
$(document).ready(function(){
	var base= "<?= BASEDIR ?>";
});
</script>

<div class="profileContain">
	<div class="row-fluid">
		<div class="span12">
		</div>
	</div>
	<div class="row-fluid">
		<div class="span2">
			<div class="row-fluid">
				<div class="span12">
					<img class="imageDialog" src=<? echo "'".BASEDIR."Views/images/profile_images/".$this->vars['profile']['fldProfileImage']."'>\n"; ?>
				</div>
			</div>
			<div class="row-fluid profileDataNest">
				<div class="span12 profileName">
					<?= $this->vars['profile']['fldFirstName']." ".$this->vars['profile']['fldLastName']; ?>
				</div>
				<div class="span12 profileStanding">
					<?= $this->vars['profile']['fldClassStanding']; ?>
				</div>
				<div class="span12 profileMajor">
					<?= $this->vars['profile']['fldMajor']; ?>
				</div>
			</div>
		</div>
		<div class="span8">
			<span class="contentHeader firstHeader">About Me</span>
			<div class="span12">
					<?= $this->vars['profile']['fldAboutMe']; ?>
			</div>
			<span class="contentHeader">Expertise</span>
			<div class="span12">
					<?
						$out = "";
						foreach ($this->vars['memberLangs'] as $langs){
							$out .= $langs['language'].", ";
						}
						$out = substr_replace($out ,"",-2);
						echo $out;
					?>
			</div>
		</div>
		<div class="span2">
<?
				$output = "";
				if(isset($this->vars['profile']['fldGitURL']) && $this->vars['profile']['fldGitURL']!= "" && $this->vars['profile']['fldGitURL'] != null){
					$output .= "<a target='_blank' href='".$this->vars['profile']['fldGitURL']."'>";
					$output .="<img alt='img' class='icon socialIcon' src='".BASEDIR."Views/css/fonts/icons/elegantmediaicons/PNG/git.png'></a>\n";
				}
				if(isset($this->vars['profile']['fldTwitterURL']) && $this->vars['profile']['fldTwitterURL']!= "" && $this->vars['profile']['fldTwitterURL'] != null){
					$output .= "<a target='_blank' href='".$this->vars['profile']['fldTwitterURL']."'>";
					$output .= "<img alt='img' class='icon socialIcon' src='".BASEDIR."Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png'></a>\n";
				}
				if(isset($this->vars['profile']['fldFacebookURL']) && $this->vars['profile']['fldFacebookURL']!= "" && $this->vars['profile']['fldFacebookURL'] != null){
					$output .= "<a target='_blank' href='".$this->vars['profile']['fldFacebookURL']."'>";
					$output .= "<img alt='img' class='icon socialIcon' src='".BASEDIR."Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png'></a>\n";
				}
				if(isset($this->vars['profile']['fldLinkedinURL']) && $this->vars['profile']['fldLinkedinURL']!= "" && $this->vars['profile']['fldLinkedinURL'] != null){
					$output .= "<a target='_blank' href='".$this->vars['profile']['fldLinkedinURL']."'>";
					$output .= "<img alt='img' class='icon socialIcon' src='".BASEDIR."Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png'></a>\n";
				}
				if(isset($this->vars['profile']['fldGoogleURL']) && $this->vars['profile']['fldGoogleURL']!= "" && $this->vars['profile']['fldGoogleURL'] != null){
					$output .= "<a target='_blank' href='".$this->vars['profile']['fldGoogleURL']."'>";
					$output .= "<img alt='img' class='icon socialIcon' src='".BASEDIR."Views/css/fonts/icons/elegantmediaicons/PNG/google.png'></a>\n";
				}

				echo $output;
?>
		</div>
	</div>
</div>

