<?
	require_once('../app/models/UserModel.php');
	class AccountController extends Zend_Controller_Action
	{
		public function init()
		{
			$this->user_session = new Zend_Session_Namespace('user');
			$this->user_model = new UserModel();
		}
		
		public function indexAction()
		{
			(isset($this->user_session->id)) ? $this->view->loggedin = 1 : $this->view->loggedin = 0;
		}
		
		public function newAction()
		{
			
		}
		
		public function createAction()
		{
			//validate and confirm pass here
			$arguments = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['security_question'], $_POST['security_answer']);
			$this->user_model->addOne($arguments);
			header("Location: /");
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
				header("Location: /account");
			}
		}
		
		public function logoutAction()
		{
			//Destroy Session
			Zend_Session::destroy($remove_cookie = true, $readonly = true);
			header("Location: /account");

		}
		
		
	}
	
?>