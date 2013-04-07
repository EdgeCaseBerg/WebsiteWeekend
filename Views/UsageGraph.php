<?php
	$purpose = "<option id='gpd'>Games Per Day</option>";
	$useOverTime = "<option id='hs'>High Scores</option>";
	require_once "Views/topBar.php";
?>
<script type="text/javascript">
$(document).ready(function(){
	// grab our profile data from DB
});

function getPurposeData(){
	var query = <? echo BASEDIR; ?>+"Usagedata/?data=purposeBar&output=json";
	$.getJSON(query, function(data2) {
		console.log(data);
		for(var ii =0; ii<data.length; ii++){
			$('#languagesList').append("<li class='expertiseInputItem'><input type='checkbox' lang='"+data2[ii]['language']+"' name='langs[]' value='"+data2[ii]['pkID']+"' class='langCheck'>"+data2[ii]['language']+"</li>");
		}
	});
}

function getUseOverTime(){
	var query = <? echo BASEDIR; ?>+"Usagedata/?data=purposeBar&output=json";
	$.getJSON(query, function(data2) {
		console.log(data);
		for(var ii =0; ii<data.length; ii++){
			$('#languagesList').append("<li class='expertiseInputItem'><input type='checkbox' lang='"+data2[ii]['language']+"' name='langs[]' value='"+data2[ii]['pkID']+"' class='langCheck'>"+data2[ii]['language']+"</li>");
		}
	});
}
</script>
<div class="statsContainer">
	<li class="dataControl">
		<ul>
			<li>
				Choose a data set to look at
			</li>
			<li>
				<select id="chartOptions">
					<option></option>
					<option></option>
					<option></option>
				</select>
			</li>
		</ul>
	</li>
	<li class="dataItem">
   		<ul>
   			<li class="chartInfo">
   			</li>
   			<li>
				<input type="hidden" id="chartDat" value=<?echo "'".$this->vars['graphData']."'"; ?>>
					<div id="chartdiv"></div>
			</li>
		</ul>
	</li>
</div>