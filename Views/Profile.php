<?php
 // var_dump($vars);

function checkSet($var){
	// don't want to do a hundred isset's 
	if(!isset($var) || $var == "null"){
		return "";
	}else{return $var;}
}

function get_json($url){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 
        //curl_setopt($curl, CONNECTTIMEOUT, 1);
    $content = curl_exec($curl);
    $json = json_decode($content,true);
    curl_close($curl);
    return $json;
}

// var_dump(get_json());

// below produces the URL's of my githubs
$url = "https://api.github.com/users/".$vars['git']."/repos";
$jso = get_json($url);
// var_dump($jso);
// bad fix for hiding the projects div
if(count($jso) == 0 || isset($jso['message'])){
	// acounts for bad/empty github entries
	echo "<style type='text/css'>#gitTable{display:none;}</style>";
}else{
	// assign all the projects to the $projects array, for no apparent reason
	for ($ii=0; $ii<count($jso); $ii++){
		$dateArr = explode("T", $jso[$ii]['updated_at']);
		$project[$ii]['url'] = $jso[$ii]['html_url'];
		$project[$ii]['updated'] = $dateArr[0];
		$project[$ii]['name'] = $jso[$ii]['name'];
		$project[$ii]['language'] = $jso[$ii]['language'];
	}
}


$twitter = "https://api.twitter.com/1/statuses/user_timeline.json?screen_name=".$vars['twitter']."&count=5";
$jso = get_json($twitter);
// var_dump($jso[1]['text']);


if(count($jso) == 0 || !isset($jso[0]['text'])){
	// acounts for bad/empty github entries
	echo "<style type='text/css'>#twitter_table{display:none;}</style>";
}else{
	// assign all the projects to the $projects array, for no apparent reason
	for ($ii=0; $ii<count($jso); $ii++){
		// $dateArr = explode("T", $jso[$ii]['updated_at']);
		$tweet[$ii]['text'] = $jso[$ii]['text'];
		$tweet[$ii]['created_at'] = $jso[$ii]['created_at'];
	}
}

require_once "topBar.php";

?>

<div class="profileContain">
	<div class="contentHeader">Welcome back <? echo checkSet($vars['first_name']); ?>
	</div>
	<ul>
		<li class="containRow row1">

				<div class="nest">
					<div class="profilePicNest">
						<img class="avatar" src="<? echo BASEDIR. 'Views/profilePics/example-advanced/uploads/'.$vars['img_url']; ?>">
					</div>

					<div class="profileDescrip">
						<p class="memberName"><? echo checkSet($vars['first_name'])." ".checkSet($vars['last_name']); ?></p>
						<p><? echo checkSet($vars['about_me']); ?></p>
					</div>
					<div class="social">
						<? 	
						if ($vars['twitter'] != "null" && $vars['twitter'] != ""){
							echo 	"<a target='_blank' href='".$vars['twitter'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png'></a>";
						}
						if ($vars['facebook'] != "null" && $vars['facebook'] != ""){
							echo 	"<a target='_blank' href='".$vars['facebook']. 
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png'></a>";
						}
						if ($vars['linkedin'] != "null" && $vars['linkedin'] != ""){
							echo 	"<a target='_blank' href='".$vars['linkedin'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png'></a>";
						}
						if ($vars['tumblr'] != "null" && $vars['tumblr'] != ""){
							echo 	"<a target='_blank' href='".$vars['tumblr'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/tumblr.png'></a>";
						}
						if ($vars['blogger'] != "null" && $vars['blogger'] != ""){
							echo 	"<a target='_blank' href='".$vars['blogger'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/blogger.png'></a>";
						}
						if ($vars['rss'] != "null" && $vars['rss'] != ""){
							echo 	"<a target='_blank' href='".$vars['rss'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/rss.png'></a>";
						}
						if ($vars['google'] != "null" && $vars['google'] != ""){
							echo 	"<a target='_blank' href='".$vars['google'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/google.png'></a>";
						}
						if ($vars['reddit'] != "null" && $vars['reddit'] != ""){
							echo 	"<a target='_blank' href='".$vars['reddit'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/reddit.png'></a>";
						}
						if ($vars['myspace'] != "null" && $vars['myspace'] != ""){
							echo 	"<a target='_blank' href='".$vars['myspace'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/myspace.png'></a>";
						}
						if ($vars['git'] != "null" && $vars['git'] != ""){
							echo 	"<a target='_blank' href='".$vars['git'].
									"'><img alt='img' class='icon' src='".BASEDIR.
									"Views/css/fonts/icons/elegantmediaicons/PNG/git.png'></a>";
						}
						?>
					</div>

				</div>
			
		</li>
		<li class="containRow row2">
			<div class="containCell leftCell" id="gitTable">
					<div class="contentHeader">Projects</div>
				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th>Project Name</th>
				      <th>Last Updated</th>
				      <th>Language</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<? 
				  		if (isset($project)){
						  	for($ii=0; $ii < count($project); $ii++){
						  		echo 	"<tr class='projectRow'><input type='hidden' value='".$project[$ii]['url']."'><td>".$project[$ii]['name'].
						  				"</td><td>".$project[$ii]['updated'].
						  				"</td><td>".$project[$ii]['language']."</td></tr>";
						  	}
					  	}

				  	?>

				  </tbody>
				</table>
			</div>

			<div class="containCell rightCell" id="twitter_table">
				<div class="contentHeader">My Twitter Feed</div>
				  	<? 
				  		if (isset($twitter)){
						  	for($ii=0; $ii < count($tweet); $ii++){
						  		$dateArr = explode(" ", $tweet[$ii]['created_at']);
						  		$dateArr = $dateArr[0]." ".$dateArr[1]." ".$dateArr[2];
								if ($ii % 2 == 0){echo "<div class='bubble bubbleRight'>";}else{echo "<div class='bubble bubbleLeft'>";}
						  		echo "<div class='twitterDate'>".$dateArr."</div>".$tweet[$ii]['text']."</div>";
						  	}
					  	}

				  	?>



			</div>
		</li>
	</ul>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.projectRow').click(function(){
			var url = $(this).find("input[type='hidden']").val();
			window.open(url);
		});
	});
</script>
