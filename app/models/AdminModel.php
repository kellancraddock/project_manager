<?php
	Class AdminModel extends Zend_Db_Table_Abstract
	{
		public $table = "projects";
		
		function getAll()
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table";
			
			//Select from table
			return $db->fetchAssoc($select);
		}
		
		function getOne($project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$project_id}'";
		
			//Select from table
			return $db->fetchRow($select);
		}

	}
?>