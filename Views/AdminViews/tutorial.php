<?php
require_once "Views/topBar.php";

function addHTTP($url){
	//Do we start with http://?
	if(preg_match('/^http:\/\//', $url)){
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
	<label for="url">URL</label><input type="text" name="url" />
	<label for="title">Title</label><input type="text" name="title" />
	<input type="submit" value="Help out!" />
</form>

<div id="tutorials">
	<ul>
		<?php
		if(isset($this->vars['tutorials'])){
			foreach ($this->vars['tutorials'] as $key => $cat) {
				echo '<ul class="tutCat"><li><h3>'.$key.'</h3>';
				foreach ($cat as $tutorial) {
					echo '<li> <span class="edit" rel="url">' . (urldecode($tutorial['url'])) . '</span><span class="edit" rel="title" >' . $tutorial['title'] . '</span><span class="edit" rel="cat">'.$tutorial['cat'].'</span></li>';	
				}
				echo '</ul></li>';
			}	
		}else{
			echo '<li>No Tutorials! Why don\'t you submit one?</li>';
		}
		?>
	</ul>
</div>

</div>

<?php
require_once "Views/footer.php";
?>