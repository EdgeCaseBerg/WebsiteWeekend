<?php include('topBar.php') ?>

<div id="singleNewsPage">
	<div class="row-fluid">
		<div id="csCrewNews" class="span12">
			<div id="titleBar" class="row-fluid">
				<div id="backLink" class="span1">
					<a href="<?php echo BASEDIR."News/?allStories=true";?>">Back</a>
				</div>
				<div class="span10">
					<h1><?php echo $this->vars['single']->getTitle();?></h1>
					<hr>
				</div>
				
				<div class="span1">
				</div>
			</div>
			
			
			<div class = "news-content row-fluid">
				<?php $post = file_get_contents('Views/Stories/Content/' . $this->vars['single']->getPath() .'.php');?>
				<div class="news-img-container span3">
					<?php
					if($this->vars['single']->getImage()!== ''){
						echo '<img class = "news-img" src="../Views/Stories/Images/'. $this->vars['single']->getImage().'"/>';	
					}else{
						echo '<img class = "news-img" src="../Views/Stories/Images/default.jpg"/>';
					}
					?>
				</div>
				<div class="news-text span7">
					<p id="date">
						Date: <?php echo $this->vars['single']->displayDate();?>
					</p>
					
					<?php echo $post;?>
				</div>
				<div class="side-bar-right span2">
					<h5>Other News</h5>
					<ul>
						<?php
						foreach($this->vars['bundle'] as $news){
							if(intval($news->getId()) !== intval($this->vars['single']->getId())){
								echo '<li>';
								echo '<a href="'.BASEDIR.'News/?singleStory='.$news->getId().'">';
								if(strlen($news->getTitle())>25){
									echo substr($news->getTitle(),0,22).'&#8230;';
								}else{
								 	echo $news->getTitle();
								}
								echo '</a>';
								echo '</li>';
							}
						}
						?>
					</ul>
				</div>
			</div>

			<div class ="row-fluid">
				<div class = "span12"></div>
			</div>
		</div>
	</div>
</div>