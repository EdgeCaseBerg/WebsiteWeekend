<?php
header('Content-type: application/json');
$json = json_encode($this->vars);
echo $json;
?>