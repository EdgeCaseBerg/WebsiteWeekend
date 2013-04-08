<?php include('topBar.php') ?>

<div id="singleNewsPage" class="row-fluid">
	<div id="csCrewNews" class="span12">
		<div id="titleBar" class="span12">
			<div id="backLink" class="span1">
				<a href="<?php echo BASEDIR."News/?allStories=true";?>">Back</a>
			</div>
			<div class="span10">
				<h1><?php echo $this->vars['title'];?></h1>
				<hr>
			</div>
			
			<div class="span1">
			</div>
		</div>
		
		
		<div class = "news-content span10">
			<?php $post = file_get_contents('Views/Stories/Content/' . $this->vars['path'] .'.php');?>
			<div class="news-img-container span4">
				<?php
				if($this->vars['image']!== ''){
					echo '<img class = "news-img span4" src="../Views/Stories/Images/'. $this->vars['image'].'"/>';	
				}else{
					echo '<img class = "news-img span4" src="../Views/Stories/Images/default.jpg"/>';
				}
				?>
			</div>
			<div class="news-text span7">
				<?php echo $post;?>
			</div>
		</div>
	</div>
</div>