<!DOCTYPE html>

<html>

<body>

<?php

include 'Comments.php';

$comments = array(  array('comment_id'=>1, 'parent_comment_id'=>NULL,   'text'=>'Parent'),
                    array('comment_id'=>2, 'parent_comment_id'=>1,      'text'=>'Child'),
                    array('comment_id'=>3, 'parent_comment_id'=>2,      'text'=>'Child Third level'),
                    array('comment_id'=>4, 'parent_comment_id'=>NULL,   'text'=>'Second Parent'),
                    array('comment_id'=>5, 'parent_comment_id'=>4,   'text'=>'Second Child'),
                    array('comment_id'=>6, 'parent_comment_id'=>3, 'text'=>'Breaking it all!')
                );
echo "<h1> Nested Comments Attempts </h1>";

// automatically echoes the HTML for the nested comments
$tc = new Comments($comments);

?>
</body>

</html>
