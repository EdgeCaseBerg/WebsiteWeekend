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
			<p>
				Type an email in the box and hit enter!
			</p>
			<input type="text" name="email" id="emailAdd"/>
		</fieldset>
		<fieldset>
			<legend>Edit/Delete an email</legend>
			<p>
				Click an email to edit it, click delete to delete it.
			</p>
			<ul>
				<?php
					if($none){
						echo '<li id="none" >No Emails on record!</li>';
					}else{
						foreach ($this->vars['emails'] as $email) {
							echo '<li id="'.$email['pkID'].'"><a href="" onclick="return false;" class="edit" rel="'.$email['pkID'].'"">'.$email['email'].'<a>';
							echo '<a href="" class="delete" onclick="return false;" rel="'.$email['pkID'].'" > &nbsp;Delete</a></li>';
						}
					}
					
				?>
			</ul>
		</fieldset>
	</div>
</div>

<script>
	//Adding a new email
	$('#emailAdd').keydown(function(event){  
    	if(event.which == 13){
    		//Go and add it to the database
    		$.ajax({    type: "POST",  
      					url:"<?= BASEDIR ?>/Admin/?contact=add",  
      					data: "email="+$(this).val(),
      					success: function(data){
      						if(data.success){
      							window.location
= '<?= BASEDIR ?>/Admin/?contact=display';
      						}else{
      							alert('There was a problem adding the email');
							alert(data);
      						}
      					}
      				});
    	}
    });
    //Editing a current email
    $('.edit').bind('click',function(){
    	$('.ajax').html($('.ajax input').val());  
 		$('.ajax').removeClass('ajax');  
  
 		$(this).addClass('ajax');  
 		$(this).html(' <input id="editbox" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '">');  
  
		$('#editbox').focus();                                        
    });
    $('.edit').keydown(function(event){
    	if(event.which == 13){
    		var id=$(this).attr('rel');
    		var newEmail = $('.ajax input').val();
    		$.ajax({
    			type: "POST",
    			url: "<?= BASEDIR ?>/Admin/?contact=edit",
    			data: "id="+id+"&newEmail="+newEmail,
    			success: function(data){
    				if(!data.success){
    					alert('Not able to update for some reason. Check the logs');
    				}
    			}
    		});
    		
    		$('.ajax').html($('.ajax input').val());  
        	$('.ajax').removeClass('ajax');  
    	}
    });
	$('#editbox').live('blur',function(){  
	        $('.ajax').html($('.ajax input').val());  
	        $('.ajax').removeClass('ajax');  
	});
    //Delete an email
    $('.delete').bind('click',function(){
    	if(confirm('Are you sure you want to delete this email?\nCannot be undone.')){
    		$.ajax({
    			type: "POST",
    			url:"<?= BASEDIR ?>/Admin/?contact=delete",
    			data: "id="+$(this).attr('rel'),
    			success: function(data){
    				if(data.success){
      					window.location = '<?= BASEDIR
?>/Admin/?contact=display';
      				}else{
      					alert('There was a problem deleting the email');
      				}
    			}
    		});
    	}
    });

</script>
