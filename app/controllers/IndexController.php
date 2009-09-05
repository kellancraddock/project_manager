<?php
	require_once('../app/models/AuthorModel.php');
	require_once('../app/models/ImageModel.php');
	require_once('../app/models/ToolModel.php');
	require_once('../app/models/LanguageModel.php');
	require_once('../app/models/ProjectModel.php');
	class IndexController extends Zend_Controller_Action
	{
		public function init() {
			$this->user_session = new Zend_Session_Namespace('user');
			$this->author_model = new AuthorModel();
			$this->image_model = new ImageModel();
			$this->tool_model = new ToolModel();
			$this->language_model = new LanguageModel();
			$this->project_model = new ProjectModel();
		}
		
		public function indexAction()
		{
			$this->view->projects = $this->project_model->getAll();
			$this->view->user_id = $this->user_session->id;
		}
		
		public function projectAction()
		{
			$project_id = $this->_request->getParam('id');
			$this->project = $this->project_model->getOne($project_id);

			if (!$this->project) {
				//Project does not exist or is not owned by user
				header("Location: /");
			}
			$this->project['author'] = $this->author_model->getAll($project_id);
			$this->project['images'] = $this->image_model->getAll($project_id);
			$this->project['tools'] = $this->tool_model->getAll($project_id);
			$this->project['language'] = $this->language_model->getAll($project_id);

			$this->view->project = $this->project;
		}
		
	}	
?>