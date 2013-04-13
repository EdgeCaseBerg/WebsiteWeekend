<?php

class Comments
{
    public $parents  = array();
    public $children = array();
    public $output;

    /*
        tblPosts needs to give this class these fields.
        +-------------+-------+-------------------+
        |  comment_id |  text | parent_comment_id |
        +-------------+-------+-------------------+
            INT pk     varchar      INT can be NULL
        1 db query:
            select * from tblPosts
            where thredID = "the thread you are on"

        Get this back as an associative array from the DB.

        The root of the forum posts is NULL, so the parent for all
        first level posts is NULL.        

    */

    // Calling this constructor gives you the html to
        // display the nested comments, but not an html page.
    function __construct($comments)
    {
        foreach ($comments as $comment)
        {
            if ($comment['parent_comment_id'] === NULL)
            {
                $this->parents[$comment['comment_id']][] = $comment;
            }
            else
            {
                $this->children[$comment['parent_comment_id']][] = $comment;
            }
        }

        $this->prepare($this->parents);

    } // End of constructor 

    // Properly nests comments
    public function thread($comments)
    {
        if(count($comments))
        {
            echo'<ul>';

            foreach($comments as $c)
            {
                echo "<li>" . $c['text'];
                //Rest of what ever you want to do with each row

                if (isset($this->children[$c['comment_id']])) {
                    $this->thread($this->children[$c['comment_id']]);
                }

                echo "</li>";
            }
            echo "</ul>";
        }
    } // End of thread

    private function prepare()
    {
        foreach ($this->parents as $comment)
        {
            $this->thread($comment);
        }
    } // End of prepare

} // End of Comments class

?>