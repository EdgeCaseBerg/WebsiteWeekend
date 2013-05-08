<?php
	include 'Views/topBar.php';
	$none = false;
	if(!isset($this->vars['members'])){
		$none = true;
	}
?>


<div class="memberAdmin">
	<h3>Members Administration</h3>

	<div>
		<p>
			This page administers the members of the CS Crew website. This includes both CS Crew members and people who
      sign up. From this page you can designate someone as an active CS Crew Member (so that they can have volunteer help hours),
      set permissions for administration, and ban users.
		</p>
    <p>
      <ul>
        <li>To activate a member as a CS Crew Member simply check the Active checkbox</li>
        <li>To change a user to be an administrator give them an Auth Level of 3</li>
        <li>To ban a user set their Auth Level to Banned</li>
        <li>To delete a user, click the delete button and comfirm. <span style="color:#ff0000">This is Permanent</span></li>
      </ul>
    </p>
    <p>
        <div id="message"><br/></div>
    </p>
    <table>
      <thead>
        <th>Account</th>
        <th colspan="2">Name</th>
        <th>Email</th>
        <th>Active</th>
        <th>Auth Level</th>
        <th>Banned</th>
        <th>Delete</th>
      </thead>
    <?php
      $i=1;
      foreach ($this->vars['members'] as $member) {
        echo '<tr ' . ($i % 2==0 ? 'class="alt"' : '') . '>';
        echo '<td>' . $member['username'] . '</td>';
        echo '<td>' . $member['fname'] . '</td>' . '<td class="noline">' . $member['lname'] . '</td>';
        echo '<td>' . $member['email'] . '</td>';
        echo '<td rel="'.$member['pkUserID'].'">' . '<input type="checkbox" class="activeMem" rel="'.$member['pkUserID'].'" ' . ($member['active'] == 1 ? 'checked' : '') . '/>' . '</td>';
        ?>
        <td>
          <select class="authLevel" rel="<?= $member['pkUserID'] ?>">
            <option value="-1">Banned</option>
            <?php
              for ($j=1; $j < 4; $j++) { 
                if($member['auth']==$j){
                  echo '<option value="'.$j.'" selected >'.$j.'</option>';
                }else{
                  echo '<option value="'.$j.'" >'.$j.'</option>';
                }
              }
            ?>
          </select>
        </td>
        <?
        echo '<td name="ban" rel="'.$member['pkUserID'].'">' . ($member['auth'] < 0 ? 'Yes' : 'No') . '</td>'; 
        echo '<td class="deleteMem" rel="'.$member['pkUserID'].'"><a href="" onclick="return false;" >Delete</a></td>';
        echo '</tr>';
        $i=$i+1;
      }
    ?>
    </table>
	
	</div>


  <?php
    if($this->vars['startLimit'] > 14){?>
    <form id="prev" action="<?= BASEDIR . 'Admin/?members=display' ?>" method="POST" >
        <input type="hidden" name="startLimit" value="<?= $this->vars['startLimit'] - 15?>" />
        <input type="submit" value="Previous Page" />
    </form>
    <?
    }
    if($this->vars['memberCount'] -15 > $this->vars['startLimit']){
  ?>
    <form id="next" action="<?= BASEDIR . 'Admin/?members=display' ?>" method="POST" >
        <input type="hidden" name="startLimit" value="<?= $this->vars['startLimit'] + 15?>" />
        <input type="submit" value="Next Page" />
    </form>
  <?
    }
  ?>
  <div class="giveMeMoreSpace"></div>
</div>

<script>
  var base = "<?= BASEDIR ?>";
	$('.activeMem').bind('click',function(){
      //Send the id and the active state to the server to update
      var id = $(this).attr('rel');
      //They click it, they're changing it
      var on = $(this).is(':checked');
      $.ajax({
          type: "POST",
          url: base+'Admin/?members=active',
          data: "id="+id+"&active="+on,
          success: function(){
              //This will succeed. Guarantee.
              $('#message').html('Set Member with ID ' + id + " to active=" + on);
          }
      });
  });
  $('.authLevel').bind('change', function(){
    var id = $(this).attr('rel');
    var auth = $(this).val();
    $.ajax({
          type: "POST",
          url: base+'Admin/?members=changeAuth',
          data: "id="+id+"&auth="+auth,
          success: function(){
              //This will succeed. Guarantee.
              $('#message').html('Set Member with ID ' + id + " to Auth Level=" + auth);
              if(auth < 0){
                //Set ban text
                $('td[name=ban][rel='+id+']').html('Yes');
              }else{
                $('td[name=ban][rel='+id+']').html('No');
              }
          }
      });
  });
  $('.deleteMem').bind('click',function(){
    var id = $(this).attr('rel');
    toDel = $(this);
    
    //Ask to make sure
    if(confirm("Are you sure you want to delete this user?")){
      $.ajax({
          type: "POST",
          url: base+'Admin/?members=delete',
          data: "id="+id,
          success: function(){
              //This will succeed. Guarantee.
              $('#message').html('Deleted member');
              //Remove that row
              toDel.closest('tr').remove();
          }
      }); 
    }
  });
</script>