<?php
//The Header include done by the controller will give us the openning tags and such

?>
	<body>

		<div>
			<!-- Throw UVM Pictures and such here -->
		</div>

		<div>
			<!--Main Content for Signup-->
			<fieldset>
				<legend>Sign in to use this Room!</legend>
					<form action="/RoomSignIn/login=true" method="POST">
						UVM Username: <input name="uvm_id" type="text" maxlength="8"/> 
						Why are you here? 
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
						</select>
						<textarea type="text" name="description">
						</textarea>
						<input type="submit" value="Sign In">
					</form>
			</fieldset>
		</div>



	</body>
</html>