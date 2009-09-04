<?php
	Class ToolModel extends Zend_Db_Table_Abstract
	{
		public $table = 'tools';
		
		function addOne($project_id, $tool)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'project_id'        => $project_id[0],
				'tool'         => $tool
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
			$tools_array = $db->fetchAll($select);
			
			//Build array
			$return_array = array();
			foreach ($tools_array as $tools) {
				$return_array[$tools['tool']] = $tools['tool'];
			}
			
			return $return_array;
		}
		
		function deleteAll($project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$where = "project_id = '{$project_id}'";
		
			//Delete from table
			return $db->delete($this->table, $where);
		}

	}
?>