<?php

// $posts = $vars['posts'];
// $comments = $vars['comments'];

// var_dump($comments);

require_once "Models/InteractDB.php";

function traverse($rows){
	$counter = 2;
	foreach($rows as $row){
		if(($counter%2)==0){$response = 'odd';}else{$response = 'even';}
		echo "<div class='response ".$response."'>".$row['commentText']."";
		// echo "<span class='title'>".$row['comment']."</span>";
		echo "<span class='userInfo'>Posted by: <a href='#'>Josh</a> on ".$row['created']."</span>";
		echo "<input type='hidden' name='commentID' class='commentID' value='".$row['commentID']."''>".
			"<div class='postButtons'><ul><li class='replyButt'>reply</li>".
			"<li>share</li></ul><div class='responseInput'>".
				"<form method='post' action='".BASEDIR."Forum/?comment=newComment'><textarea rows='3' cols='5' name='commentText' tabindex='0'></textarea>".
				"<input type='hidden' class='parentID' value='working' name='parentID'>".
				"<input type='submit' value='submit'>".
				"<input type='button' value='clear' class='clearButt'></form></div>";
		$array = array();
		$array['tableName'] = 'comments';
		$array['parentID'] = $row['commentID'];
		$dbWrapper = new InteractDB('select', $array);
		$returnedRows = $dbWrapper->returnedRows;
		echo "</div>";
		traverse($returnedRows);
		$counter++;
		echo "</div>";
	}
	

} // end traverse()

?>




<script type="text/javascript" src="<? echo BASEDIR; ?>Views/js/forum.js"></script>

<span class="pageTitle">Forum</span>

<ul class="forum">
	<li><input type="button" class="newPost" value="new Post"></li>
	
<?

	// first we need to grab all the top level nodes
	$array = array();
	$array['tableName'] = 'comments';
	$array['parentID'] = 0;
	$dbWrapper = new InteractDB('select', $array);
	$rows = $dbWrapper->returnedRows;

	// for every top level node
	foreach ($rows as $row){
		// output the beginning li
		echo "<li class='post'><div class='collapsePost'><span class='triangle'>&#xFF0B;</span></div>";
		$array = array();
		$array['tableName'] = 'comments';
		$array['parentID'] = $row['commentID'];
		echo "<span class='title'>".$row['commentTitle']."</span>";
		echo "<span class='userInfo'>Posted by: <a href='#'>Josh</a> on ".$row['created']."</span>";
		echo "<input type='hidden' name='commentID' class='commentID' value='".$row['commentID']."''>".
			"<p>".$row['commentText'].
			"<div class='postButtons'><ul><li class='replyButt'>reply</li>".
			"<li>share</li></ul><div class='responseInput'>".
				"<form method='post' action='".BASEDIR."Forum/?comment=newComment'><textarea rows='3' cols='5' name='commentText' tabindex='0'></textarea>".
				"<input type='hidden' class='parentID' value='working' name='parentID'>".
				"<input type='submit' value='submit'>".
				"<input type='button' value='clear' class='clearButt'></form></div>";


		$dbWrapper = new InteractDB('select', $array);
		$rows = $dbWrapper->returnedRows;
		traverse($rows);
		echo "</li>";
	}

	

?>



<!-- 
	<li class="post">
		<span class="title">How These Will Work</span>
		<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
		<input type="hidden" name="comment_id" class="comment_id" value="420">
		<p>
			These posts will be programatically generated with php after
			the data is pulled from the database. This page is static because
			I am building the css and javascript needed to control the appearance
			once the appearance is complete, we will work on the backend. 

		</p>

		<div class="postButtons">
			<ul>
				<li class="replyButt">reply</li>
				<li>share</li>
			</ul>

			<div class="responseInput">
				<form>
					<textarea rows="3" cols="5" name="reply" tabindex="0"></textarea>
					<input type="hidden" class="parent_id" value="working">
					<input type="submit" value="submit">
					<input type="button" value="clear" class="clearButt">
				</form>
			</div>
		</div>



		<div class="response odd">
			<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
			Yeah That sounds like a good idea, Josh
			<div class="postButtons">
				<ul>
					<li class="replyButt">reply</li>
					<li>share</li>
				</ul>

				<div class="responseInput">
					<form>
						<textarea rows="3" cols="5" name="reply" tabindex="0"></textarea>
						<input type="submit" value="submit">
						<input type="button" value="clear" class="clearButt">
					</form>
				</div>
			</div>
		</div>

		<div class="response odd">
			<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
			Now I'm talking to myself!
			<div class="postButtons">
				<ul>
					<li class="replyButt">reply</li>
					<li>share</li>
				</ul>
			</div>
			<div class="response even">
				<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
				1st response to 2nd response to title message
				<div class="postButtons">
					<ul>
						<li class="replyButt">reply</li>
						<li>share</li>
					</ul>
				</div>
				<div class="response odd">
					<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
					1st response to 2nd response to title message
					<div class="postButtons">
						<ul>
							<li class="replyButt">reply</li>
							<li>share</li>
						</ul>
					</div>
					<div class="response even">
						<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
						1st response to 2nd response to title message
						<div class="postButtons">
							<ul>
								<li class="replyButt">reply</li>
								<li>share</li>
							</ul>
						</div>
					</div>
				</div>
			</div>				
			<div class="response even">
				<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
				Yeah That sounds like a good idea, Josh

				<div class="postButtons">
					<ul>
						<li class="replyButt">reply</li>
						<li>share</li>
					</ul>
					<div class="responseInput">
						<form>
							<textarea rows="3" cols="5" name="reply" tabindex="0"></textarea>
							<input type="submit" value="submit">
							<input type="button" value="clear" class="clearButt">
						</form>
					</div>
				</div>
			</div>
		</div>
	</li>
	<li class="post">
		<span class="title">Post Title</span>
		<span class="userInfo">Posted by: <a href="#">Josh</a> at 12:00pm on 3/16/2012</span>
		<p>
			2nd Title message
			Lorem ipsum dolor sit amet, consectetur 
			adipiscing elit. Donec aliquet auctor velit 
			a consectetur. Cras velit erat, congue in 
			sagittis non, congue non lorem. Phasellus 
			fringilla venenatis magna, at scelerisque 
			odio rhoncus vitae. Aliquam aliquam tincidunt 
			erat, in consequat risus congue non. Lorem 
			ipsum dolor sit amet, consectetur adipiscing 
			elit. Fusce tempor interdum condimentum. Aliquam 
			ultrices, erat dignissim condimentum congue, 
			diam nibh pulvinar dui, vitae consequat diam 
			lacus sit amet metus. Aliquam erat volutpat.
		</p>

		<div class="postButtons">
			<ul>
				<li class="replyButt">reply</li>
				<li>share</li>
			</ul>
		</div>

		<div class="response odd">
				1st response to 2nd title message
			<div class="postButtons">
				<ul>
					<li class="replyButt">reply</li>
					<li>share</li>
				</ul>
			</div>
		</div>

		<div class="response odd">
			2nd response to title message
			<div class="postButtons">
				<ul>
					<li class="replyButt">reply</li>
					<li>share</li>
				</ul>
			</div>
			<div class="response even">
				1st response to 2nd response to title message
				<div class="postButtons">
					<ul>
						<li class="replyButt">reply</li>
						<li>share</li>
					</ul>
				</div>
				<div class="response odd">
					1st response to 2nd response to title message
					<div class="postButtons">
						<ul>
							<li class="replyButt">reply</li>
							<li>share</li>
						</ul>
					</div>
					<div class="response even">
						1st response to 2nd response to title message
						<div class="postButtons">
							<ul>
								<li class="replyButt">reply</li>
								<li>share</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
</ul> -->

<div class="newPostPop">
	<div class="nest">
		<img src="<? echo BASEDIR; ?>Views/images/closeIcon.png" class="closeButton">
		<form method="post" action="<? echo BASEDIR; ?>Forum/?newPost=yes">
			<ul class="postDialog">
				<li class="title">Post Title:</li>
				<li><input type="text" name="commentTitle"></li>
				<li class="title">Post Text</li>
				<li><textarea name="commentText"></textarea></li>
				<li><input type="submit" value="submit"><input type="button" value="clear"></li>
			</ul>
		</form>
	</div>
</div>



