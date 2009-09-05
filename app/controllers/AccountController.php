<?
	require_once('../app/models/UserModel.php');
	require_once('../app/models/AccountModel.php');
	require_once('../app/models/AuthorModel.php');
	require_once('../app/models/ProjectModel.php');
	require_once('../app/models/ImageModel.php');
	require_once('../app/models/ToolModel.php');
	require_once('../app/models/CommentModel.php');
	require_once('../app/models/LanguageModel.php');
	class AccountController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			$this->user_model = new UserModel();
			$this->account_model = new AccountModel();
			$this->author_model = new AuthorModel();
			$this->project_model = new ProjectModel();
			$this->image_model = new ImageModel();
			$this->tool_model = new ToolModel();
			$this->comment_model = new CommentModel();
			$this->language_model = new LanguageModel();
		}
		
		public function indexAction()
		{
			if (!isset($this->user_session->id)) {
				header("Location: /login");
			} else {
				$this->view->projects = $this->account_model->getAll($this->user_session->id);
			}
		}
		
		public function projectAction()
		{
			$project_id = $this->_request->getParam('id');
			$this->project = $this->account_model->getOne($project_id, $this->user_session->id);
			if (!$this->project) {
				//Project does not exist or is not owned by user
				header("Location: /account");
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
		}
		
		
		public function newAction()
		{
			
		}
		
		public function addprojectAction()
		{
			
		}
		
		
		public function addimagesAction()
		{
			//Verify Ownership
			$project_id = $this->_request->getParam('id');
			$project_helper = $this->_helper->Projects;
			if(!$project_helper->isOwner($this->user_session->id, $project_id, $this->project_model)) {
				header("Location: /account");
			} else {
				$this->view->id = $project_id;
				$this->view->images = $this->image_model->getAll($project_id);
			}
		}
		
		public function createAction()
		{
			//validate and confirm pass here and check to see if email already exists
			$arguments = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['security_question'], $_POST['security_answer']);
			$succcess = $this->user_model->addOne($arguments);
			if ($success) {
				header("Location: /account");
			} else {
				header("Location: /account/new");
			}
		}
		
		public function loginAction()
		{
			//validate and confirm pass here
			$arguments = array($_POST['email'], $_POST['password']);
			$logged_in = $this->user_model->login($arguments);
			if ($logged_in) {
				foreach ($logged_in as $user) {
					$this->user_session->id = $user['id'];
					$this->user_session->first_name = $user['first_name'];
					$this->user_session->last_name = $user['last_name'];
					$this->user_session->is_admin = $user['admin'];
				}
				
				if ($this->user_session->is_admin) {
					header("Location: /admin");
				} else {
					header("Location: /account");
				}

			} else {
				//Destroy Session
				header("Location: /account/logout");
			}
		}
		
		public function logoutAction()
		{
			//Destroy Session
			Zend_Session::destroy($remove_cookie = true, $readonly = true);
			header("Location: /login");

		}
		
		
	}
	
?>