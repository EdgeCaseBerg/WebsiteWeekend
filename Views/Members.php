<?php
require_once "topBar.php";
?>

<script type="text/javascript">
$('.membersLink').css({'color' : '#00774B'});
var $thisUTF8 = $('a.membersLink').find('.utf8');
$thisUTF8.addClass("utf8Active");
</script>
	<div class="membersContain">
		<div class="contentHeader"><!--[if !IE]> -->&#10094;<!-- <![endif]-->Members<!--[if !IE]> -->&#10095;<!-- <![endif]--></div>
		<table class="table table-striped members">
		  <thead>
		    <tr>
		      <th>Name</th>
		      <th>Year</th>
		      <th>Major</th>
		      <th>Contact Info</th>
		      <th>Website</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>josh</td>
		      <td>Junior</td>
		      <td>CS-CIS</td>
		      <td>email</td>
		      <td>joshuadickerson.com</td>
		    </tr>
		    <tr>
		      <td>Ethan</td>
		      <td>Senior</td>
		      <td>CS</td>
		      <td>email</td>
		      <td>Ethan.com</td>
		    </tr>
		    <tr>
		      <td>Garth</td>
		      <td>Senior</td>
		      <td>CS</td>
		      <td>email@email.com</td>
		      <td>Garth.com</td>
		    </tr>
		  </tbody>
		</table>
</div>