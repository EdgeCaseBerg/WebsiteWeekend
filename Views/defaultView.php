<?php
include "topBar.php";

// this is a main content page. this page sits inside, and is included by
// home.php (currently)

// each li.row is a row... duhh
// inside each li we have divs that are the cells, they are 
// styled display:inline-block with css, and are lengthened to be of
// equal height, in javascript below

?>

<div class='aboutContain'>

<ul>
  <li class="containRow row1">
    <div class="containCell leftCell">
      <ul>
        <li class="social">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/tumblr.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/reddit.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/rss.png">
          <img alt="img" class="icon" src="<? echo BASEDIR; ?>Views/css/fonts/icons/elegantmediaicons/PNG/youtube.png">
        </li>
        <li class="tools">
          <ul>
            <li><span class="shiftArrow">&#8674;</span><a href="<?= BASEDIR; ?>Tutorial/">Tutorials</a></li>
            <li><span class="shiftArrow">&#8674;</span>Code</li>
            <li><span class="shiftArrow">&#8674;</span>Books</li>
            <li><span class="shiftArrow">&#8674;</span>Articles</li>
            <li><span class="shiftArrow">&#8674;</span>GitHub</li>
          </ul>
        </li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <div class="containCell midCell">
      <?  ?>
      <p>
        &nbsp; &nbsp; &nbsp;<span class="firstLetter">W</span>e need a nice long paragraph of stuff to go here.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit 
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.<img alt="img" src="<? echo BASEDIR; ?>Views/images/photos/test1.jpg">
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
    </div>
    <div class="containCell rightCell">
      <h2>News</h2>
      <p class="newsItem">
        <span>Peer To Peer Advising Night</span><br />
        The UVM Computer Science Crew (CS Crew) held its 4th semesterly peer 
        advising night on April 4th.

        <a class="newsLink">FULL STORY >></a>
      </p>

      <p class="newsItem">
        <span>CS Crew holds Spring Course Overview</span><br />
        At the behest of the new Interim Chair of the Computer Science 
        department, Professor Jeff Dinitz, and the Computer Science Faculty, 

        <a class="newsLink">FULL STORY >></a>
      </p>
    </div>
  </li>

  <li class="containRow row2">
    <div class="containCell">

      <div id="galleria">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/1.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/2.jpg" data-title="Another title" data-description="My <em>HTML</em> description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/3.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/4.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/5.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/6.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/7.jpg" data-title="My title" data-description="My description">
        <img alt="img" src="<? echo BASEDIR; ?>Views/images/gallery/8.jpg" data-title="My title" data-description="My description">
      </div>
    </div>
    <img src="<? echo BASEDIR; ?>Views/images/wiring.png" class="wiringImg" height="300" alt="wiring" style="float:right">
  </li>

  <li class="containRow row3">
    <div class="containCell leftCell">
      <h2>News</h2>
      <p class="newsItem">
        <span>Peer To Peer Advising Night</span><br />
        The UVM Computer Science Crew (CS Crew) held its 4th semesterly peer 
        advising night on April 4th.

        <a class="newsLink">FULL STORY >></a>
      </p>

      <p class="newsItem">
        <span>CS Crew holds Spring Course Overview</span><br />
        At the behest of the new Interim Chair of the Computer Science 
        department, Professor Jeff Dinitz, and the Computer Science Faculty, 

        <a class="newsLink">FULL STORY >></a>
      </p>
    </div>
    <div class="containCell rightCell">
      <p>
        &nbsp; &nbsp; &nbsp;We need a nice long paragraph of stuff to go here.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit 
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.
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
    </div>
  </li>


</ul>
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
  Galleria.loadTheme(basedir+'Views/js/galleria/themes/classic/galleria.classic.js');
  Galleria.run('#galleria');
});
</script>
