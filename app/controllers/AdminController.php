<?php
	require_once('../app/models/UserModel.php');
	require_once('../app/models/AuthorModel.php');
	require_once('../app/models/ProjectModel.php');
	require_once('../app/models/ImageModel.php');
	require_once('../app/models/ToolModel.php');
	require_once('../app/models/LanguageModel.php');
	require_once('../app/models/CommentModel.php');
	require_once('../app/models/AdminModel.php');
	class AdminController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			if (!$this->user_session->is_admin) {
				header("Location: /account/logout");
			}
			
			$this->admin_model = new AdminModel();
			$this->author_model = new AuthorModel();
			$this->image_model = new ImageModel();
			$this->tool_model = new ToolModel();
			$this->language_model = new LanguageModel();
			$this->user_model = new UserModel();
			$this->comment_model = new CommentModel();
		}
		
		public function indexAction()
		{
			$this->view->projects = $this->admin_model->getAll();
		}
		
		public function projectAction()
		{
			$project_id = $this->_request->getParam('id');
			$this->project = $this->admin_model->getOne($project_id);
			
			if (!$this->project) {
				//Project does not exist
				header("Location: /admin");
			}
			$this->project['author'] = $this->author_model->getAll($project_id);
			$this->project['images'] = $this->image_model->getAll($project_id);
			$this->project['tools'] = $this->tool_model->getAll($project_id);
			$this->project['language'] = $this->language_model->getAll($project_id);
			$comments = $this->comment_model->getAll($project_id);
			foreach ($comments as &$comment) {
				$comment['first_name'] = $this->user_model->getOne($comment['user_id']);
			}
			$this->project['comments'] = $comments;
			
			$this->view->project = $this->project;
			$this->view->user_id = $this->user_session->id;
		}
	}
	
?>