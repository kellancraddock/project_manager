<?php
	require_once('../app/models/ProjectModel.php');
	
	class AdminController extends Zend_Controller_Action
	{
		public function indexAction()
		{
				
		}
		
		public function allAction()
		{
			$this->project_model = new ProjectModel();
			$this->view->projects = $this->project_model->getAll();
		}
		
		public function singleAction()
		{
			
		}
		
		
	}
	
?>