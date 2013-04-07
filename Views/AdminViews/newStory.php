<?php
	include 'Views/topBar.php';
	require_once 'Models/NewsBundle.php';
?>


<script type="text/javascript">
	$(document).ready(function(){
		$('.save').click(function(){
			console.log(this.files);
			var title=$("input#story-title").val();
			var image=$("input#story-image").val();
			var html = $("textarea#story-html").val();
			$.ajax({
				type: "POST",
				url: "<?php echo BASEDIR.'Admin/?news=save'?>",
				data: {title: title, image: image, html: html},
				sucess: function(){
					console.log('sucess');
				}

			});
			return false;
		});
	});
</script>
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
				<a href='<?php echo BASEDIR.'Admin/?news=edit&id='.$story->getId()?>'> <?php echo $story->getTitle()?></a>
			</li>
			<?php }?>
		</ul>
	</div>
	<div class ="span10">
		<form method="post" enctype="multipart/form-data" action="<?php echo BASEDIR;?>Admin/?news=save">
			<input type="text" class="span4" name="story-title" id="story-title"></input>
			<input type="file" class ="span8" name="story-image" id="story-image"></input>
			<textarea class="span8" rows="20" name="story-html" id="story-html"></textarea>
			<input type="submit" value ="Save"> <input type="button" id="preview" value="Preview">
		<form>
	</div>
</div>