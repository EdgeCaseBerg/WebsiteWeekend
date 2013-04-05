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
					<form>
						UVM Username: <input name="uvm_id" type="text" maxlength="8"/> 
						Why are you here? 
						<select>
							<?php
								//Vars will contain the list of purpose's here and this will be sent out
								foreach ($this->vars['purposes'] as $purpose) {
									print_r($purpose,true);
								}
							?>
						</select>
					</form>
			</fieldset>
		</div>



	</body>
</html>