<?php
	require_once('../app/models/ProjectModel.php');
	require_once('../app/models/ToolModel.php');
	require_once('../app/models/LanguageModel.php');
	require_once('../app/models/AuthorModel.php');
	
	class ProjectController extends Zend_Controller_Action
	{
		public function init() {
			$this->user_session = new Zend_Session_Namespace('user');
			$this->project_model = new ProjectModel();
			$this->tool_model = new ToolModel();
			$this->language_model = new LanguageModel();
			$this->author_model = new AuthorModel();
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
		
		public function createAction() 
		{
			$user_id = $this->user_session->id;
			$tools_helper = $this->_helper->Tools;
			$tools = $tools_helper->getTools();
			
			$languages_helper = $this->_helper->Languages;
			$languages = $languages_helper->getLanguages();
			
			$projects = array($_POST['projectTitle'], $_POST['projectUrl'], $_POST['class'], $_POST['dateComplete'], $_POST['assigmentSpecs'], $_POST['projectApproach']);
			
			$authors = array($_POST['authorFirstName'], $_POST['authorLastName']);
			
			$project_id = $this->project_model->addOne($projects, $user_id);
			
			$this->author_model->addOne(array($project_id), $authors);
			
			foreach (array($tools) as $tool) {
				$this->tool_model->addOne(array($project_id), $tool);
			}
			
			foreach (array($languages) as $language) {
				$this->language_model->addOne(array($project_id), $language);
			}
			//Go back to index
			header("Location: /account");
			//Pass project id to view
			//$this->view->project_id = $project_id;
			
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