<?php
include "topBar.php";

// this is a main content page. this page sits inside, and is included by
// home.php (currently)

// each li.row is a row... duhh
// inside each li we have divs that are the cells, they are 
// styled display:inline-block with css, and are lengthened to be of
// equal height, in javascript below
// var_dump($this->vars);

$showLinks = false;
?>


<div class="row-fluid defaultViewNest">
  <div class="span1">
    <? if($showLinks){ ?>
      <ul>
        <li><span class="shiftArrow">&#8674;</span><a href="<?= BASEDIR; ?>Tutorial/">Tutorials</a></li>
        <li><span class="shiftArrow">&#8674;</span>Code</li>
        <li><span class="shiftArrow">&#8674;</span>Books</li>
        <li><span class="shiftArrow">&#8674;</span>Articles</li>
        <li><span class="shiftArrow">&#8674;</span>GitHub</li>
      </ul>
      <? }?>
  </div>
  
  <div class="span8 centerSpan">
     <p>
        &nbsp; &nbsp; &nbsp;
        <span class="firstLetter">T</span>he CS-CREW is the preeminent student-led computer science organization at
        The University of Vermont. Established in 2010 by Anthony Sweet, Mark Cooper, and Beau Cameron, the CS-CREW serves the UVM community by providing 
        free tutoring, pre-registration help sessions, and admitted students presentations. 
        <img alt="img" class="newsImg" src="<? echo BASEDIR; ?>Views/images/photos/test1.jpg" style="padding:10px">
        <br/>
        &nbsp; &nbsp; &nbsp;Our lab is situated on the third floor of 
        <a href="http://www.uvm.edu/about_uvm/visiting/?Page=online_tour/onlinetour.php&cat=academic_admin&building=votey&SM=online_toursubmenu.html">UVM's Votey building</a>
        . All visitors are 
        invited to come by room 332 to see what exciting projects our members are working on. This year, we have been spending much of our time 
        designing our own content management system (CMS) for this website. Please have a look at our <a class="navLinks projectsLink" href=<? echo "'".BASEDIR."Projects/?display=all'";?>>
        Projects</a> page to see what else we've been up to.
      </p>
      <div class="row galleryContain">
         <div id="galleria" class="span4">
        </div>
        <div class="span6">
      <p>
        To continue our good work, we encourage all prospective and currently admitted students to one of
        UVM's Comp Sci programs, to join our group. The CS-Crew represents the best bridge between a student's academic life, and their future careers. 
        Together we work as a team, educating each other about real-world applications often not studied in the course of the typical CS student's studies. 
        Working on crew projects, students are introduced to version control systems, web-server applications, and game engines, subjects not directly taught
        in most CS cirrulicums.  
      </p>
      <br />
       <p>For students interested in joining, come by Votey 332 at the beginning of the semester to help us choose which projects we will work on during that semester, or drop us a line by
          filling our our <a class="navLinks contactLink" href=<? echo "'".BASEDIR."Default/?page=contact'";?>>
          contact form</a>. 
      </p>
        </div>
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
    if(isset($this->vars['news'])){
      foreach($this->vars['news'] as $newsPost){
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

// fire up the gallery plugin
  var basedir = <? echo "'".BASEDIR."'"; ?>;
  var initData = <?php echo isset($this->vars["galleria"]) ? $this->vars["galleria"] : '[]';?>;
  Galleria.loadTheme(basedir+'Views/js/galleria/themes/classic/galleria.classic.js');
  Galleria.configure({
    dataSource: initData
  });
  Galleria.run('#galleria');

});
</script>


