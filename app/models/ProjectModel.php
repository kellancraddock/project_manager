<?php
	Class ProjectModel extends Zend_Db_Table_Abstract
	{
		private $table = "projects";
		
		function getOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$arguments[0]}'";
		
			//Select from table
			return $db->fetchAssoc($select);
		}

		function getAll()
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table";
		
			//Select from table
			return $db->fetchAssoc($select);
		}
		
		function addOne($arguments, $user_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'user_id'		=> $user_id,
				'title'        	=> $arguments[0],
				'url'         	=> $arguments[1],
				'class'         => $arguments[2],
				'date_completed'=> $arguments[3],
				'specs'         => $arguments[4],
				'approach'      => $arguments[5],
				);
		
			//Insert into table
			$db->insert($this->table, $insertArgs);
			return $db->lastInsertId();
		}
		
		function updateOne($projects, $user_id, $project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'title'        	=> $projects[0],
				'url'         	=> $projects[1],
				'class'         => $projects[2],
				'date_completed' => $projects[3],
				'specs'         => $projects[4],
				'approach'      => $projects[5],
				);
				
			$where[] = "id = '{$project_id}' AND user_id = '{$user_id}'";
			
			//Update
			return $db->update($this->table, $insertArgs, $where);
		}
		
		function deleteOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$delete = "id = '{$arguments[0]}'";
		
			//Delete from table
			return $db->delete($this->table, $delete);
		}
		
		function isOwner($user_id, $project_id)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$project_id}' AND user_id = '{$user_id}'";
		
			//Select from table
			return $db->fetchRow($select);
		}
	}
?>