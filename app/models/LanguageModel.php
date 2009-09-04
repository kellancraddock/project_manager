<?php
	Class LanguageModel extends Zend_Db_Table_Abstract
	{
		public $table = 'languages';
		
		function addOne($project_id, $language)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'project_id'        => $project_id[0],
				'language'         => $language
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
			$language_array = $db->fetchAll($select);
			
			//Build array
			$return_array = array();
			foreach ($language_array as $language) {
				$return_array[$language['language']] = $language['language'];
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