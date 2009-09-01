<?php
	class LoginController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
		}
		
		public function indexAction()
		{
			
		}
	}
?>