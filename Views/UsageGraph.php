<?php
	$purpose = "<option id='purpose' value='purpose'>Students by Purpose</option>";
	$useOverTime = "<option id='usage' value='spd'>Students per Day</option>";
	require_once "Views/topBar.php";
?>
<script type="text/javascript" src=<?= "\"".BASEDIR."Views/js/amcharts/amcharts.js"."\""; ?>></script>
<script type="text/javascript">
<?
	if($this->vars['graphType'] == "line"){
		echo "var chartData = ".json_encode($this->vars['graphData']).";";
	    $chartJS = file_get_contents("Views/js/lineChart.js");
	    echo $chartJS;
	}else if($this->vars['graphType'] == "column"){
		echo "var chartData = ".json_encode($this->vars['graphData']).";";
		$chartJS = file_get_contents("Views/js/3dColumnStack.js");
		echo $chartJS;
	}
?>

$(document).ready(function(){
	$('#chartOptions').change(function(){
    	var val = $('#chartOptions option:selected').text();
    	if(val == "Students per Day"){
    		window.location.replace(<?= "\"".BASEDIR."Usagedata/?data=visitsOverTime\"";?>);
    	}else if(val == "Students by Purpose"){
    		window.location.replace(<?= "\"".BASEDIR."Usagedata/?data=purposeBar\"";?>);
    	}
    });
});
</script>
<div class="statsContainer">
	<li class="dataControl">
		<ul>
			<li>
				Choose a data set to look at
			</li>
			<li>
				<select id="chartOptions">
					<? 
						if($this->vars['graphType'] == "line"){
							echo $useOverTime.$purpose;
						}else{
							echo $purpose.$useOverTime;
						}
					?>
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
					<div id="chartdiv" style="height:400px; width:90%; border:solid 1px #ccc; padding:10px"></div>
			</li>
		</ul>
	</li>
</div>