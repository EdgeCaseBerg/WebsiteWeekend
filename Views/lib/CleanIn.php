<?php
	/*****************
	 * SECURE INPUTS *
	 *****************/
	require_once( "htmlpurifier-4.1.1-standalone/HTMLPurifier.standalone.php" );
	
	class CleanIn {
		private $pure;
		
		public function __construct() {
			$this->pure = $this->initPurifier();
		}	
	
		public function clean( $input ) {
			$input = $this->deNasty( $input );
			$output = $this->pure->purify( $input );
			return $output;
		}		
		
		public function validateImage($imgFileName){
			$arr = getimagesize($imgFileName);
			if($arr[0] > 0 && $arr[1] > 0){
				return true;
			}else{
				return false;
			}
		}

		public function validateInput( $type='Text', $input ) {
			$input = $this->clean( $input );
			$type = $this->clean( $type );
			$verify = "verify$type";
			
			if( !empty( $input ) ) {
				if( $this->$verify($input) ) {
					return true;
				}
			}	
			return false;
		}
		
		// Checks for letters, numbers and dash, ?, !, and space.
		private function verifyText( $testString ) {			 
			return preg_match( "/^([[:alnum:]]|-| |\?|\!)+$/", $testString );
		}
		
		// Checks for letters only
		private function verifyAlpha( $testString ) {			
			return preg_match( '/^[a-z_ ]+$/i', $testString );
		}
		
		// Checks for letter and numbers only
		private function verifyAlphaNum( $testString ) {
			return preg_match( '/^\w{1,}$/i', $testString );
		}  

		// initializes HTML Purifier for use on user inputs
		private function initPurifier() {
			$config = HTMLPurifier_Config::createDefault();
			$config->set( 'HTML.DefinitionID', 'uvmdef' );
			$config->set( 'HTML.DefinitionRev', 1 );
			$config->set( 'Cache.DefinitionImpl', null );
			$config->set( 'HTML.AllowedElements', '' );
			$config->set( 'HTML.AllowedAttributes', '' );
			$config->set('Core.Encoding', 'UTF-8');
			$config->set('HTML.TidyLevel', 'medium' );

			return new HTMLPurifier( $config );
		}
		
		// stripslashes & htmlentities, do before validation
		private function deNasty( $variable ) {
			$variable = strip_tags( $variable );
			$variable = stripslashes( $variable );
			$variable = htmlentities( $variable, ENT_QUOTES );
			
			return $variable;
		}
	}
?>