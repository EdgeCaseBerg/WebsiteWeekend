<?php
//The Header include done by the controller will give us the openning tags and such
if(isset($this->vars['success'])){
	//We logged the usage.
	unset($this->vars['errors']);
	$_POST['purpose'] = -1;
	$_POST['description'] = "";
	unset($_POST['uvm_id']);
	echo "
		<script>
			alert('Thanks for signing in!');
		</script>
	";
}
?>
	<!--Content -->
	<div class="roomSignIn">

		<div id="errors">
			<!-- Throw UVM Pictures and such here -->
				<?php
				if(isset($this->vars['errors'])){
					echo '<h2>Invalid Fields are marked in Red <br/> Please Correct the information </h2>';
				}
				?>
		</div>

		<div>
			<!--Main Content for Signup-->
			<fieldset>
				<legend>Sign in to use this Room!</legend>
					<form action="/RoomSignIn/?login=true" method="POST">
						<table>
							<tr>
								<td>
									<span <?= isset($this->vars['errors']['uvm']) ? 'class="error"' : '';?>>UVM Username:</span> 
								</td>
								<td>
									<input name="uvm_id" type="text" maxlength="8" value="<?= isset($_POST['uvm_id']) ? $_POST['uvm_id'] : ''; ?>"/> 
								</td>
							</tr>
							<tr>
								<td>
									<span <?= isset($this->vars['errors']['purpose']) ? 'class="error"' : '';?>>Why are you here?</span>
								</td>
								<td>
									<select name="purpose">
										<option value="-1">Please Select One</option>
										<?php
											//Vars will contain the list of purpose's here and this will be sent out
											foreach ($this->vars['purposes'] as $purpose) {
												if($_POST['purpose'] == $purpose['pkId']){
													echo "<option value=\"". $purpose['pkId'] ."\" selected=\"selected\">";
												}else{
													echo "<option value=\"". $purpose['pkId'] . "\">";
												}
												echo $purpose['purpose'];
												echo "</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</table>
						<span id="desc">Brief Description of what you're working on</span>
						<textarea type="text" name="description" cols="60" ><?= $_POST['description']; ?></textarea><br />
						<input type="submit" value="Sign In">
					</form>
			</fieldset>
		</div>



	</body>
</html>