<?php
require_once "topBar.php";

function addHTTP($url){
	//Do we start with http://?
	if(preg_match('^http:\/\/', $url)){
		return $url;
	}else{
		return 'http://' . $url;
	}
}

?>

<div class="tutorial">

<h2>Tutorials</h2>
<p>
	When in the course of Computer Science it becomes necessary to google 
	or search stack overflow, we often find tutorials. Sharing is caring, and
	sometimes we find cool things that we care about and want to share. Use
	the form below to submit your tutorials, we'll review it and if it's useful
	we'll post it below! Don't be shy! 
</p>
<form method="POST" action="<?= BASEDIR . 'Tutorial/?add=true'; ?>">
	<input type="text" name="url" />
	<input type="text" name="title" />
	<input type="submit" value="Help out!" />
</form>

<div id="tutorials">
	<ul>
		<?php
		if(isset($this->vars['tutorials'])){
			foreach ($this->vars['tutorials'] as $tutorial) {
				echo '<li><a href="' . addHTTP(urldecode($tutorial['url'])) . '">' . $tutorial['title'] . '</a></li>';
			}	
		}else{
			echo '<li>No Tutorials! Why don\'t you submit one?</li>';
		}
		?>
	</ul>
</div>

</div>

<?php
require_once "footer.php";
?>