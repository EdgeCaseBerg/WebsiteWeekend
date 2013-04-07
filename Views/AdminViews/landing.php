<?php
	include 'Views/topBar.php';
	
?>


<div class="landingAdmin">
	<h1>Administrative Console</h1>

  <p>
    This page provides a portal to administrating content and databases.
    If you add a new admin module you will have to make an entry on this page 
    in order to be able to navigate to it without knowing the url. If you
    make a new module please remember that not everyone is a coder, so always
    provide an admin link to your tool here.
  </p>

  <ul>
    <li>
      <h2>News</h2>
      <p>
        Create,edit and remove news stories. Upload images and write new content.
      </p>
      <a href="/Admin/?news=new">Manage News</a>
    </li>
    <li>
      <h2>Hours</h2>
      <p>
        Update,Add, and remove Volunteer Help  Hours for active CS Crew Members
      </p>
      <a href="/Admin/?hours=display">Manage Hours</a>
    </li>
    <li>
      <h2>Contact</h2>
      <p>
        Manage who recieves emails from the contact us page.
      </p>
      <a href="/Admin/?contact=display">Manage Contact Us</a>
    </li>
    <li>
      <h2></h2>
    </li>
    <li>
      <h2>Crew Members</h2>
      <p>
        Manage which members are active, ban lists, and authorization levels.
      </p>
      <a href="/Admin/?members=display">Manage Crew Members</a>
    </li>
  </ul>

</div>