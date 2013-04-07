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

	<p class="admin">
		<form action="/Admin/hours=new" method="POST">
			<select>
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
			<p>
				Enter Hours in military time:
			</p>
			<table>
				<tr>
					<td class="left">
						Hour:
					</td>
					<td class="right"> 
						<input type="text" size="2" width="2em" maxlength="2" name="bigHand" />
					</td>
				</tr>
				<tr>
					<td class="left">
						Minutes:
					</td>
					<td class="right">
						<input type="text" size="2" width="2em" maxlength="2" name="littleHand" />
					</td>
				</tr>

			</table>
			<input type="submit" value="Add Hours">

		</form>
	</p>

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
								echo '<span class = "edit" id="'.$hoursOnDay[$i]['fkUserID'].'|'.$hoursOnDay[$i]['day'].'|'. $hoursOnDay[$i]['hour'].'" >';
								echo milToAMPM($hoursOnDay[$i]['hour']);
								echo '</span>';
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
      						var tmpTime = $('.ajax input').val().split("|");
      						//convert it to military time
      						var bigHand = parseInt(tmpTime[0]);
      						var littleHand = parseInt(tmpTime[1].substr(0,2));
      						var ampm = $tmpTime[1].substr(2,2);
      						if(ampm == 'am'){
      							if(bigHand==12){
      								bigHand = '00';
      							}
      						}else{
      							if(bigHand < 12){
      								bigHand = bigHand + 12;
      							}
      						}
      						var newTime = bigHand.toString() + littleHand.toString();
      						console.log(newTime);

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

	</script>

</div>

<?php
require_once "footer.php";
?>