<?php
require_once "topBar.php";
?>

<script type="text/javascript">
$('.calendarLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.calendarLink').find('.utf8');
$thisUTF8.addClass("utf8Active");

</script>

<div class="calendar">
 	<iframe id="calendarFrame" src="https://www.google.com/calendar/embed?gsessionid=DxLbahZMFxwsUbWwaOLyQQ" style=" border:none; width:100%; height:600px;"></iframe>
</div>


