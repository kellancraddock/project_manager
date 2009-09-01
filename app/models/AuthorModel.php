<?php
	Class AuthorModel extends Zend_Db_Table_Abstract
	{
		public $table = 'authors';
		
		function addOne($project_id, $arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'project_id'        => $project_id[0],
				'first_name'         => $arguments[0],
				'last_name'         => $arguments[1]
				);
		
			//Insert into table
			$db->insert($this->table, $insertArgs);
			return true;
		}
		
		function getAll($project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE project_id = '{$project_id}'";
		
			//Select from table
			return $db->fetchRow($select);
		}
	}
?>