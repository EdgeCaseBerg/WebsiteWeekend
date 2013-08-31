<?php
require_once "topBar.php";

function milToAMPM($hour){
	//Takes something like 00:15:30 and converts it to 3:00pm
	$temp = explode(':', $hour);
	$AMPM = 'am';
	if(intval($temp[1]) > 11){
		$AMPM = 'pm';
		if(intval($temp[1]) > 12){
			$temp[1] = intval($temp[1]) % 12;	
		}
	}
	return $temp[1] . ':' . $temp[2] . $AMPM;
}

?>

<div class="hoursPage">

	<h3>Volunteer Help Hours Admin View</h3>

	<hr>

	<p>
		Use the box below to add new hours, or click the hours themselves to edit them.
	</p>

	<div class="adminHours">
		<ul>
		<?php
			if(isset($this->vars['errors'])){
				foreach ($this->vars['errors'] as $key => $error) {
					echo "<li>" . $error . '</li>';
				}
				
			}
		?>
		</ul>
		<form action="<?php echo BASEDIR;?>Admin/?hours=new" method="POST">
			<select name="memberID">
				<option value="-1" >Select Crew Member</option>
				<?php
					//Get the active crew members and their ids'
					foreach ($this->vars['members'] as $member) {
						echo '<option value ="' . $member['fkUserID'] . '">';
						echo $member['fldFirstName'] . ' ' . $member['fldLastName'];
						echo "</option>";
					}
				?>
			</select>
			<select name="day">
				<option value="Mon">Monday</option>
				<option value="Tues">Tuesday</option>
				<option value="Wednes">Wednesday</option>
				<option value="Thurs">Thursday</option>
				<option value="Fri">Friday</option>
			</select>
			<br />
			<table>
				<tr>
					<td colspan="3">Enter Hours in military time:</td>
				</tr>
				<tr>
					<td class="left">Begin Hour:</td>
					<td class="right"><input type="text" size="2" width="2em" maxlength="2" name="bigHand" /></td>
					<td class="right"><input type="text" size="2" width="2em" maxlength="2" name="littleHand" /></td>
				</tr>
				<tr>

					<td class="left">End Hour:</td>
					<td class="right"><input type="text" size="2" width="2em" maxlength="2" name="bigHand2" /></td>
					<td class="right"><input type="text" size="2" width="2em" maxlength="2" name="littleHand2" /></td>
				</tr>

			</table>
			<input id="submit" type="submit" value="Add Hours">

		</form>
	</div>

	<div class="hours">	
		<table>
			<thead>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
			</thead>
			<tbody>
				<?php
				$maxDepth = 0;
				$days = array('Mon','Tues','Wednes','Thurs','Fri');
				$hours = array(	'Mon'=>array(),
								'Tues'=>array(),
								'Wednes'=>array(),
								'Thurs'=>array(),
								'Fri'=>array()
							  );
				foreach ($this->vars['hours'] as $member) {
					//Add this member to the correct day
					$hours[$member['day']][] = $member;
					//Figure out the maximal depth of the subarrays
					if(count($hours[$member['day']]) > $maxDepth){
						$maxDepth = count($hours[$member['day']]);
					}
				}
				for ($i=0; $i < $maxDepth; $i++) { 
					echo '<tr class="'. ($i%2==0 ? 'alt' : '') .'">';
					foreach ($hours as $day => $hoursOnDay) {
						if(isset($hoursOnDay[$i])){
							if(strcmp($day, $hoursOnDay[$i]['day'])==0){
								echo '<td>';
								echo $hoursOnDay[$i]['fldFirstName'] . ' ' . $hoursOnDay[$i]['fldLastName'] . '<br />';
								echo '<span class = "edit" id="'.$hoursOnDay[$i]['fkUserID'].'|'.$hoursOnDay[$i]['day'].'|'. $hoursOnDay[$i]['hour'].'|'.'" >';
								echo milToAMPM($hoursOnDay[$i]['hour']);
								echo '-'. milToAMPM($hoursOnDay[$i]['endHour']);
								echo '</span><br />';
								echo '<a href="" onclick="return false;" class="remove" id="'.$hoursOnDay[$i]['fkUserID'].'|'.$hoursOnDay[$i]['day'].'|'. $hoursOnDay[$i]['hour']. '">Delete</a>';
								echo '</td>';
							}else{
								echo '<td></td>';
							}
						
						}else{
							echo '<td></td>';
						}
					}
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- Add jQuery and ajax to make things editable-->
	<script type="text/javascript">
	//Bind the span with a click so we can click to edit
	$('span.edit').click(function(){  
  
 		$('.ajax').html($('.ajax input').val());  
 		$('.ajax').removeClass('ajax');  
  
 		$(this).addClass('ajax');  
 		$(this).html(' <input id="editbox" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '">');  
  
		$('#editbox').focus();                                        
	} );  
	//Ajax call on enter
	$('span.edit').keydown(function(event){  
    	if(event.which == 13){  
      		$.ajax({    type: "POST",  
      					url:"/Admin/?hours=id",  
      					data: "id="+$('.ajax').attr('id')+"&new=" +$('.ajax input').val(),
      					success: function(data){  
      						var oldid = $('.ajax').attr('id').split("|");
      						var tmpTime = $('.ajax input').val().split(":");
      						//convert it to military time
      						console.log(data);
      						var bigHand = data.newHour.toString().substr(0,2);
      						var littleHand = data.newHour.toString().substr(2,2);
      						var newTime = '00:' + bigHand + ':' + littleHand;
      						
      						//Update the id so we can edit more than once
      						$('.ajax').attr('id',oldid[0]+"|"+oldid[1]+"|"+newTime);
       						$('.ajax').html($('.ajax input').val());  
        					$('.ajax').removeClass('ajax');  
       		}});  
    	}  
	    //Remove input box if they click outside of it
	    $('#editbox').live('blur',function(){  
	        $('.ajax').html($('.ajax input').val());  
	        $('.ajax').removeClass('ajax');  
		});
	});  
	
	//Add a 0 if the bit in the input box is a single didigt
	$('.right').live('blur',function(){
		var contents = $(this).find('input').val();
		if(contents.length == 1){
			$(this).find('input').val('0' + contents);
		}
	});

	//Delete an hour
	$('.remove').bind('click',function(){
		if(confirm('Are you sure you want to remove this help hour?')){
			$.ajax({    type: "POST",  
      					url:"../Admin/?hours=delete",  
      					data: "id="+$(this).attr('id'),
      					success: function(data){
      						if(data.success){
      							alert('Help hour deleted!');
      							window.location = '../Admin/?hours=display';
      						}else{
      							alert('There was a problem removing the help hour');
      						}
      					}
      				});
		}else{
			//Do Nothing
		}
	});

	</script>

</div>

<?php
require_once "footer.php";
?>