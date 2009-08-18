<?php
	class Helper_Languages extends Zend_Controller_Action_Helper_Abstract
	{
		public function getLanguages()
		{
			$languages = array();
			
			if (isset($_POST['html'])) {
				$languages[] = $_POST['html'];
			}
			if (isset($_POST['css'])) {
				$languages[] = $_POST['css'];
			}
			if (isset($_POST['javascript'])) {
				$languages[] = $_POST['javascript'];
			}
			if (isset($_POST['jquery'])) {
				$languages[] = $_POST['jquery'];
			}
			if (isset($_POST['php'])) {
				$languages[] = $_POST['php'];
			}
			if (isset($_POST['ror'])) {
				$languages[] = $$_POST['ror'];
			}
			if (isset($_POST['as2'])) {
				$languages[] = $_POST['as2'];
			}
			if (isset($_POST['as3'])) {
				$languages[] = $_POST['as3'];
			}
			if (isset($_POST['sql'])) {
				$languages[] = $_POST['sql'];
			}
			return $languages;
		}
		
	}
?>