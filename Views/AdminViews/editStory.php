<?php
	include 'Views/topBar.php';
?>


<script type="text/javascript">
	$(document).ready(function(){
		$('.save').click(function(){
			var id=$("input#story-id").val();
			var image=$("input#story-image").val();
			var html = $("textarea#story-html").val();
			$.ajax({
				type: "POST",
				url: "<?php echo BASEDIR.'Admin/?news=save'?>",
				data: {id: id, image: image, html: html},
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
		<h1>Edit a Story</h1>
	</div>
</div>
<div class ="row-fluid">
	<div class ="span2">
		<ul>
			<?php 	$newsBundle = new NewsBundle();
				 	$otherNews = $newsBundle->retrieveAll();
				 	foreach($otherNews as $story){
						if($story->getId() === $this->vars['news']['id']){
							echo '<li class="active">';
						}else{
							echo '<li>';
						}
						echo '<a href="'.BASEDIR.'Admin/?news=edit&id='.$story->getId().'">'.$story->getTitle().'</a>';
						echo '</li>';
			 		}
			 ?>
		</ul>
	</div>
	<div class ="span10">
		
			<textfield class="span4" name="story-title" id="story-title"><?php echo $this->vars['news']['title'];?></textfield><br />
			<?php if($this->vars['news']['image'] === ''){?>
				<input type="file" class ="span8" name="story-image" id="story-image">
			<?php }else{ ?>
				<img src="<?php echo BASEDIR.'Views/Stories/Images/'.$this->vars["news"]["image"];?>"></img>
			<?php } ?>
		<form name="edit-story" action="">
			<input type="hidden" name ="story-id" id="story-id" value="<?php echo $this->vars['news']['id']?>">
			<textarea class="span8" rows="20" name="story-html" id="story-html"><?php echo $this->vars['file_text'];?></textarea>
			<input type="button" class="save" value ="Save"> <input type="button" id="preview" value="Preview">
		<form>
	</div>
</div>