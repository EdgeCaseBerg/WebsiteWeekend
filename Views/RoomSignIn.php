<?php
//The Header include done by the controller will give us the openning tags and such

?>
	<!--Content -->
	<div class="roomSignIn">

		<div>
			<!-- Throw UVM Pictures and such here -->
		</div>

		<div>
			<!--Main Content for Signup-->
			<fieldset>
				<legend>Sign in to use this Room!</legend>
					<form action="/RoomSignIn/login=true" method="POST">
						<span>UVM Username:</span> <input name="uvm_id" type="text" maxlength="8"/> <br />

						<span>Why are you here?</span>
						<select>
							<option value="-1">Please Select One</option>
							<?php
								//Vars will contain the list of purpose's here and this will be sent out
								foreach ($this->vars['purposes'] as $purpose) {
									echo "<option value=\"". $purpose['pkId'] ."\">";
									echo $purpose['purpose'];
									echo "</option>";
								}
							?>
						</select><br />
						<span id="desc">Brief Description of what you're working on</span>
						<textarea type="text" name="description" cols="60"></textarea><br />
						<input type="submit" value="Sign In">
					</form>
			</fieldset>
		</div>



	</body>
</html>