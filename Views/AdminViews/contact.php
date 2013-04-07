<?php
	include 'Views/topBar.php';
	$none = false;
	if(!isset($this->vars['emails'])){
		$none = true;
	}
?>


<div class="contactAdmin">
	<h3>Contact Form Administration</h3>

	<div>
		<p>
			This page administers who the contact form will email. Simply use the add form to add more emails 
			(do this if you have a bad habit of not checking the CS Crew email) or use the delete button to remove emails.
		</p>

		<fieldset>
			<legend>Add an email</legend>
			<input type="text" name="email" id="emailAdd"/>
		</fieldset>
		<ul>
			<?php
				if($none){
					echo '<li id="none" >No Emails on record!</li>';
				}else{
					foreach ($this->vars['emails'] as $email) {
						echo '<li id="'.$email['pkID'].'">'.$email['email'].'</li>';
					}
				}
				
			?>
		</ul>
	</div>


</div>