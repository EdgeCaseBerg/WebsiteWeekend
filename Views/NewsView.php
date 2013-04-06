<?php include('topBar.php') ?>

<div id="newsPage" class="row-fluid">
	<!-- <p><? //echo $this->vars['helloObj']; ?></p> -->

	<div id="csCrewNews" class="span8">
		<h1>CSCrew News</h1>
		<hr>


		<!-- for each of the items in $this->vars render it -->
		<?
			// logThis($this->vars);
			if($this->vars['singleStory']){
				// logThis("we have a single story to render");
				logThis($this->vars);
				$post = file_get_contents('Views/Stories/Content/' . $this->vars['path'] .'.php');
				echo $post;
			}
			else{
				foreach($this->vars as $newsPost){
					$post = file_get_contents('Views/Stories/Content/' . $newsPost->getPath() .'.php');
					echo $post;
				} 
			}
			
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