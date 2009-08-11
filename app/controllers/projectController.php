<?php
	class ProjectController extends Zend_Controller_Action
	{
		public function init() {
			//$this->session_alert = new Zend_Session_Namespace('');
			//$this->Model = new Model();
			//$this->_helper->layout->setLayout('');
		}
		
		public function indexAction()
		{
			header("Location: /");
		}
		
		public function getoneAction() 
		{
			header("Location: /");
		}
		
		public function getallAction() 
		{
			header("Location: /");	
		}
		
		public function addoneAction() 
		{
			$this->view->project_title = $_POST['projectTitle'];
			$this->view->url = $_POST['projectUrl'];
			$this->view->author_first = $_POST['authorFirstName'];
			$this->view->author_last = $_POST['authorLastName'];
			$this->view->class_name = $_POST['class'];
			$this->view->complete_date = $_POST['dateComplete'];
			
			if (isset($_POST['photoshop'])) {
				$this->view->photoshop = $_POST['photoshop'];
			}
			if (isset($_POST['illustrator'])) {
				$this->view->illustrator = $_POST['illustrator'];
			}
			if (isset($_POST['flash'])) {
				$this->view->flash = $_POST['flash'];
			}
			if (isset($_POST['flex'])) {
				$this->view->flex = $_POST['flex'];		
			}
			if (isset($_POST['air'])) {
				$this->view->air = $_POST['air']; 
			}												  	
			if (isset($_POST['html'])) {
				$this->view->html = $_POST['html'];		
			}
			if (isset($_POST['css'])) {
				$this->view->css = 	$_POST['css'];	
			}
			if (isset($_POST['javascript'])) {
				$this->view->javascript = $_POST['javascript'];
			}
			if (isset($_POST['jquery'])) {
				$this->view->jquery = $_POST['jquery'];
			}
			if (isset($_POST['php'])) {
				$this->view->php = 	$_POST['php'];
			}												  	
			if (isset($_POST['ror'])) {
				$this->view->ror = 	$_POST['ror'];
			}
			if (isset($_POST['as2'])) {
				$this->view->as2 = 	$_POST['as2'];
			}
			if (isset($_POST['as3'])) {
				$this->view->as3 = 	$_POST['as3'];
			}
			if (isset($_POST['sql'])) {
				$this->view->sql = $_POST['sql'];
			}
			
			$this->view->assign = $_POST['assigmentSpecs'];
			$this->view->project = $_POST['projectApproach'];
		}
		
		public function photosAction() 
		{
			header("Location: /");	
		}
		
		public function addphotosAction() 
		{
			header("Location: /");
		}		
	}
	
?>