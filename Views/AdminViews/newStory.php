<?php
	include 'Views/topBar.php';
	require_once 'Models/NewsBundle.php';
?>

<div class ="row-fluid">
	<div class = "span11">
		<h1>Publish a New Story</h1>
	</div>
</div>
<div class ="row-fluid">
	<div class ="span2">
		<ul>
			<?php $newsBundle = new NewsBundle();
				  $news = $newsBundle->retrieveAll();
				  foreach($news as $story){
			?>
			<li>
				<a rel='<?php echo $story->getId() ?>'> <?php echo $story->getTitle()?></a>
			</li>
			<?php }?>
		</ul>
	</div>
	<div class ="span10">
		<form>
			<input type="text" class="span4" name="story_title"></input>
			<input type="file" class ="span8" name="story_image"></input>
			<textarea class="span8" rows="20" name="story_html"></textarea>
		<form>
	</div>
</div>