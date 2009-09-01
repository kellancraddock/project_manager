<?
	require_once('../app/models/UserModel.php');
	require_once('../app/models/AccountModel.php');
	require_once('../app/models/AuthorModel.php');
	class AccountController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			$this->user_model = new UserModel();
			$this->account_model = new AccountModel();
			$this->author_model = new AuthorModel();
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
			$this->project['author'] = $this->author_model->getAll($project_id);
			$this->view->project = $this->project;
		}
		
		
		public function newAction()
		{
			
		}
		
		public function addprojectAction()
		{
			
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
				}
				header("Location: /account");
			} else {
				//Destroy Session
				Zend_Session::destroy($remove_cookie = true, $readonly = true);
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