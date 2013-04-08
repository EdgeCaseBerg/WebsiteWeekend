<?php
	include 'Views/topBar.php';
	
?>


<div class="landingAdmin">
	<h1>Administrative Console</h1>

  <div>
    This page provides a portal to administrating content and databases.
    If you add a new admin module you will have to make an entry on this page 
    in order to be able to navigate to it without knowing the url. If you
    make a new module please remember that not everyone is a coder, so always
    provide an admin link to your tool here.
  </div>

  <ul>
    <li>
      <h2>News</h2>
      <a href="<?= BASEDIR ?>Admin/?news=new">
        <p>
          Create,edit and remove news stories. Upload images and write new content.
        </p>
        <h3>Manage News</h3>
      </a>
    </li>
    <li>
      
      <h2>Hours</h2>
      <a href="<?= BASEDIR ?>Admin/?hours=display">
        <p>
          Update,Add, and remove Volunteer Help  Hours for active CS Crew Members
        </p>
        <h3>Manage Hours</h3>
      </a>
    </li>
    <li>
      <h2>Contact</h2>
      <a href="<?= BASEDIR ?>Admin/?contact=display">
        <p>
          Manage who recieves emails from the contact us page.
        </p>
        <h3>Manage Contact Us</h3>
      </a>
    </li>
    <li>
      <h2>Crew Members</h2>
      <a href="<?= BASEDIR ?>Admin/?members=display">
        <p>
          Manage which members are active, ban lists, and authorization levels.
        </p>
        <h3>Manage Crew Members</h3>
      </a>
    </li>
    <li>
      <h2>Faculty Reports</h2>
      <a href="<?= BASEDIR ?>Usagedata/?reports=display">
        <p>
          See reports about the Lab's Usage, broken out by categories.
        </p>
        <h3>Show Reports</h3>
      </a>
    </li>
    <li>
      <h2>Room Login</h2>
      <a href=<?= "'".BASEDIR."RoomSignIn/"."'";?>>
        <p>
          The sign in page for Room 332. Click here to boot up the kiosk
        </p>
        <h3>Room Sign In</h3>
      </a>
    </li>
  </ul>

</div>