<?php
	Class AccountModel extends Zend_Db_Table_Abstract
	{
		public $table = "projects";
		
		function getOne($project_id, $user_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$project_id}' AND user_id = '{$user_id}'";
		
			//Select from table
			return $db->fetchRow($select);
		}
		
		function getAll($user_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE user_id = '{$user_id}'";
			
			//Select from table
			return $db->fetchAssoc($select);
		}
	}
?>