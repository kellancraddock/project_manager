<?php
	class Helper_Tools extends Zend_Controller_Action_Helper_Abstract
	{
		public function getTools()
		{
			$tools = array();
			if (isset($_POST['photoshop'])) {
				$tools[] = $_POST['photoshop'];
			}
			if (isset( $_POST['illustrator'])) {
				$tools[] = $_POST['illustrator'];
			}
			if (isset($_POST['flash'])) {
				$tools[] = $_POST['flash'];
			}
			if (isset( $_POST['flex'])) {
				$tools[] = $_POST['flex'];
			}
			if (isset($_POST['air'])) {
				$tools[] = $_POST['air'];
			}
			return $tools;	
		}
	}
?>