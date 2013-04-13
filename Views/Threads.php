<?php

// $posts = $vars['posts'];
// $comments = $vars['comments'];

// var_dump($comments);

require_once "Views/topBar.php";

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
	// $array = array();
	// $array['tableName'] = 'comments';
	// $array['parentID'] = 0;
	// $dbWrapper = new InteractDB('select', $array);
	// $rows = $dbWrapper->returnedRows;

	// // for every top level node
	// foreach ($rows as $row){
	// 	// output the beginning li
	// 	echo "<li class='post'><div class='collapsePost'><span class='triangle'>&#xFF0B;</span></div>";
	// 	$array = array();
	// 	$array['tableName'] = 'comments';
	// 	$array['parentID'] = $row['commentID'];
	// 	echo "<span class='title'>".$row['commentTitle']."</span>";
	// 	echo "<span class='userInfo'>Posted by: <a href='#'>Josh</a> on ".$row['created']."</span>";
	// 	echo "<input type='hidden' name='commentID' class='commentID' value='".$row['commentID']."''>".
	// 		"<p>".$row['commentText'].
	// 		"<div class='postButtons'><ul><li class='replyButt'>reply</li>".
	// 		"<li>share</li></ul><div class='responseInput'>".
	// 			"<form method='post' action='".BASEDIR."Forum/?comment=newComment'><textarea rows='3' cols='5' name='commentText' tabindex='0'></textarea>".
	// 			"<input type='hidden' class='parentID' value='working' name='parentID'>".
	// 			"<input type='submit' value='submit'>".
	// 			"<input type='button' value='clear' class='clearButt'></form></div>";


	// 	$dbWrapper = new InteractDB('select', $array);
	// 	$rows = $dbWrapper->returnedRows;
	// 	traverse($rows);
	// 	echo "</li>";
	// }

	

?>



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



