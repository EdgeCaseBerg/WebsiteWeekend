<?php
include "topBar.php";

// this is a main content page. this page sits inside, and is included by
// home.php (currently)

// each li.row is a row... duhh
// inside each li we have divs that are the cells, they are 
// styled display:inline-block with css, and are lengthened to be of
// equal height, in javascript below
// var_dump($this->vars);

?>


<div class="row-fluid">
  <div class="span1">
    <ul>
      <li><span class="shiftArrow">&#8674;</span><a href="<?= BASEDIR; ?>Tutorial/">Tutorials</a></li>
      <li><span class="shiftArrow">&#8674;</span>Code</li>
      <li><span class="shiftArrow">&#8674;</span>Books</li>
      <li><span class="shiftArrow">&#8674;</span>Articles</li>
      <li><span class="shiftArrow">&#8674;</span>GitHub</li>
    </ul>
  </div>
  
  <div class="span8 centerSpan">
     <p>
        &nbsp; &nbsp; &nbsp;
        <span class="firstLetter">T</span>he CS-CREW is the preeminent student-led computer science organization at
        The University of Vermont. Established in 2010 by Anthony Sweet, Mark Cooper, and Beau Cameron, the CS-CREW serves the UVM community by providing 
        free tutoring, pre-registration help sessions, and admitted students presentations. 
        <img alt="img" class="newsImg" src="<? echo BASEDIR; ?>Views/images/photos/test1.jpg">
        <br/><br />
        &nbsp; &nbsp; &nbsp;We need a nice long paragraph of stuff to go here.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit 
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.
      </p>
      <div class="row">
      </div>
  </div>
  
  <div class="span3 rightSpan">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/tumblr.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/reddit.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/rss.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/youtube.png">
    <div class="row newsBlock">
      <h2>News</h2>
<?
    echo '<div id="postContainer" class="row-fluid">';
    foreach($this->vars as $newsPost){
      $post = file_get_contents('Views/Stories/Content/' . $newsPost->getPath() .'.php');
        echo '<p class="newsItem">';
        echo '<span class="headline">'.$newsPost->getTitle().'</span><br />';
        if(strlen($post) > 160){
          echo substr($post, 0,160).'&#8230;';
        }else{
          echo $post;
        }
        echo '<span class="readMore"><a href="'.BASEDIR.'News/?singleStory='. $newsPost->getId() .'">Read More</a></span>';
        echo "</p>";
    } 
    echo '</div>';
      
?>
  </div>

<script type="text/javascript">
// make the cells equal length
$(document).ready(function(){
  var r1h1 = $('.row1 .leftCell').height();
  var r1h2 = $('.row1 .midCell').height();
  var r1h3 = $('.row1 .rightCell').height();
  var maxR1Height = Math.max(r1h1, r1h2, r1h3);
  if($(window).width()>480){
    $('.row1 .containCell').css({'height' : maxR1Height+40});
  }
</script>


