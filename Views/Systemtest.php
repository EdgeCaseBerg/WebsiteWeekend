<?php
echo "<h1>Testbed</h1>";
// test the database
if(isset($this->vars['dbObj'])){
	$dbError = $this->vars['dbObj']->getError();
	if($dbError){
		echo $dbError;
	}else{
		echo "Db connected<br />";
	}
}
?>