<?php
	require_once('../app/models/CommentModel.php');
	class CommentController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			$this->comment_model = new CommentModel();
		}
		
		public function newAction()
		{
			$project_id = $this->_request->getParam('project');
			$user_id = $this->_request->getParam('user');
			//Validate here
			$this->comment_model->addOne($project_id, $user_id, $_POST['comment_box']);
			header("Location: /admin/project/id/{$project_id}");
		}
		
		public function deleteAction()
		{
			$comment_id = $this->_request->getParam('id');
			//Validate here
			$this->comment_model->deleteOne($comment_id, $this->user_session->id);
			header("Location: /admin/project/id/{$project_id}");
		}
	}
	
?>