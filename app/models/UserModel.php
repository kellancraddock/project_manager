<?php
	Class UserModel extends Zend_Db_Table_Abstract
	{
		public $table = "users";
			
		function addOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'first_name'        => $arguments[0],
				'last_name'         => $arguments[1],
				'email'         	=> $arguments[2],
				'password'         	=> $arguments[3],
				'security_question' => $arguments[4],
				'security_answer'   => $arguments[5]
				);
		
			//Insert into table
			return $db->insert($this->table, $insertArgs);
			//return $db->lastInsertId();
		}
		
		function getOne($user_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT first_name FROM $this->table WHERE id = {$user_id}";
		
			//Select from table
			return $db->fetchOne($select);
			
		}
		
		function login($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE email = '{$arguments[0]}' AND password = '{$arguments[1]}'";
		
			//Select from table
			return $db->fetchAssoc($select);
		}
	}
?>