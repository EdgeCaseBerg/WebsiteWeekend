<?php

?>
<div id="topBar">
    <!-- this is where all of our top-level nav goes, along with logo and title --> 
  <a href=<? echo "'".BASEDIR."'";?>><img alt="logo" src="<? echo BASEDIR; ?>Views/images/logo.png" class="uvmLogo"></a>
    <!--  the navbar at the top/middle of the screen -->
    <!--  Currently set to use ajax loads, but will be replaced w/ -->
    <!--  PHP loads once URL resolution is built --> 
  <ul class="mainNav">
      <li class="homeLink">
        <a class="navLinks homeLink" href=<? echo "'".BASEDIR."/'";?>>
          <div class="utf8 left"><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Home
          <div class="utf8 right"><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>             
      <li>
        <a class="navLinks projectsLink" href=<? echo "'".BASEDIR."Default/?page=projects'";?>>
          <div class="utf8 left"><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Projects
          <div class="utf8 right"><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>
      <li id="calendarLink">
        <a class="navLinks calendarLink" href=<? echo "'".BASEDIR."Default/?page=calendar'";?>>
          <div class="utf8 left"><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Calendar
          <div class="utf8 right"><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>
      <li>
        <a class="navLinks membersLink" href=<? echo "'".BASEDIR."Default/?page=members'";?>>
          <div class="utf8 left"><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Members
          <div class="utf8 right"><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>
      <li>
        <a class="navLinks contactLink" href=<? echo "'".BASEDIR."Default/?page=contact'";?>>
          <div class="utf8 left"><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Contact
          <div class="utf8 right"><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>
    <? 
  if ($_SESSION['user']->getUserAuth() > 0){ 
  echo   "<li>
        <a class='navLinks forumLink' href='".BASEDIR."Forum/?getPosts=yes'>
          <div class='utf8 left'><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Forum
          <div class='utf8 right'><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>"; 
    }else{
      echo "<li>
        <a class='navLinks helpLink' href='".BASEDIR."help/'>
          <div class='utf8 left'><!--[if !IE]> -->&#10094;<!-- <![endif]--></div>
          Get Help
          <div class='utf8 right'><!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
        </a>
      </li>";}
      ?>
  </ul>

  <!-- account management dropdown, styled with bootstrap -->
  <div class="account">
          <ul class="accountManage">
        <!-- account dropdown -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="path/to/page.html">
              Account 
                <b class="caret"></b>
            </a>
              <ul class="dropdown-menu">
                  <? if($_SESSION['user']->getUserAuth()<1){echo "<li class='login'><a href='". BASEDIR . "Default/?page=login'>Log in</a></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()<1){echo "<li class='login'><a href='". BASEDIR . "signup/'>Sign Up</a></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li class='logout'><a href='".BASEDIR."User/?logOut=yes'>Log out</a></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li class='divider'></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li><a href="."'".BASEDIR."User/?home=".$_SESSION['user']->getUserID()."'>Profile <i class='icon-user'></i></a></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li><a href="."'".BASEDIR."User/?settings=".$_SESSION['user']->getUserID()."'>Settings</a></li>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li class='divider'>";}?>
                  <? if($_SESSION['user']->getUserAuth()>=1){echo "<li><a href='".BASEDIR."messages/'>Messages</a></li>";}?>
                 
              </ul>
          </li>
        </ul>
  </div>
</div>  <!-- end topbar -->




<div id="mainContain">



