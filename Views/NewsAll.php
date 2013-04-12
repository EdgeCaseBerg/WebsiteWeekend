<?php include('topBar.php') ?>

<div id="newsPage" class="row-fluid">
	<!-- <p><? //echo $this->vars['helloObj']; ?></p> -->

	<div id="csCrewNews" class="span8">
		<h1>CSCrew News</h1>
		<hr>

		<!-- Render each of the news items, as needed -->
		<?
			
		echo '<div id="postContainer" class="row-fluid">';
		foreach($this->vars as $newsPost){
			$post = file_get_contents('Views/Stories/Content/' . $newsPost->getPath() .'.php');
			echo "<div class='newsPost span12' style='margin-left:15px'>";
				if($newsPost->getImage()!== ''){
					echo '<img class = "span4" src="../Views/Stories/Images/'. $newsPost->getImage().'"/>';	
				}else{
					echo '<img class = "span4" src="../Views/Stories/Images/default.jpg"/>';
				}
				
				echo '<div class="news-content span6">';
				echo '<h4>'.$newsPost->getTitle().'</h4>';
				echo '</div>';
				echo '<div class = "news-date span1">';
					echo '<p>'.$newsPost->displayDate().'</p>';
				echo '</div>';
				echo '<div class="news-contetnt span7">';
				if(strlen($post) > 600){
					echo substr($post, 0,500).'&#8230;';
				}else{
					echo $post;
				}

				echo '<span class="readMore"><a href="'.BASEDIR.'News/?singleStory='. $newsPost->getId() .'">Read More</a></span>';
				echo '</div>';
				echo '<div class = "span12"></div>';
			echo '</div> <!-- end newsPost -->';
			echo '<div class = "span12"></div>';
			
		} 
		echo '</div>';
			
		?>

	</div> <!-- end csCrewNews -->

	<div id="cemsNews" class="span4">
		<h1>CEMS News</h1>
		<hr>

		<div class="cemsNewsPost">
			<img src=""/>
			<p>
				Donec odio metus, rutrum et dapibus id, eleifend sed nibh. Vivamus ullamcorper, tortor sit amet consectetur venenatis, eros nisi sagittis odio, vel malesuada magna sapien non nulla. Donec cursus bibendum enim et pharetra. Nam eget ante dui, vel fermentum nisl. Aliquam hendrerit egestas eros, at pellentesque turpis semper a. Integer augue nibh, facilisis eget aliquam vel, tincidunt eget mauris. Fusce volutpat semper rhoncus. Nunc odio dui, aliquam vel sagittis iaculis, dignissim nec felis. Vestibulum sapien nisi, fringilla non convallis vitae, commodo a felis. Phasellus eros turpis, tempor vel aliquam eget, ornare eget dui.
				<span class="readMore"><a href="">Read More</a></span>
			</p>
		</div> <!-- end cemsNewsPost -->

		<div class="cemsNewsPost">
			<img src=""/>
			<p>
				Donec cursus bibendum enim et pharetra. Nam eget ante dui, vel fermentum nisl. Aliquam hendrerit egestas eros, at pellentesque turpis semper a. Integer augue nibh, facilisis eget aliquam vel, tincidunt eget mauris. Fusce volutpat semper rhoncus. Nunc odio dui, aliquam vel sagittis iaculis, dignissim nec felis. Vestibulum sapien nisi, fringilla non convallis vitae, commodo a felis. Phasellus eros turpis, tempor vel aliquam eget, ornare eget dui.
				<span class="readMore"><a href="">Read More</a></span>
			</p>
		</div> <!-- end cemsNewsPost -->

	</div> <!-- end cemsNews -->

</div><!-- end newsPage -->