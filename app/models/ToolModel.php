<?php
	Class ToolModel extends Zend_Db_Table_Abstract
	{
		public $table = 'tools';
		
		function addOne($project_id, $arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'project_id'        => $project_id[0],
				'tool'         => $arguments[0]
				);
		
			//Insert into table
			$db->insert($this->table, $insertArgs);
			return true;
		}

	}
?>